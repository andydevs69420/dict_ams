

(function(){

    jQuery(()=> {
        window.messageModal = new MessageModal("#users__message-modal");
        $("#users__user-table").DataTable({
            "responsive" : true ,
            "autoWidth"  : false
        });
    });

    $.ajaxSetup({
        headers: { "X-CSRF-TOKEN": $("meta[name=\"csrf-token\"]").attr("content") }
    });

    /**
     * Update user verification status
     * @param user_id "String | Number"  user's id
     * @param status_id "String | Number" new status id
     * @return null
     * @example
     *     status_id
     *         1 := PENDING 
     *         2 := ACCEPTED 
     *         3 := DECLINE 
     * 
     *     window.updateUserVerificationStatus("69", "3");
     **/
    window.updateUserVerificationStatus = async function(user_id,status_id)
    {
        await $.ajax({
            url  : "/user/updateverificationstatus",
            type : "POST",
            data : 
            {
                "user_id": user_id,
                "status_id": status_id
            },
            dataType: "json",
            success: function(response, status, request) 
            {
                if  (!(status === "success" && (response  == true)))
                    // debug
                    somethingWentWrong();
                
                window.location.reload();
            },
            error: function(response, status, request) 
            // debug
            { somethingWentWrong(); }
        });
    };

    /**
     * @param user_id "String | Number" user's id 
     * @return null
     * @example
     *     window.deleteUser("69");
     **/
    window.deleteUser = async function(user_id) 
    {
        await $.ajax({
            url  : "/user/deleteuser",
            type : "POST",
            data : { "user_id": user_id },
            dataType: "json",
            success: function(response, status, request) 
            {
                if  (!(status === "success" && (response  == true)))
                    // debug
                    somethingWentWrong();
                
                window
                .messageModal
                ?.show("Info", "User deleted successfully!");
            },
            error: function(response, status, request) 
            // debug
            { somethingWentWrong(); }
        });
    };

})();


function somethingWentWrong()
{
    return window
    .messageModal
    ?.show("Error", "Something went wrong!");
}
