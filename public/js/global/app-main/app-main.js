

$(document)
.ready(() => {
    
    fit__content__wrapper();

});

function fit__content__wrapper()
{
    /* para mag fit ang content sa main app template kay automatic ang size sa top bar */ 
    let topbar = $('#topbar');

    $('#content-wrapper')
    .css('height', `calc(100% - ${topbar.height()}px)`);
}