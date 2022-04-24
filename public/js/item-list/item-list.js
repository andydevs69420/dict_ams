

(function(){

    jQuery(() => {
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
     * Delete Item
     * @param Number itemlist_id itemid
     * @return null
     * @example 
     *     window.deleteItem("69");
     **/
    window.deleteItem = async function(itemlist_id)
    {
        await $.ajax({
            url: "/itemlist/deleteitem",
            type: "POST",
            data: { "itemlist_id": itemlist_id },
            dataType: "json",
            success: function(response, status, request)
            {
                if  (status === "success" && (response == true))
                    window.location.reload();
                else
                    alert("Something went wrong!");
            },
            error: function(response, status, request) 
                { console.error("errresponse: " + response); }
        });
    }

})();

async function item_list__updateItem()
{

}
