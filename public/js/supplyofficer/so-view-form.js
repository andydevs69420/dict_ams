function generate__pqs_form(id){
    canvasser = $('.selectPicker').val();

    // date
    today = new Date();
    date = (today.getMonth()+1)+'/'+today.getDate()+'/'+today.getFullYear();

    let form_data = {
        'formid' : id,
        'canvasserid': canvasser,
        'date': date,
    };
    return window.open(`/so_approvedforms/generatepqs?data=${JSON.stringify(form_data)}`);

}

$(document).ready((evt) => {

    $('[data-bs-toggle="tooltip"]').tooltip();

});
