
(function() {

    jQuery(function() {
        $("#new-job-order__confirm-signature").click((evt) => {
            if (evt.target.checked)
                $("#new-job-order__submit").removeAttr("disabled");
            else 
                $("#new-job-order__submit").attr("disabled", "disabled");
        });
    });

})();

