


/*

    user.js - andydevs69420 - May 4 2022
    | submit issue if error found!!
    ;

*/

(function() {
    jQuery(()=> {
        $("#requisitioner__requisitioner-table").DataTable({
            "responsive" : true ,
            "autoWidth"  : false,
            "colReorder" : {
                realtime: true
            }
        });
    });
})();