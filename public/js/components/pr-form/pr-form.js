
/**
 * 
 * item addtion and removal 
 * 
 */

function add_item()
{
    let item_list, nth_child;

    item_list = $('#item-list-id');
    nth_child = (item_list.children().length + 1);

    item_list
    .append($(`
        <li id="item-${nth_child}-id" class="list-group-item rounded-0">
            <div class="d-flex align-items-center justify-content-between">
                <span class="fw-bold" role="text">Item ${nth_child}</span>
                <button class="btn" type="button" data-bs-toggle="tooltip" data-bs-placement="right" title="Remove item ${nth_child}" onclick="javascript: remove_item('#item-${nth_child}-id')">&times;</button>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <!-- stock no group -->
                    <div class="col-sm-6 col-md-6">
                        <label class="text-dark py-1"><small>Stock no*</small></label>
                        <div  class="input-group">
                            <input class="form-control bg-light" name="stock[]" type="number" placeholder="Stock no." required>
                        </div>
                    </div>
                    <!-- unit group -->
                    <div class="col-sm-6 col-md-6">
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
                    <div class="col-sm-6 col-md-6">
                        <label class="text-dark py-1"><small>Qty*</small></label>
                        <div class="input-group">
                            <input class="form-control bg-light" name="qty[]" type="number" placeholder="Qty" required>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
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

function remove_item(id_query_selector)
{ $(id_query_selector).remove(); }

/**
 * 
 * File upload
 *  
 */


$('#file-pick-id')
.change((e) => {

    let file_name = e.target.files[0].name;
    
    $('#file-content-id')
    .append($(`<a class="m-3 px-3 border rounded-pill bg-light text-decoration-none">${file_name}</a>`));

});