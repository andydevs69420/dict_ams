
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
        <div class="jo-form__card-header card-header mt-3 mb-0 pb-0 border-0 bg-white">
            <p>&nbspItem Information</p>
        </div>
        <div class="card-body p-0">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <ul id="item-list-id"class="list-group">

                            
                            {{-- default item --}}
                            <?php $idx = 0; ?>
                            @foreach ($getItems() as $itm)
                 
                                <li @if ($idx !== 0) id="item-{{$idx+1}}-id" @else id="pr-form__item-template-default" @endif class="list-group-item bg-transparent border-0 rounded-0 p-0">
                                
                                @if ($idx !== 0)
                                    <hr class="bg-info">
                                @endif

                                <li class="list-group-item bg-transparent border-0 rounded-0 p-0">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <span class="item-header" role="text">Item 1</span>
                                        <button class="btn" type="button" data-bs-toggle="tooltip" data-bs-placement="right" title="Remove item 1">&times;</button>
                                    </div>
                                    <div class="container-fluid p-0 mt-2">
                                        <div class="row">
                                            <!-- item no group -->
                                            <div class="col-4 pt-3 pb-4">
                                                <div  class="input-group">
                                                    <a tabindex="0" class="input-group-text text-decoration-none text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Stock number" data-bs-content="Item stock number"><i class="fa-solid fa-barcode"></i></a>
                                                    <input class="form-control bg-light jo-itemno" name="stock[]" type="number" value="{{ $itm["itemno"] }}" placeholder="Item No." required>
                                                </div>
                                            </div>
                                            <!-- unit group -->
                                            <div class="col-4 pt-3 pb-4">
                                                <div class="input-group">
                                                    <a tabindex="0" class="input-group-text text-decoration-none text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Unit" data-bs-content="Item Unit ex: pcs, in, mm, cm"><i class="fa-solid fa-scale-balanced"></i></a>
                                                    <input class="form-control bg-light  jo-unit" list="default-units" name="unit[]" type="text" value="{{ $itm["unit"] }}" placeholder="Unit" required>
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
                                                <div  class="input-group">
                                                    <a tabindex="0" class="input-group-text text-decoration-none text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Item description" data-bs-content="Item name or description"><i class="fa-solid fa-newspaper"></i></a>
                                                    <input class="form-control bg-light jo-description" name="description[]" type="text" value="{{ $itm["description"] }}" placeholder="{{ __("Item description") }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <!-- quantity group -->
                                            <div class="col-4 pb-3">
                                                <div class="input-group">
                                                    <a tabindex="0" class="input-group-text text-decoration-none text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Quantity" data-bs-content="Item quantity"><i class="fa-solid fa-calculator"></i></a>
                                                    <input id="quantity-id" class="form-control bg-light jo-quantity" name="qty[]" type="number" value="{{ $itm["quantity"] }}" placeholder="Quantity" required onkeyup="javascript:calc_quantity(this.value)">
                                                </div>
                                            </div>
                                            <!-- unit cost group -->
                                            <div class="col-4 pb-3">
                                                <div class="input-group">
                                                    <a tabindex="0" class="input-group-text text-decoration-none text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Unit cost" data-bs-content="Item cost per unit"><i class="fa-solid fa-coins"></i></a>
                                                    <input id="unitcost-id" class="form-control bg-light jo-unitcost" name="unitcost[]" type="number" value="{{ $itm["unitcost"] }}" placeholder="Unit cost" required onkeyup="javascript:calc_cost(this.value)">
                                                </div>
                                            </div>
                                            <!-- total cost group -->
                                            <div class="col-4 pb-3">
                                                <div class="input-group">
                                                    <a tabindex="0" class="input-group-text text-decoration-none text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Total cost" data-bs-content="Item total cost"><i class="fa-solid fa-peso-sign"></i></a>
                                                    <input id="total-amount-id" class="form-control bg-light jo-totalamount" name="amount[]" type="number" value="{{ $itm["amount"] }}" placeholder="Total Amount" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <div class="col-12">
                            <div class="d-inline-block my-3 shadow float-end">
                                <button class="jo-form__add-new-item-btn btn text-light" type="button" name="add-item-btn" onclick="javascript:window.add__item()">
                                    <i class="fa fa-plus"></i>
                                    <span class="text-light" role="text">{{ __("ADD NEW ITEM") }}</span>
                                </button>
                            </div>
                            <hr class="d-block d-lg-none bg-info">
                        </div>
                    </div>
                    <!-- requester group -->
                    <div class="col-12">
                        <div class="input-group my-4">
                            <a tabindex="0" class="input-group-text text-decoration-none text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Requisitioner" data-bs-content="Job order requisitioner"><i class="fa-solid fa-user"></i></a>
                            <input id="req-name" class="form-control form-control-disabled text-truncate" name="requester-name" type="text" value="{{ $getRequisitionerName() }}" placeholder="Lastname, Firstname Middle Initial" disabled>
                            <span  id="req-designation" class="form-text text-center text-truncate small">{{ $requesterDesign }}</span>
                        </div>
                    </div>
                    <!-- conforme group -->
                    <div class="col-12">
                        <div class="input-group mb-4">
                            <a tabindex="0" class="input-group-text text-decoration-none text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Conforme" data-bs-content="Job order conforme"><i class="fa-solid fa-user"></i></a>
                            <input id="conforme-name" name="conforme-name" class="form-control bg-light form-control-disabled text-truncate" type="text" value="{{ $conforme }}" placeholder="Conforme">
                        </div>
                    </div>
                    <!-- authorized official group -->
                    <div class="col-12">
                        <div class="input-group mb-4">
                            <a tabindex="0" class="input-group-text text-decoration-none text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Authorized Official" data-bs-content="Authorized official"><i class="fa-solid fa-user"></i></a>
                            <input id="authofficial-name" name="authofficial-name" class="form-control bg-light form-control-disabled text-truncate" type="text" value="{{ $authofficial }}" placeholder="Authorized Official">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer py-4 border-0 bg-white">
            <div class="d-flex justify-content-center justify-content-lg-between align-items-center px-2">
                <button class="jo-form__generate-jo-form-btn btn btn-primary text-light float-start" type="submit" form="validation-form" onclick="javascript:generate__jo_form()">
                    <i class="fa fa-file"></i>
                    <span role="text">{{ __("GENERATE FORM") }}</span>
                </button>
                <span class="float-end text-muted" role="text">Form v0.4</span>
            </div>
        </div>
    </div>

