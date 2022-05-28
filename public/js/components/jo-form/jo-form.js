(function() {
    jQuery(() => {
        autoResizeTextArea();
        $("[data-bs-toggle='tooltip']").tooltip();
        $("[data-bs-toggle='popover']").popover();
        $("select").selectpicker({
            search : true
        });
    });

})();


/**
 * 
 * Item addtion and removal 
 * @return void
 * 
 */
function add__item()
{
    item_list = $('#item-list-id');
    nth_child = (item_list.children().length);

    cloned_item = $("#jo-form__jo-item-template").clone();

    // modify item id
    new_itmID = `item-${nth_child}-id`;

    cloned_item
    .attr("id", new_itmID);

    // prepend hr
    cloned_item.prepend($("<hr class=\"bg-info\">"));

    // modify item number
    $(cloned_item.find("span")[0])
    .text(`Item ${nth_child}`);

    // modify remove event
    $(cloned_item.find("button")[0])
    .attr("title", `Remove item ${nth_child}`)
    .attr("onclick", `javascript:remove__item("#${new_itmID}")`);

    // clear fields input
    $(cloned_item.find("input"))
    .each((index,element) => {
        $(element).val("");
    });

    // clear fields textarea
    $(cloned_item.find("textarea"))
    .each((index,element) => {
        $(element).attr("rows", 1);
        $(element).css("height", "auto");
        $(element).val("");
    });

    item_list.append(cloned_item);

    $('[data-bs-toggle="tooltip"]').tooltip();
    $('[data-bs-toggle="popover"]').popover();
    autoResizeTextArea();
}


function autoResizeTextArea() {

    textareas_00 = $("textarea");
    textareas_00.each((index, txtarea) => {
        textareas = $(txtarea);
        textareas.keyup(() => {

            textareas.css("height", (textareas.prop("scrollHeight") > textareas.height()) ? (textareas.prop('scrollHeight'))+"px" : "auto");

            console.log("\""+textareas.val()+"\"")

            if (textareas.val().length <= 0)
                textareas.css("height", "auto");
            
            rows = textareas.val().toString().split("\n").length;
            rows = (rows <= 0)? 1 : rows;
            textareas.attr("rows", rows);

        });
    });

}


/**
 * 
 * Remove Item N
 * @param String id_query_selector mao ning id sa <li> nga nag hawid sa item
 * @return void
 * 
 */
// function remove__item(id_query_selector)
// { $(id_query_selector).remove(); }

function remove__item(id_query_selector)
{
    item_list = $("#item-list-id");
    //    0      1     2
    // ["item", "N", "id"]
    id = $(id_query_selector).attr("id").split("-");

    // re-number the item list
    for (idx = parseInt(id[1]); idx < item_list.children().length; idx++)
    {
        childRef = $(item_list.children()[idx]);
        childIDN = `item-${idx}-id`;

        childRef
        .attr("id", childIDN);

        $(childRef.find("span")[0])
        .text(`Item ${idx}`);

        $(childRef.find("button")[0])
        .attr("title", `Remove item ${idx}`)
        .attr("onclick", `javascript:window.remove__item("#${childIDN}")`);
    }

    $('[data-bs-toggle="tooltip"]')
    .tooltip("dispose")
    .tooltip();

    $(id_query_selector)
    .attr("id", `item-${id[1]}-id-delete`)
    .remove();
}


/**
 * 
 * Calculate Quantity with cost
 * @return void
 * 
 */

 /**
 * 
 * Calculate unitcost with qty
 * @return void
 * 
 */


/**
 * 
 * Generate Form 
 * @return void
 * 
 */
function generate__jo_form()
{   
    let item_fields , 
        req_A , 
        req_B ,
        rec_A , 
        rec_B ;
    
    item_fields = [
        'stock[]', 'unit[]', 'description[]', 'qty[]', 'unitcost[]', 'totalcost[]'
    ];
    
    let arranged_data = [];

    // row count
    let rcount = $(`[name='${item_fields[0]}']`).length;

    // rows
    for (let i = 0; i < rcount; i++)
    {   
        // item_N: where N is the current Item number OR N == i.
        let item_N = [];
        // columns
        for (let j = 0; j < item_fields.length; j++)
        {
            let col = $(`[name='${item_fields[j]}']`);
            item_N.push($(col[i]).val());
        }
        arranged_data.push(item_N);
    }


    // kinsay nag requqest sa form
    req_A = $('#req-name').val();
    
    // unsay designation sa nag request
    req_B = $('#req-designation').text();

    // conforme
    rec_A = $('#conforme-name').val();

    // date
    var today = new Date();
    var date = (today.getMonth()+1)+'/'+today.getDate()+'/'+today.getFullYear();

    let form_data = {
        'items' : arranged_data,
        'req_A' : req_A ,
        'req_B' : req_B ,
        'conforme' : rec_A ,
        'date' : date
    };

    (function(){
        
        let invalid = false;

        arranged_data.forEach((row) => {
            row.forEach((col) => {

                if (col === "")
                    invalid = true;

            });
        });

        if(invalid)
            return $('#jo-form__on-error-modal').modal('show');
        else
            return window.open(`/newjoborder/viewjoform?data=${JSON.stringify(form_data)}`);
    })();
    
}

/**
 * 
 * File upload display
 *  
 */

$('#file-pick-id')
.change((e) => {

    let file = e.target.files;

    for (let idx = 0; idx < file.length; idx++)
    {
        let filereader = new FileReader();
        filereader.readAsDataURL(file[idx]);
        filereader.onloadend = (data) => {

            $('#file-content-id').empty();

            $('#file-content-id')
            .append($(`<a class="btn btn-sm my-2 px-4 w-100 border-success rounded-pill bg-light text-success text-nowrap text-truncate text-decoration-none" href="${data.currentTarget.result}" target="__blank" style="max-width: 100%;"><small>${file[idx].name}</small></a>`));
            
        }
    }
    
});





