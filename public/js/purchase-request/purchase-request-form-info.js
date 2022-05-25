
(function(root) {

    $.ajaxSetup({
        headers: { "X-CSRF-TOKEN" : $("meta[name=\"csrf-token\"]").attr("content") }
    });

    jQuery(() => {
        root.messageModal = new MessageModal("#purchase-request-form-info__message-modal");
        loadComments();
        addComment();
    });

    /**
     * Loads comment dynamically. interval is 2 seconds
     **/
    function loadComments()
    {
        let ID = "#purchase-request-form-info__comment-list";
        setInterval(() => {
            element = $(ID);
            element.load(`/purchaserequest/loadcomment?hash=${element.data("fid")}`);
        }, 2000); 
    }

    /**
     * Adds comment dynamically
     **/
    function addComment()
    {
        let ID = "#purchase-request-form-info__comment-button";
        $(ID)
        .click(() => {

            if ($("#purchase-request-form-info__comment-field").val().toString().trim().length <= 0)
                return $("#purchase-request-form-info__comment-field").val("");

            $.ajax({
                url  : "/purchaserequest/addcomment",
                type : "POST",
                data : { frp : $(ID).data("frp"), comment : $("#purchase-request-form-info__comment-field").val() },
                dataType : "json",
                success  : function(response, status, request)
                {
                    if  (!(status === "success" && (response  == true)))
                        return root.messageModal?.show("Error", "An error has been encountered while inserting comment.");
                    
                    $("#purchase-request-form-info__comment-field").val("");
                },
                error : function(response, status, request)
                { console.log(response.responseText); }
            });
        });
    }

})(window);

