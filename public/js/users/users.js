/*

    user.js - andydevs69420 - April 21 2022
    | submit issue if error found!!
    ;

    @brief - User related functions
        ex: removing user, verifying user, etc.

*/

(function(){

    jQuery(()=> {
        window.messageModal = new MessageModal("#users__message-modal");
        $("#users__user-table").DataTable({
            "responsive" : true ,
            "autoWidth"  : false,
            "colReorder" : {
                realtime: true
            }
        });
    });

    $.ajaxSetup({
        headers: { "X-CSRF-TOKEN" : $("meta[name=\"csrf-token\"]").attr("content") }
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
                "user_id"   : user_id,
                "status_id" : status_id
            },
            dataType: "json",
            success: function(response, status, request) 
            {
                if  (!(status === "success" && (response  == true)))
                    return somethingWentWrong();
                
                switch (parseInt(status_id))
                {
                    case 2:// ACCEPTED
                        window.messageModal?.show("Info", "User has been verified!");
                        updateActionBtnBG("#user-row__user-"+user_id, status_id);
                        break;
                    case 3:// DECLINE
                        window.messageModal?.show("Info", "User has been declined!");
                        updateActionBtnBG("#user-row__user-"+user_id, status_id);
                        break;
                    default:
                        throw `Invalid status_id "${status_id}" for this context..`;
                }
            },
            error: function(response, status, request) 
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
                    return somethingWentWrong();
                
                window.messageModal.show("Info", "User deleted successfully!");

                $("#user-row__user-"+user_id)
                .remove();
            },
            error: function(response, status, request) 
            { somethingWentWrong(); }
        });
    };

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
     * Update button color based on access level
     * @param String row row query selector
     * @param String status_id "String | Number" new status id
     * @return Jquery object
     * @example
     *     updateActionBtnBG("tr[id='tr-row-0']", "69" | 69);
     **/
    function updateActionBtnBG(row, status_id)
    {
        return $(row)
        .find("button")
        .removeClass("btn-danger")
        .addClass(parseInt(status_id) === 2 ? "btn-primary" : "btn-success");
    }

})();
