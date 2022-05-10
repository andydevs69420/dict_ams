/*

    user-profile.js - andydevs69420 - May 6 2022
    | submit issue if error found!!
    ;

    @brief - user profile related functions
        ex: Change name, password and etc.

*/



(function() {

    jQuery(() => {
        $("#user-profile__enable-edit").change((evt) => {
            $(evt.target).val(evt.target.value === "off"?"on":"off");
            updateFormState(evt.target.value);
        });
    });

    /**
     * Enable fields and make them editable
     * @param String status status
     * @return null
     * @example
     *     updateFormState("off" | "on");
     **/
    window.updateFormState = function(status)
    {
        form = $("#user-profile__edit-profile-form");
        form.find("input, select, button")
        .each((i, el) => {
            if(status === "on")
            {
                $(el).removeAttr("disabled");
                form.css("opacity", 1);
                form.find('span[role="text"]').css("user-select", "auto");
            }
            else
            {
                $(el).prop("disabled", true);
                form.css("opacity", .9);
                form.find('span[role="text"]').css("user-select", "none");
            }
        });
    }

})();
