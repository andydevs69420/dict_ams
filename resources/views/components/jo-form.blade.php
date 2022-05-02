<form id="validation-form">
    {{-- MODAL --}}
    <div id="jo-form__on-error-modal" class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">{{ __("Warning") }}</h5>
                    <button type="button" class="btn-close rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Required field(s) cannot be nullified!
                </div>
                <div class="modal-footer">
                    <div class="mx-auto shadow">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Ok</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- JO FORM --}}
    <div class="card border-0 shadow-lg">
        <div class="jo-form__card-header card-header mt-3 pb-0 border-0 bg-white">
            <p class="fw-bold">&nbspItem Information</p>
        </div>
        <div class="card-body p-0">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <ul id="item-list-id"class="list-group">

                            {{-- default item --}}

                            @foreach ($getItems() as $itm)

                                {{-- 

                                    $itm[0] para sa stock
                                    $itm[1] para sa unit
                                    $itm[2] para sa description
                                    $itm[3] para sa Quanity
                                    $itm[4] para sa Unit cost
                                    $itm[5] para sa Total cost

                                --}}

                                <li class="list-group-item bg-transparent border-0 rounded-0 p-0">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <span class="item-header" role="text">Job Order Item 1</span>
                                        <button class="btn" type="button" data-bs-toggle="tooltip" data-bs-placement="right" title="Remove item 1">&times;</button>
                                    </div>
                                    <div class="container-fluid p-0 mt-2">
                                        <div class="row">
                                            <!-- stock no group -->
                                            <div class="col-4 pt-3 pb-4">
                                                {{-- <label class="text-dark py-1"><small>Item No</small><small class="req-symbol">*</small></label> --}}
                                                <div  class="input-group">
                                                    <input class="form-control bg-light jo-itemno" name="stock[]" type="number" value="{{ $itm[0] }}" placeholder="Item No." required>
                                                </div>
                                            </div>
                                            <!-- unit group -->
                                            <div class="col-4 pt-3 pb-4">
                                                {{-- <label class="text-dark py-1"><small>Unit</small><small class="req-symbol">*</small></label> --}}
                                                <div class="input-group">
                                                    <input class="form-control bg-light  jo-unit" list="default-units" name="unit[]" type="text" value="{{ $itm[1] }}" placeholder="Unit" required>
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
                                            <!-- item dscription group -->
                                            <div class="col-12 pb-4">
                                                {{-- <label class="text-dark py-1"><small>Description</small><small class="req-symbol">*</small></label> --}}
                                                <div  class="input-group">
                                                    <textarea class="form-control bg-light jo-description" name="description[]" type="text" placeholder="Description" rows="2" required style="resize: none;">{{ $itm[2] }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <!-- quantity group -->
                                            <div class="col-4 pb-3">
                                                {{-- <label class="text-dark py-1"><small>Quantity</small></label> --}}
                                                <div class="input-group">
                                                    <input id="quantity-id" class="form-control bg-light jo-quantity" name="qty[]" type="number" value="{{ $itm[3] }}" placeholder="Quantity" required onkeyup="javascript:calc_quantity(this.value)">
                                                </div>
                                            </div>
                                            <!-- unit cost group -->
                                            <div class="col-4 pb-3">
                                                {{-- <label class="text-dark py-1"><small>Unit Cost</small><small class="req-symbol">*</small></label> --}}
                                                <div class="input-group">
                                                    <input id="unitcost-id" class="form-control bg-light jo-unitcost" name="unitcost[]" type="number" value="{{ $itm[4] }}" placeholder="Unit cost" required onkeyup="javascript:calc_cost(this.value)">
                                                </div>
                                            </div>
                                            <!-- total cost group -->
                                            <div class="col-4 pb-3">
                                                {{-- <label class="text-dark py-1"><small>Total Amount</small></label> --}}
                                                <div class="input-group">
                                                    {{-- <span class="input-group-text"><i class="fa-solid fa-peso-sign"></i></span> --}}
                                                    <input id="total-amount-id" class="form-control bg-light jo-totalamount" name="totalcost[]" type="number" value="{{ $itm[5] }}" placeholder="Total Amount" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <button class="jo-form__add-new-item-btn btn my-4 text-light" type="button" onclick="javascript:add__item()">
                            <i class="fa fa-plus"></i>
                            <span class="text-light" role="text">ADD NEW ITEM</span>
                        </button>
                    </div>
                    <!-- requester group -->
                    <div class="col-12 col-sm-6">
                        {{-- <label class="text-dark py-1"><small>Requested by</small></label> --}}
                        <input id="req-name" class="form-control form-control-disabled text-truncate" name="requester-name" type="text" value="{{ $getRequisitionerName() }}" placeholder="Lastname, Firstname Middle Initial" disabled>
                        <span  id="req-designation" class="form-text text-center text-truncate small">{{ $requesterDesign }}</span>
                    </div>
                    <!-- conforme group -->
                    <div class="cil-12 col-sm-6">
                        {{-- <label class="text-dark py-1"><small>Conforme</small></label> --}}
                        <input id="conforme-name" class="form-control form-control-disabled text-truncate" type="text" value="{{ $conforme }}" placeholder="Conforme">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer py-4 border-0 bg-white">
            <div class="d-flex justify-content-center justify-content-lg-between align-items-center px-2">
                <button class="pr-form__generate-pr-form-btn btn btn-primary text-light float-start" type="submit" form="validation-form" onclick="javascript:generate__jo_form()">
                    <i class="fa fa-file"></i>
                    <span role="text">{{ __("GENERATE FORM") }}</span>
                </button>
                <span class="float-end text-muted" role="text">Form v0.3</span>
            </div>
        </div>
    </div>

</form>