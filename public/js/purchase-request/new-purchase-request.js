
(function() {

    jQuery(function() {
        $("#new-purchasse-request__confirm-signature").click((evt) => {
            if (evt.target.checked)
                $("#new-purchase-request__submit").removeAttr("disabled");
            else 
                $("#new-purchase-request__submit").attr("disabled", "disabled");
        });
    });

})();

