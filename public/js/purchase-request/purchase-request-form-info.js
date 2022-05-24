
(function() {

    $.ajaxSetup({
        headers: { "X-CSRF-TOKEN" : $("meta[name=\"csrf-token\"]").attr("content") }
    });


    /**
     * Adds comment dynamically
     **/
    window.addComment = function()
    {
        $.ajax({
            url  : "/purchaserequest/addcomment",
            type : "POST",
            data : { frp : 1 ,comment : $("#purchase-request-form-info__comment-field").val() },
            dataType : "json",
            success  : function(response, status, request)
            {

            },
            error : function(response, status, request)
            { console.log(response.responseText); }
        });
    }

})();

