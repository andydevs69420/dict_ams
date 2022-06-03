

(function() {

    let ELEMENTS = [];
    let HAYSTACK = [];

    jQuery(function() {

        onBoot();
       
    });

    /**
     * Gets all input | textarea element under form.
     **/ 
    function onBoot()
    {
        $("input, textarea, select, button").each((index, element) => ELEMENTS.push($(element)));
        attachEvent();
    }

    /**
     * Attach event onchange.
     **/
    function attachEvent()
    {
        DEFAULTS = [];

        for (let idx = 0; idx < ELEMENTS.length; idx++)
        {
            DEFAULTS.push({
                name : ELEMENTS[idx].attr("name") ,
                type : ELEMENTS[idx].attr("type") ,
            });

            HAYSTACK.push(new MutationObserver(function() {
                ELEMENTS[idx].attr("name", DEFAULTS[idx].name);
                ELEMENTS[idx].attr("type", DEFAULTS[idx].type);
                resetEvent();
            }));
         
            HAYSTACK[idx].observe(ELEMENTS[idx][0], {
                attributes : true  ,
                childList  : false ,
                subtree    : false ,
            });
        }
    }

    /**
     * Reset event. 
     **/ 
    function resetEvent()
    {
        while (HAYSTACK.length > 0)
            HAYSTACK.pop().disconnect();

        attachEvent();
    }


})();