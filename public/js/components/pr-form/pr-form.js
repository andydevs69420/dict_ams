(function(){

    window.progressBar = new Progressbar('#pr-progress');

    /**
     * Item addtion
     * @return void
     */
    window.add__item = function()
    {
        let item_list, nth_child, new_itmID, clone_itm;

        item_list = $('#item-list-id');
        nth_child = (item_list.children().length + 1);

        clone_itm = $('#pr-form__item-template-default')
                    .clone();
        
        // modify item id
        new_itmID = `item-${nth_child}-id`;

        clone_itm
        .attr('id', new_itmID);

        // prepend hr
        clone_itm
        .prepend('<hr class="bg-info">');

        // modify item number
        $(clone_itm.find('span')[0])
        .text(`Item ${nth_child}`);

        // modify remove event
        $(clone_itm.find('button')[0])
        .attr('title', `Remove item ${nth_child}`)
        .attr('onclick', `javascript:remove__item('#${new_itmID}')`);

        // clear fields
        $(clone_itm.find('input'))
        .each((index,element) => {
            $(element).val('');
        });

        // finally append item
        item_list.append(clone_itm);

        $('[data-bs-toggle="tooltip"]').tooltip();
        $('[data-bs-toggle="popover"]').popover();
        progressBar.update();
    };

    /**
     * Remove Item N
     * @param String id_query_selector mao ning id sa <li> nga nag hawid sa item
     * @return void
     */
    window.remove__item = function(id_query_selector)
    { 
        item_list = $('#item-list-id');
        //    0      1     2
        // ['item', 'N', 'id']
        id = $(id_query_selector).attr('id').split('-');

        // re-number the item list
        for (let idx = parseInt(id[1]); idx < item_list.children().length; idx++)
        {
            let childRef = $(item_list.children()[idx]);
            let childIDN = `item-${idx}-id`; 

            childRef
            .attr('id', childIDN);

            $(childRef.find('span')[0])
            .text(`Item ${idx}`);

            $(childRef.find('button')[0])
            .attr('title', `Remove item ${idx}`)
            .attr('onclick', `javascript:window.remove__item('#${childIDN}')`);
        }

        $('[data-bs-toggle="tooltip"]')
        .tooltip('dispose')
        .tooltip();

        $(id_query_selector)
        .attr('id', `item-${id[1]}-id-delete`)
        .remove();

        progressBar.update();
        
    };

})();

/**
 * Generate Form 
 * @return void
 */
function generate__pr_form()
{   
    let item_fields , 
        purps ,
        req_A , 
        req_B ,
        rec_A , 
        rec_B ;
    
    item_fields = [
        'stock[]', 'unit[]', 'description[]', 'qty[]', 'unitcost[]', 'totalcost[]'
    ];
    
    
    /**
      * 
      * Ingon ani siya tanawon ug e print
      * [
      *   [stock, unit, item description, qty, unit cost, total cost], item-0
      *   .
      *   .
      *   [stock, unit, item description, qty, unit cost, total cost]  item-N
      * ]
      * 
      */
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
            let column_value = $(col[i]).val();

            item_N.push(column_value);
        }
        arranged_data.push(item_N);
    }

    // purpose sa pag purchase
    purps = $('#purpose-field').val();

    // kinsay nag requqest sa form
    req_A = $('#req-name').val();
    // unsay designation sa nag request
    req_B = $('#req-designation').text();

    // kinsay ge recommend mag approve
    rec_A = $('#rec-approval-name').val();
    // unsay designation sa mag approve
    rec_B = $('#rec-designation').text();
    
    let form_data = {
        'items' : arranged_data , 
        'purps' : purps , 
        'req_A' : req_A , 
        'req_B' : req_B , 
        'rec_A' : rec_A , 
        'rec_B' : rec_B ,
    };

    (function(){

        let hasInvalid = false;

        arranged_data.forEach((row) => {
            let idx = 0;
            row.forEach((col) => {

                /** 
                 * Not required fields 
                 * 0 := stock
                 * 1 := unit
                 * 2 := item description
                 * 3 := qty
                 * 4 := unit cost
                 * 5 := total cost
                 * 
                 */ 

                if (!hasInvalid && [1, 2].includes(idx))
                    hasInvalid = (col.length <= 0 || col.trim().length <= 0);
                
                idx++;

            });
        });

        if (
            hasInvalid        ||
            purps.length <= 0 ||
            req_A.length <= 0 ||
            req_B.length <= 0 ||
            rec_A.length <= 0 ||
            rec_B.length <= 0
        )
            return $('#pr-form__on-error-modal').modal('show');
        else
            return window.open(`/newpurchaserequest/viewprform?data=${JSON.stringify(form_data)}`);

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
            $('#file-content-id')
            .append($(`<a class="d-inline-block px-4 border rounded-pill bg-light text-nowrap text-truncate text-decoration-none" href="${data.currentTarget.result}" target="__blank" style="max-width: 100%;"><small>${file[idx].name}</small></a>`));
        }
    }
    
});





