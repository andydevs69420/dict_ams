

(function(root) {

    $.ajaxSetup({
        headers: { "X-CSRF-TOKEN" : $("meta[name=\"csrf-token\"]").attr("content") }
    });

    jQuery(function() {
        loadComments();
        addComment();
    });

    /**
     * Loads comment dynamically. interval is 2 seconds
     **/
    function loadComments()
    {
        let ID = "#job-order-form-info__comment-list";
        setInterval(() => {
            element = $(ID);
            element.load(`/joborder/loadcomment?hash=${element.data("fid")}`);
        }, 2000); 
    }

    /**
     * Adds comment dynamically
     **/
    function addComment()
    {
        let ID = "#job-order-form-info__comment-button";
        $(ID)
        .click(() => {

            if ($("#job-order-form-info__comment-field").val().toString().trim().length <= 0)
                return $("#job-order-form-info__comment-field").val("");

            $.ajax({
                url  : "/joborder/addcomment",
                type : "POST",
                data : { frp : $(ID).data("frp"), comment : $("#job-order-form-info__comment-field").val() },
                dataType : "json",
                success  : function(response, status, request)
                {
                    if  (!(status === "success" && (response  == true)))
                        return root.messageModal?.show("Error", "An error has been encountered while inserting comment.");
                    
                    $("#job-order-form-info__comment-field").val("");
                },
                error : function(response, status, request)
                { console.log(response.responseText); }
            });
        });
    }
})(window);

