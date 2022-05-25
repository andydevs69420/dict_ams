(function(){


    jQuery(() => {
        window.progressBar = new Progressbar("#pr-progress");
        window.autoResizeTextArea();

        $("[data-bs-toggle='tooltip']").tooltip();
        $("[data-bs-toggle='popover']").popover();
        $("select").selectpicker({
            search : true
        });
    });

    /**
     * Item addtion
     * @return null
     **/
    window.add__item = function()
    {

        item_list = $("#item-list-id");
        nth_child = (item_list.children().length + 1);

        clone_itm = $("#pr-form__item-template-default")
                    .clone();

        // modify item id
        new_itmID = `item-${nth_child}-id`;

        clone_itm
        .attr("id", new_itmID);

        // prepend hr
        clone_itm
        .prepend($('<hr class="bg-info">'));

        // modify item number
        $(clone_itm.find("span")[0])
        .text(`Item ${nth_child}`);

        // modify remove event
        $(clone_itm.find("button")[0])
        .attr("title", `Remove item ${nth_child}`)
        .attr("onclick", `javascript:remove__item("#${new_itmID}")`);

        // clear fields input
        $(clone_itm.find("input"))
        .each((index,element) => {
            $(element).val("");
        });

        // clear fields textarea
        $(clone_itm.find("textarea"))
        .each((index,element) => {
            $(element).attr("rows", 1);
            $(element).css("height", "auto");
            $(element).val("");
        });

        // finally append item
        item_list.append(clone_itm);

        $('[data-bs-toggle="tooltip"]').tooltip();
        $('[data-bs-toggle="popover"]').popover();

        progressBar.update();
        autoResizeTextArea();
    };

    /**
     * Remove Item N
     * @param String id_query_selector mao ning id sa <li> nga nag hawid sa item
     * @return null
     **/
    window.remove__item = function(id_query_selector)
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

        progressBar.update();

    };

    window.autoResizeTextArea = function() {

        textareas_00 = $("textarea");
        textareas_00.each((index, txtarea) => {
            textareas = $(txtarea);
            textareas.keyup(() => {

                textareas.css("height", (textareas.prop("scrollHeight") > textareas.height()) ? (textareas.prop('scrollHeight'))+"px" : "auto");
                
                if (textareas.val().length <= 0)
                    textareas.css("height", "auto");
    
                rows = textareas.val().toString().split("\n").length;
                rows = (rows <= 0)? 1 : rows;
                textareas.attr("rows", rows);
    
            });
        });

    }

})();

var haystack = [];

/**
 * Generatete purchase request form
 * @example
 * FIELD INDEXES:
 *      0 := stock
 *      1 := unit
 *      2 := item description
 *      3 := qty
 *      4 := unit cost
 *      5 := total cost
 * index "1" and "2" is required
 * @return null
 **/
function generate__pr_form()
{
    while (haystack.length!= 0)
        haystack.pop().remove();

    item_fields = [
        "stock[]", "unit[]", "description[]", "qty[]", "unitcost[]", "totalcost[]"
    ];

    other_fields = [
        "purpose", "requester", "budget-officer", "recommending-approval"
    ];

    required_field_index = [1 , 2];

    /**
     * Ingon ani siya tanawon ug e print
     * [
     *   [stock, unit, item description, qty, unit cost, total cost], item-0
     *   .
     *   [stock, unit, item description, qty, unit cost, total cost]  item-N
     * ]
     **/

    arranged_data = [];

    invalidFields = false;

    // row count
    rcount = $(`[name="${item_fields[0]}"]`).length;

    // rows
    for (i = 0; i < rcount; i++)
    {
        // item_N: where N is the current Item number OR N == i.
        item_N = [];

        // columns
        for (j = 0; j < item_fields.length; j++)
        {
            col = $(`[name="${item_fields[j]}"]`);
            row = $(col[i]);

            if
            (
                required_field_index.includes(j) &&
                (row.val().trim().length <= 0 || row.val().length <= 0)
            )
            {
                invalidFields = true;

                _1stparent = $(row.parent());
                rootparent = $(_1stparent.parent());

                message = `<small class="text-danger">${row.attr("placeholder")} is required.</small>`;
                haystack.push($(message));

                // if item description, move to next parent
                if (j === 2)
                {
                    if ($(rootparent.parent()).children().length <= 1)
                        $(rootparent.parent()).append(haystack[haystack.length - 1]);
                }
                else
                    if (rootparent.children().length <= 1)
                        rootparent.append(haystack[haystack.length - 1]);
            }

            item_N.push(row.val());

        }

        arranged_data.push(item_N);

    }

    other_fields.forEach((field_name) => {

        field = $(`[name="${field_name}"]`);

        if (field.val().trim().length <= 0 || field.val().length <= 0)
        {
            invalidFields = true;
            message = `<small class="text-danger">${field.attr("placeholder")} is required.</small>`;
            haystack.push($(message));

            if (field_name == "purpose")
            {
                $(field.parent())
                .parent()
                .append(haystack[haystack.length - 1]);
            }
            else
            {
                $(field.parent())
                .parent()
                .parent()
                .append(haystack[haystack.length - 1]);
            }
        }

    });

    if (invalidFields)
        return;
    
    // generate form

    desturl = `${window.location.origin}/purchaserequest/viewprform?items=${JSON.stringify(arranged_data)}`;
    other_fields.forEach((field_name) => {
        desturl += `&${field_name}=${$(`[name="${field_name}"]`).val()}`;
    });

    window.open(desturl, "_blank");

}

/**
 *
 * File upload display
 *
 **/
$("#file-pick-id")
.change((e) => {

    file = e.target.files;

    $("#file-content-id").empty();

    for (idx = 0; idx < file.length; idx++)
    {
        filereader = new FileReader();
        filereader.readAsDataURL(file[idx]);
        filereader.onloadend = (data) => {
            $("#file-content-id")
            .append($(`<a class="btn btn-sm my-2 px-4 w-100 border-success rounded-pill bg-light text-success text-nowrap text-truncate text-decoration-none" href="${data.currentTarget.result}" target="__blank" style="max-width: 100%;"><small>${file[0].name}</small></a>`));
        }
    }

});





