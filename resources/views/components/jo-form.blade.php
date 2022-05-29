
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
    <div class="card-header py-3 border-0 bg-white">
        <div class="d-block px-2">
            <x-progressbar id="pr-progress"></x-progressbar>
        </div>
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

                            <li id="jo-form__jo-item-template" class="list-group-item bg-transparent border-0 rounded-0 p-0">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="fw-bold" role="text">Item {{ $idx+1 }}</span>
                                    <button class="btn rounded-circle" type="button" data-bs-toggle="tooltip" data-bs-placement="right" title="Remove item 1">&times;</button>
                                </div>
                                <div class="container-fluid p-0 mt-2">
                                    <div class="row">
                                        <!-- item no group -->
                                        <div class="col-6">

                                            <div class="input-group my-2 shadow">
                                                <a tabindex="0" class="input-group-text text-decoration-none text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Stock number" data-bs-content="Item stock number"><i class="fa-solid fa-barcode"></i></a>
                                                <input class="form-control border-0 bg-white jo-itemno" name="stock[]" type="number" value="{{ $itm["itemno"] }}" placeholder="Item No." required>
                                            </div>
                                        </div>
                                        <!-- unit group -->
                                        <div class="col-6">
                                            <div class="input-group my-2 shadow">
                                                <a tabindex="0" class="input-group-text text-decoration-none text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Unit" data-bs-content="Item Unit ex: pcs, in, mm, cm"><i class="fa-solid fa-scale-balanced"></i></a>
                                                <input class="form-control border-0 bg-white jo-unit" list="default-units" name="unit[]" type="text" value="{{ $itm["unit"] }}" placeholder="Unit" required>
                                                <datalist id="default-units">
                                                    <option value="pcs">
                                                    <option value="in">
                                                    <option value="mm">
                                                    <option value="cm">
                                                </datalist>
                                            </div>
                                        </div>
                                        <!-- job dscription group -->
                                        <div class="col-12">
                                            <div  class="input-group my-2 shadow">
                                                <a tabindex="0" class="input-group-text text-decoration-none text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Job description" data-bs-content="Job name or description"><i class="fa-solid fa-newspaper"></i></a>
                                                <textarea class="form-control border-0 bg-white jo-description" rows="1" name="description[]" type="text" placeholder="{{ __("Job description") }}" required>{{ $itm["description"] }}</textarea>
                                            </div>
                                        </div>
                                        <!-- quantity group -->
                                        <div class="col-12">
                                            <div class="input-group my-2 shadow">
                                                <a tabindex="0" class="input-group-text text-decoration-none text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Quantity" data-bs-content="Item quantity"><i class="fa-solid fa-calculator"></i></a>
                                                <input id="quantity-id" class="form-control border-0 bg-white jo-quantity" name="qty[]" type="number" value="{{ $itm["quantity"] }}" placeholder="Quantity" required onkeyup="javascript:calc_quantity(this.value)">
                                            </div>
                                        </div>
                                        <!-- unit cost group -->
                                        <div class="col-6">
                                            <div class="input-group my-2 shadow">
                                                <a tabindex="0" class="input-group-text text-decoration-none text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Unit cost" data-bs-content="Item cost per unit"><i class="fa-solid fa-coins"></i></a>
                                                <input id="unitcost-id" class="form-control border-0 bg-white jo-unitcost" name="unitcost[]" type="number" value="{{ $itm["unitcost"] }}" placeholder="Unit cost" required onkeyup="javascript:calc_cost(this.value)">
                                            </div>
                                        </div>
                                        <!-- total cost group -->
                                        <div class="col-6">
                                            <div class="input-group my-2 shadow">
                                                <a tabindex="0" class="input-group-text text-decoration-none text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Total cost" data-bs-content="Item total cost"><i class="fa-solid fa-peso-sign"></i></a>
                                                <input id="total-amount-id" class="form-control border-0 bg-white jo-totalamount" name="amount[]" type="number" value="{{ $itm["amount"] }}" placeholder="Total Amount" required>
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
                <!-- conforme group -->
                <div class="col-12">
                    <div class="input-group my-2 shadow">
                        <a tabindex="0" class="input-group-text text-decoration-none text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Conforme" data-bs-content="Job order conforme"><i class="fa-solid fa-user"></i></a>
                        <input id="conforme-name" name="conforme-name" class="form-control border-0 bg-white form-control-disabled text-truncate" type="text" value="{{ $conforme }}" placeholder="Conforme">
                    </div>
                </div>
                <!-- requester group -->
                <div class="col-12">
                    <div class="input-group shadow my-2">
                        <a tabindex="0" class="input-group-text text-decoration-none text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Requisitioner" data-bs-content="Job order requisitioner"><i class="fa-solid fa-user"></i></a>
                        <select id="req-name" class="selectPicker form-select p-0 border-0 bg-white" name="requester-name" type="text" value="{{ $getRequisitionerName() }}" placeholder="Lastname, Firstname Middle Initial" required>

                            @if(strlen($getRequisitionerName()) > 0)
                                <option value="{{ $getRequisitionerId() }}" selected>{{ $getRequisitionerName() }} - ({{ \App\Models\Accesslevel::getAccesslevelById($getRequisitionerAccesslevelId()) }})</option>
                            @else
                                @foreach(App\Models\UserVerificationDetails::getAllRequisitioner() as $requisitioner)
                                    <option value="{{ $requisitioner->user_id }}">
                                        {{ $requisitioner->lastname }}, {{ $requisitioner->firstname }} {{ $requisitioner->middleinitial }} - ({{ App\Models\Accesslevel::getAccesslevelById($requisitioner->accesslevel_id) }})
                                    </option>
                                @endforeach
                            @endif

                        </select>
                    </div>
                </div>
                <!-- authorized official group -->
                <div class="col-12">
                    <div class="input-group my-2 shadow">
                        <a tabindex="0" class="input-group-text text-decoration-none text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Authorized Official" data-bs-content="Authorized official"><i class="fa-solid fa-user"></i></a>
                        <select id="authofficial-name" class="selectPicker form-select p-0 border-0 bg-white" name="authofficial-name" placeholder="Authorized Official" data-live-search="true" required>

                            @if(strlen($getAuthorizedOfficialName()) > 0)
                                <option value="{{ $getAuthorizedOfficialId() }}" selected>{{ $getAuthorizedOfficialName() }} - ({{ \App\Models\Accesslevel::getAccesslevelById($getAuthOfficialAccesslevelId()) }})</option>
                            @else
                                @foreach(\App\Models\UserVerificationDetails::getAllAuthorizedOfficial() as $ao)
                                    <option value="{{ $ao->user_id }}">{{ $ao->lastname . ", " . $ao->firstname . " " . $ao->middleinitial }} - ({{ \App\Models\Accesslevel::getAccesslevelById($ao->accesslevel_id) }})</option>
                                @endforeach
                            @endif

                        </select>
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

