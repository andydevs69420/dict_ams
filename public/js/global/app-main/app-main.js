

$(document)
.ready(() => {
    
    fit__app_main__content__wrapper();

});

function fit__app_main__content__wrapper()
{
    /* para mag fit ang content sa main app template kay automatic ang size sa top bar */ 
    $('.topbar__topbar-group')
    .each((index_group_topbar, element_group_topbar) => {

        let topbar = $(element_group_topbar);

        $('.app-main__content-wrapper')
        .each((index_content_wrapper, element_content_wrapper) => { 

            $(element_content_wrapper)
            .css('height', `calc(100% - ${topbar.outerHeight()}px)`);
            
        });

    });
}