

(function(){

    jQuery(() => {

        $("#job-order-list__job-order-list-table").DataTable({
            "responsive" : true ,
            "autoWidth"  : false,
            "colReorder" : {
                realtime: true
            }
        });

    });

})();
