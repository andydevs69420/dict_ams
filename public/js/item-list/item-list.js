


async function item_list__updateItem()
{

}

async function item_list__deleteItem(itemlist_id)
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    await $.ajax({
        url: '/itemlist/deleteitem',
        type: 'POST',
        data: {
            'itemlist_id': itemlist_id,
        },
        dataType: 'json',
        success: (response, status, request) => {
            if  (status === "success" && response == 1)
                window.location.reload();
        },
        error: (response, status, request) => {
            console.log(response);
        }
    });
}
