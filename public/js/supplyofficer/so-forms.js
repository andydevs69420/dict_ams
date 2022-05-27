function view_form(id){

    let form_data = {
        'formid' : id,
    };
    return window.location.href = `/so_approvedforms/viewform?data=${JSON.stringify(form_data)}`;
    }


    $(document).ready(function () {
        $('#so-forms-table').DataTable();
});