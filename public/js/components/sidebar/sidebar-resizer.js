



$(document)
.ready(() => {
    
    fit__sidebar__sidebar_wrapper_scrollable();
    
});


function fit__sidebar__sidebar_wrapper_scrollable()
{
    /* pang resize lang ni sa container atong mga links */
    $('.sidebar__navbar-brand-group')
    .each((index_group_0,this__group_0) => {

        let resize_basis = $(this__group_0);

        $('.sidebar__sidebar-wrapper-scrollable')
        .each((index_group_1,this__group_1) => {
            $(this__group_1)
            .css('height', `calc(100% - ${resize_basis.outerHeight()}px)`);
        });

    });
}