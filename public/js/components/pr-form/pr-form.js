
/**
 * 
 * Item addtion and removal 
 * @return void
 * 
 */
function add__item()
{
    let item_list, nth_child;

    item_list = $('#item-list-id');
    nth_child = (item_list.children().length + 1);

    item_list
    .append($(`
        <li id="item-${nth_child}-id" class="list-group-item rounded-0">
            <div class="d-flex align-items-center justify-content-between">
                <span class="fw-bold" role="text">Item ${nth_child}</span>
                <button class="btn" type="button" data-bs-toggle="tooltip" data-bs-placement="right" title="Remove item ${nth_child}" onclick="javascript:remove__item('#item-${nth_child}-id')">&times;</button>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <!-- stock no group -->
                    <div class="col-12 col-sm-6">
                        <label class="text-dark py-1"><small>Stock no*</small></label>
                        <div  class="input-group">
                            <input class="form-control bg-light" name="stock[]" type="number" placeholder="Stock no." required>
                        </div>
                    </div>
                    <!-- unit group -->
                    <div class="col-12 col-sm-6">
                        <label class="text-dark py-1"><small>Unit*</small></label>
                        <div class="input-group">
                            <input class="form-control bg-light" list="default-units" name="unit[]" type="text" placeholder="Unit" required>
                            <datalist id="default-units">
                                <option value="pcs">
                                <option value="in">
                                <option value="mm">
                                <option value="cm">
                            </datalist>
                        </div>
                    </div>
                    <!-- item dscription group -->
                    <div class="col-12">
                        <label class="text-dark py-1"><small>Item description*</small></label>
                        <div  class="input-group">
                            <textarea class="form-control bg-light" form="new-purchase-request-form" name="description[]" placeholder="Item description" rows="2" required style="resize: none;"></textarea>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <label class="text-dark py-1"><small>Qty*</small></label>
                        <div class="input-group">
                            <input class="form-control bg-light" name="qty[]" type="number" placeholder="Qty" required>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <label class="text-dark py-1"><small>Unit cost*</small></label>
                        <div class="input-group">
                            <input class="form-control bg-light" name="unitcost[]" type="number" placeholder="Unit cost" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="text-dark py-1"><small>Total cost</small></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-peso-sign"></i></span>
                            <input class="form-control bg-light" name="totalcost[]" type="number" placeholder="Total cost" required>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    `));
}

/**
 * 
 * Remove Item N
 * @param String id_query_selector mao ning id sa <li> nga nag hawid sa item
 * @return void
 * 
 */
function remove__item(id_query_selector)
{ $(id_query_selector).remove(); }


/**
 * 
 * Search recommending approval
 * @param Object rec_approval_name_input
 * @return void
 * 
 */
async function search__recommending_approval(requisitionerid,rec_approval_name_input)
{
    let input_Field, rec_approval_list, rec_approval_design;

    // mao ning input sa user(recommending appoval)
    input_Field = $(rec_approval_name_input);

    // diri ibutang ang mga serch result based sa input
    rec_approval_list = $('#recommending-approval-list');

    // diri ibutangang designation sa selected approver
    rec_approval_design = $('#rec-designation');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // $.ajax lang instead sa .load() para naa tay control sa child
    await $.ajax({
        url: '/newpurchaserequest/searchforapproval',
        type: 'POST',
        data: {'requisitionerid': requisitionerid,'search': input_Field.val()},
        dataType: 'json',
        success: (response, status, request) => {

            if  (input_Field.val().length > 0 && status === 'success')
            {
                rec_approval_list.empty();

                let data = response,
                    user_identf,
                    user_design,
                    user_fullnm;
              
                data.forEach((user) => {
                   
                    user_identf = user['id'];
                    user_design = user['designation_name'];
                    user_access = user['accesslevel_name'];
                    user_fullnm = `${user['lastname']}, ${user['firstname']} ${user['middleinitial']}`;

                    rec_approval_list.append(
                        $(`<option value="${user_fullnm}"></option>`)
                    );

                    input_Field.change((evt) => {
                        rec_approval_design.text(user_design + ', ' + user_access);
                    });

                });
            }
            else
            {
                rec_approval_list.empty();
                rec_approval_design.text('...');
            }

        }
    });
}

/**
 * 
 * Generate Form 
 * @return void
 * 
 */
function generate__pr_form()
{   
    let item_fields , 
        purps ,
        req_A , 
        req_B ,
        rec_A , 
        rec_B ;
    
    item_fields = [
        'stock[]', 'unit[]', 'description[]', 'qty[]', 'unitcost[]', 'totalcost[]'
    ];
    
    
    /**
      * 
      * Ingon ani siya tanawon ug e print
      * [
      *   [stock, unit, item description, qty, unit cost, total cost], item-0
      *   .
      *   .
      *   [stock, unit, item description, qty, unit cost, total cost]  item-N
      * ]
      * 
      */
    let arranged_data = [];

    // row count
    let rcount = $(`[name='${item_fields[0]}']`).length;

    // rows
    for (let i = 0; i < rcount; i++)
    {   
        // item_N: where N is the current Item number OR N == i.
        let item_N = [];
        // columns
        for (let j = 0; j < item_fields.length; j++)
        {
            let col = $(`[name='${item_fields[j]}']`);
            item_N.push($(col[i]).val());
        }
        arranged_data.push(item_N);
    }

    // purpose sa pag purchase
    purps = $('#purpose-field').val();

    // kinsay nag requqest sa form
    req_A = $('#req-name').val();
    // unsay designation sa nag request
    req_B = $('#req-designation').text();

    // kinsay ge recommend mag approve
    rec_A = $('#rec-approval-name').val();
    // unsay designation sa mag approve
    rec_B = $('#rec-designation').text();
    
    let form_data = {
        'items' : arranged_data,
        'purps' : purps ,
        'req_A' : req_A ,
        'req_B' : req_B ,
        'rec_A' : rec_A ,
        'rec_B' : rec_B ,
    };

    window.open(`/newpurchaserequest/viewprform?data=${JSON.stringify(form_data)}`);
}

/**
 * 
 * File upload display
 *  
 */
$('#file-pick-id')
.change((e) => {

    let file = e.target.files;

    for (let idx = 0; idx < file.length; idx++)
    {
        let filereader = new FileReader();
        filereader.readAsDataURL(file[idx]);
        filereader.onloadend = (data) => {
            $('#file-content-id')
            .append($(`<a class="d-inline-block px-4 border rounded-pill bg-light text-nowrap text-truncate text-decoration-none" href="${data.currentTarget.result}" target="__blank" style="max-width: 100%;"><small>${file[idx].name}</small></a>`));
        }
    }
    
});





