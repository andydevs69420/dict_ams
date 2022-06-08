
(function(root) {

    $.ajaxSetup({
        headers: { "X-CSRF-TOKEN" : $("meta[name=\"csrf-token\"]").attr("content") }
    });

    jQuery(() => {
        root.messageModal = new MessageModal("#review-job-order__message-modal");
        loadComments();
        addComment();
    });

    /**
     * Loads comment dynamically. interval is 2 seconds
     **/
    function loadComments()
    {
        let ID = "#review-job-order__comment-list";
        setInterval(() => {
            element = $(ID);
            element.load(`/budgetofficer/reviewjoborder/loadcomment/${element.data("fid")}/load`);
        }, 2000); 
    }

    /**
     * Adds comment dynamically
     **/
    function addComment()
    {
        let ID = "#review-job-order__comment-button";
        $(ID)
        .click(() => {

            if ($("#review-job-order__comment-field").val().toString().trim().length <= 0)
                return $("#review-job-order__comment-field").val("");

            $.ajax({
                url  : "/budgetofficer/reviewjoborder/addcomment",
                type : "POST",
                data : { frp : $(ID).data("frp"), comment : $("#review-job-order__comment-field").val() },
                dataType : "json",
                success  : function(response, status, request)
                {
                    if  (!(status === "success" && (response  == true)))
                        return root.messageModal?.show("Error", "An error has been encountered while inserting comment.");
                    
                    $("#review-job-order__comment-field").val("");
                },
                error : function(response, status, request)
                { console.log(response.responseText); }
            });
        });
    }

})(window);

