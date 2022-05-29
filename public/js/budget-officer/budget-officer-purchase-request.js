

(function() {

    jQuery(() => {

        $("#pr-list__pr-list-table").DataTable({
            "responsive" : true ,
            "autoWidth"  : false,
            "colReorder" : {
                realtime : true
            }
        });

    });

})();


