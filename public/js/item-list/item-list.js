/*

    item-list.js - andydevs69420 - April 21 2022
    | submit issue if error found!!
    ;

    @brief - Item related functions
        ex: add, remove, edit, etc. item

*/


(function(){

    jQuery(() => {
        window.messageModal = new MessageModal("#item-list__message-modal");
        window.itemListTable = $("#item-list__item-list-table").DataTable({
            "autoWidth": false,
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
        input = $("#item-list__add-update-item-modal")
                .find("input[required]");

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
                    return somethingWentWrong();

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
                    $("#item-list__add-update-item-modal")
                    .modal("toggle");

                    window.resetModal();

                    if (response["successful"] == false)
                        return window.messageModal?.show("Error", response["message"]);

                    pdata["itemlist_id"] = response["itemlist_id"];
                    appendNewItem(pdata);
                    return window.messageModal?.show("Info", response["message"]);
                }
            },
            error: function(response, status, request)
            { somethingWentWrong(); }
        });
    }


    function appendNewItem(item)
    {
        return $("tbody").append(
            $("<tr></tr>").append([
                $(`<td data-order="${ item["itemlist_id"] }" style="vertical-align: middle !important;"></td>`).text(item["itemnumber"]),
                $('<td style="vertical-align: middle !important;"></td>').text(item["itemname"]),
                $('<td style="vertical-align: middle !important;"></td>').text(item["itemdescription"]),
                $(`
                    <td class="text-center" style="vertical-align: middle !important;">
                        <div class="dropdown">
                            <button id="action-user-${ item["itemlist_id"] }" class="btn btn-sm btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                action
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="action-user-${ item["itemlist_id"] }">
                                <li><a class="dropdown-item" href="#" onclick='javascript: window.updateCandidate( ${ JSON.stringify(item) } )'>edit</a></li>
                                <li><a class="dropdown-item" href="#" onclick='javascript: window.deleteItem("${ item["itemlist_id"] }", "3")'>delete</a></li>
                            </ul>
                        </div>
                    </td>
                `)
            ])
        );
    }


    /**
     * Show update candidate to modal
     * @param String item_id item id
     * @return null
     * @example
     *     window.updateCandidate({id: "1", ...});
     **/
    window.updateCandidate = async function(itemlist)
    {
        $("#item-list__add-update-item-modal")
            .modal("show");
        $("#item-list__add-update-item-modal")
            .find("h5[class='modal-title']")
                .text("Update Existing Item");
        $("#item-list__add-update-item-modal")
            .find("div[class='modal-footer']")
                .find("button.btn.btn-primary")
                    .attr("onclick", `javascript: window.updateItem(${ itemlist["itemlist_id"] })`)
                    .text("Update Item");
        
        input = (callback = () => $("#item-list__add-update-item-modal")
            .find("input[required]"))();
        
        input.each((idx, element) => {
            element = $(element);
            console.log(element);
            element.val(itemlist[element.attr("name")]);
        });
    }


    /**
     * Submit update item -> itemlst/updateitem
     * @param "String | Number" item_id item id
     * @returns null
     * @example
     *     window.updateItem("69");
     **/
    window.updateItem = async function(itemlist_id)
    {
        pdata = { "itemlist_id" :  itemlist_id };

        input = $("#item-list__add-update-item-modal")
                .find("input[required]");
        input.each(function(idx, element) {
            element = $(element);
            pdata[element.attr("name")] = element.val();
        });

        await $.ajax({ 
            url  : "/itemlist/updateitem", 
            type : "POST",
            data : pdata, 
            dataType: "json",
            success: function(response, status, request)
            {
                if  (status !== "success")
                    return somethingWentWrong();

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
                    $("#item-list__add-update-item-modal")
                    .modal("toggle");

                    window.resetModal();

                    if (response["successful"] == false)
                        return window.messageModal?.show("Error", response["message"]);

                    return window.messageModal?.show("Info", response["message"]);
                }
            },
            error: function(response, status, request)
            { somethingWentWrong(); }
        });
    }


    /**
     * Delete Item -> itemlst/deleteitem
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
                    return somethingWentWrong();
                
                window.messageModal?.show("Info", "Item deleted successfully!");

                $("#item-list__row-item-"+itemlist_id)
                .remove();
            },
            error: function(response, status, request) 
            { somethingWentWrong(); }
        });
    }


    /**
     * Show something went wrong msg
     * @returns null
     * @example
     *    somethingWentWrong();
     **/
    function somethingWentWrong()
    {
        return window
        .messageModal
        ?.show("Error", "Something went wrong!");
    }


    /**
     * Removes error messages
     * @return null
     * @example
     *     resetModal();
     **/
    window.resetModal = function()
    {
        setTimeout(() => {
            $("#item-list__add-update-item-modal")
                .find("h5[class='modal-title']")
                    .text("Add New Item");
            $("#item-list__add-update-item-modal")
                .find("div[class='modal-footer']")
                    .find("button.btn.btn-primary")
                        .attr("onclick", "javascript: window.addNewItem()")
                        .text("Add Item");
            
            input = $("#item-list__add-update-item-modal")
                .find("input[required]");
        
            input.each((idx, element) => {
    
                el = $(element);
                p2 = $(el.parent());
                p1 = $(p2.parent());
    
                el.val("");
    
                if (p1.children().length <= 1)
                    return;
                
                ref = p1.children();
                for (let idx = 0; idx < (ref.length - 1 ); idx++)
                { $(ref[idx]).remove(); }
    
            });
        }, 1000);
    }

})();
