



$(document)
.ready(() => {
    
   fit__sidebar_wrapper_scrollable();
    
});


function fit__sidebar_wrapper_scrollable()
{
    /* pang resize lang ni sa container atong mga links */
    let resize_basis  = $('#navbar-brand-group');

    $('#sidebar-wrapper-scrollable')
    .css('maxHeight', `calc(100% - ${resize_basis.height()}px)`);
}