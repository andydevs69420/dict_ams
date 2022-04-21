



async function users__updateVerificationStatus(user_id, status_id)
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    await $.ajax({
        url: '/user/updateverificationstatus',
        type: 'POST',
        data: {
            'user_id': user_id,
            'status_id': status_id
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


async function users__deleteUser(user_id)
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    await $.ajax({
        url: '/user/deleteuser',
        type: 'POST',
        data: {
            'user_id': user_id,
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
