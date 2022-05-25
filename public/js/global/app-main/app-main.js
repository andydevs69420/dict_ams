

(function(){

    console.info("%cStop!", 'font-weight: bolder;color: red; background: transparent; font-size: 5em;');
    console.info("%cModifying system resources may cause the system to malfunction.", 'color: gray; background: transparent; font-size: 1.5em;');

    jQuery(()=> {

        window.fit__app_main__content__wrapper();

    });

    /**
     * Fit content wrapper
     * @return null
     **/
    window.fit__app_main__content__wrapper = function()
    {
        /* para mag fit ang content sa main app template kay automatic ang size sa top bar */ 
        $('.topbar__topbar')
        .each((index_group_topbar, element_group_topbar) => {

            let topbar = $(element_group_topbar);

            $('.app-main__content-wrapper')
            .each((index_content_wrapper, element_content_wrapper) => { 

                $(element_content_wrapper)
                .css('height', `calc(100% - ${topbar.outerHeight()}px)`);
                
            });

        });
    }

})();