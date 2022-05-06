(function(){

    jQuery(() => {
        $("[data-bs-toggle='tooltip']").tooltip();
        $("[data-bs-toggle='popover']").popover();
        $("select").selectpicker({
            search : true
        });
    });



})();


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
        <li id="item-${nth_child}-id" class="list-group-item bg-transparent border-0 border-top mt-5 rounded-0 p-0 pt-2">
        <div class="d-flex align-items-center justify-content-between">
            <span class="item-header" role="text">Item ${nth_child}</span>
            <button class="btn" type="button" data-bs-toggle="tooltip" data-bs-placement="right" title="Remove item ${nth_child}" onclick="javascript:remove__item('#item-${nth_child}-id')">&times;</button>
        </div>
        <div class="container-fluid p-0 mt-2">
            <div class="row">
                <div class="col-4 pt-3 pb-4">
                    <div  class="input-group">
                        <a tabindex="0" class="input-group-text text-decoration-none text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Stock number" data-bs-content="Item stock number"><i class="fa-solid fa-barcode"></i></a>
                        <input class="form-control bg-light jo-itemno" name="stock[]" type="number" placeholder="Item No." required>
                    </div>
                </div>

                <div class="col-4 pt-3 pb-4">
                    <div class="input-group">
                        <a tabindex="0" class="input-group-text text-decoration-none text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Unit" data-bs-content="Item Unit ex: pcs, in, mm, cm"><i class="fa-solid fa-scale-balanced"></i></a>
                        <input class="form-control bg-light  jo-unit" list="default-units" name="unit[]" type="text" placeholder="Unit" required>
                        <datalist id="default-units">
                            <option value="pcs">
                            <option value="in">
                            <option value="mm">
                            <option value="cm">
                        </datalist>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 pb-4">
                    <div  class="input-group">
                        <a tabindex="0" class="input-group-text text-decoration-none text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Item description" data-bs-content="Item name or description"><i class="fa-solid fa-newspaper"></i></a>
                        <input class="form-control bg-light jo-description" name="description[]" type="text" placeholder="Item description" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-4 pb-3">
                    <div class="input-group">
                        <a tabindex="0" class="input-group-text text-decoration-none text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Quantity" data-bs-content="Item quantity"><i class="fa-solid fa-calculator"></i></a>
                        <input id="quantity-id" class="form-control bg-light jo-quantity" name="qty[]" type="number" placeholder="Quantity" required onkeyup="javascript:calc_quantity(this.value)">
                    </div>
                </div>

                <div class="col-4 pb-3">
                    <div class="input-group">
                        <a tabindex="0" class="input-group-text text-decoration-none text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Unit cost" data-bs-content="Item cost per unit"><i class="fa-solid fa-coins"></i></a>
                        <input id="unitcost-id" class="form-control bg-light jo-unitcost" name="unitcost[]" type="number"  placeholder="Unit cost" required onkeyup="javascript:calc_cost(this.value)">
                    </div>
                </div>

                <div class="col-4 pb-3">
                    <div class="input-group">
                        <a tabindex="0" class="input-group-text text-decoration-none text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Total cost" data-bs-content="Item total cost"><i class="fa-solid fa-peso-sign"></i></a>
                        <input id="total-amount-id" class="form-control bg-light jo-totalamount" name="totalcost[]" type="number"  placeholder="Total Amount" required>
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
 * Calculate Quantity with cost
 * @return void
 * 
 */

 /**
 * 
 * Calculate unitcost with qty
 * @return void
 * 
 */


/**
 * 
 * Generate Form 
 * @return void
 * 
 */
function generate__jo_form()
{   
    let item_fields , 
        req_A , 
        req_B ,
        rec_A , 
        rec_B ;
    
    item_fields = [
        'stock[]', 'unit[]', 'description[]', 'qty[]', 'unitcost[]', 'totalcost[]'
    ];
    
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


    // kinsay nag requqest sa form
    req_A = $('#req-name').val();
    
    // unsay designation sa nag request
    req_B = $('#req-designation').text();

    // conforme
    rec_A = $('#conforme-name').val();

    // date
    var today = new Date();
    var date = (today.getMonth()+1)+'/'+today.getDate()+'/'+today.getFullYear();

    let form_data = {
        'items' : arranged_data,
        'req_A' : req_A ,
        'req_B' : req_B ,
        'conforme' : rec_A ,
        'date' : date
    };

    (function(){
        
        let invalid = false;

        arranged_data.forEach((row) => {
            row.forEach((col) => {

                if (col === "")
                    invalid = true;

            });
        });

        if(invalid)
            return $('#jo-form__on-error-modal').modal('show');
        else
            return window.open(`/newjoborder/viewjoform?data=${JSON.stringify(form_data)}`);
    })();
    
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





