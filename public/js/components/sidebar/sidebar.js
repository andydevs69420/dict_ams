


(function(){

    const HSTACK = [];

    jQuery(() => {

        window.fit__sidebar__sidebar_wrapper_scrollable();
        enable__alternate_collapsing();

    });

    /**
     * Fit sidebar scrollable area
     * @return null
     **/
    window.fit__sidebar__sidebar_wrapper_scrollable = function()
    {
        /* pang resize lang ni sa container atong mga links */
        $('.sidebar__navbar-brand-group')
        .each((index_group_0,this__group_0) => {

            let resize_basis = $(this__group_0);

            $('.sidebar__scrollable-wrapper')
            .each((index_group_1,this__group_1) => {
                $(this__group_1)
                .css('height', `calc(100% - ${resize_basis.outerHeight()}px)`);
            });

        });
    };

    /**
     * Only one accordion opens at a time!!
     * @return null;
     **/
    function enable__alternate_collapsing()
    {
        let main_wrapper = $(".sidebar__scrollable-wrapper");
        main_wrapper.find(".sidebar__accordion-button")
        .each((index, btn) => HSTACK.push($(btn).click(btn_click)));
    }

    /**
     * Lazy click function
     * @param HTMLElement evt
     * @return null;
     **/
    function btn_click(evt)
    {
        HSTACK.forEach((item) => {
            if (evt.currentTarget !== item[0])
                if (!item.hasClass("collapsed"))
                {
                    // lazy!!
                    item.off("click");
                    item.click();
                    item.off("click");
                    item.click(btn_click);
                }
        });
    }

})();
