<div class="card">
    <div class="card-header bg-primary">
        <span class="text-light">NEW PURCHASE REQUEST FORM</span>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <ul id="item-list-id"class="list-group">

                        {{-- default item --}}
                        <li class="list-group-item rounded-0">
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="fw-bold" role="text">Item 1</span>
                                <button class="btn" type="button" data-bs-toggle="tooltip" data-bs-placement="right" title="Remove item 1">&times;</button>
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
                                    <!-- quantity group -->
                                    <div class="col-12 col-sm-6">
                                        <label class="text-dark py-1"><small>Qty*</small></label>
                                        <div class="input-group">
                                            <input class="form-control bg-light" name="qty[]" type="number" placeholder="Qty" required>
                                        </div>
                                    </div>
                                    <!-- unit cost group -->
                                    <div class="col-12 col-sm-6">
                                        <label class="text-dark py-1"><small>Unit cost*</small></label>
                                        <div class="input-group">
                                            <input class="form-control bg-light" name="unitcost[]" type="number" placeholder="Unit cost" required>
                                        </div>
                                    </div>
                                    <!-- total cost group -->
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
                    </ul>
                    <button class="btn btn-primary float-end my-2" type="button" onclick="javascript:add_item()">
                        <i class="fa fa-plus"></i>
                        <span class="text-light" role="text">ADD ITEM</span>
                    </button>
                </div>
                <!-- purpose group -->
                <div class="col-12">
                    <label for="purpose-field" class="text-dark py-1"><small>Purpose*</small></label>
                    <div  class="input-group">
                        <textarea id="purpose-field" class="form-control bg-light" form="new-purchase-request-form" name="purpose" placeholder="Purpose" rows="2" required style="resize: none;">{{ $purpose }}</textarea>
                    </div>
                </div>
                <!-- requester group -->
                <div class="col-12 col-sm-6">
                    <label class="text-dark py-1"><small>Requested by</small></label>
                    <input id="req-name" class="form-control form-control-disabled text-truncate" name="requester-name" type="text" value="{{ $requester }}" placeholder="Lastname, Firstname MiddleInitial" disabled>
                    <span  id="req-designation" class="form-text text-center text-truncate small">{{ $requesterDesign }}</span>
                </div>
                <div class="cil-12 col-sm-6">
                    <label class="text-dark py-1"><small>Recommending Approval</small></label>
                    <input id="rec-approval-name" class="form-control form-control-disabled text-truncate" list="recommending-approval-list" name="requester-designation" type="text">
                    <datalist id="recommending-approval-list">
                        @for ($i = 0; $i < 20; $i++)
                            <option value="PERSON-{{ $i }}">{{ $i }}</option>
                        @endfor
                    </datalist>
                    <span  id="req-designation" class="form-text text-center text-truncate small">...</span>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="d-flex justify-content-between align-items-center">
            <button class="btn btn-primary text-light float-start" type="button" onclick="javascript:generate__pr_form()">
                <i class="fa fa-code"></i>
                <span role="text">GENERATE FORM</span>
            </button>
            <span class="float-end text-muted" role="text">Form v0.2</span>
        </div>
    </div>
</div>