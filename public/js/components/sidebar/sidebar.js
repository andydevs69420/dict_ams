


(function(){

    jQuery(() => window.fit__sidebar__sidebar_wrapper_scrollable());

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

})();