
(function(){

    jQuery(() => {
        window.messageModal = new MessageModal("#item-list__message-modal");
        $("#item-list__item-list-table").DataTable({
            "autoWidth": false
        });
        $("[data-bs-toggle='popover']").popover();
    });

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $("meta[name=\"csrf-token\"]").attr("content")
        }
    });

    /**
     * Add new item -> itemlst/addnewitem
     * @return null
     * @example
     *     window.addNewItem();
     **/
    window.addNewItem = async function()
    {
        input = $("#item-list__add-item-modal")
                .find("input[required]:visible");

        pdata = {};
        input
        .each(function(idx, element) {
            element = $(element);
            pdata[element.attr("name")] = element.val();
        });

        await $.ajax({ 
            url  : "/itemlist/additem", 
            type : "POST",
            data : pdata, 
            dataType: "json",
            success: function(response, status, request)
            {
                if  (status !== "success")
                    // debug
                    somethingWentWrong();

                if  (response.hasOwnProperty("errors"))
                {
                    input.each((idx_i, element) => {

                        el = $(element);
                        p2 = $(el.parent());
                        p1 = $(p2.parent());

                        if (p1.children().length > 1)
                            $(p1.children()[0]).remove();

                        err = response["errors"][el.attr("name")];
                        err?.forEach((err_r) => {
                            p1.prepend($(`<small class="text-danger">${err_r}</small>`));
                        });
                        
                    });
                }
                else if (response.hasOwnProperty("message"))
                {
                    $("#item-list__add-item-modal")
                    .modal("toggle");

                    window
                    .messageModal
                    ?.show("Info", response["message"]);
                }
            },
            error: function(response, status, request)
            // debug
            { somethingWentWrong(); }
        });
    }

    /**
     * Delete Item
     * @param Number itemlist_id itemid
     * @return null
     * @example 
     *     window.deleteItem("69");
     **/
    window.deleteItem = async function(itemlist_id)
    {
        await $.ajax({
            url  : "/itemlist/deleteitem",
            type : "POST",
            data : { "itemlist_id": itemlist_id },
            dataType: "json",
            success: function(response, status, request)
            {
                if  (!(status === "success" && (response == true)))
                    // debug
                    somethingWentWrong();
                
                window.location.reload();
            },
            error: function(response, status, request) 
            // debug
            { somethingWentWrong(); }
        });
    }

})();


function somethingWentWrong()
{
    return window
    .messageModal
    ?.show("Error", "Something went wrong!");
}
