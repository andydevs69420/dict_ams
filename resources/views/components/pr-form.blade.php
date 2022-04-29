

{{-- MODAL --}}
<div id="pr-form__on-error-modal" class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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

                    <ul id="item-list-id" class="list-group">

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

                            <li id="pr-form__item-template-default" class="list-group-item bg-transparent border-0 rounded-0 p-0">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="fw-bold" role="text">Item 1</span>
                                    <button class="btn rounded-circle" type="button" data-bs-toggle="tooltip" data-bs-placement="right" title="Remove item 1">&times;</button>
                                </div>
                                <div class="container-fluid p-0">
                                    <div class="row">
                                        <!-- stock no group -->
                                        <div class="col-12 col-sm-6">
                                            <div class="input-group my-2 shadow">
                                                <a tabindex="0" class="input-group-text text-decoration-none text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Stock number" data-bs-content="Item stock number"><i class="fa-solid fa-barcode"></i></a>
                                                <input class="form-control border-0 bg-white" name="stock[]" type="number" value="{{ $itm[0] }}" placeholder="{{ __("Stock no.") }}">
                                            </div>
                                        </div>
                                        <!-- unit group -->
                                        <div class="col-12 col-sm-6">
                                            <div class="input-group my-2 shadow">
                                                <a tabindex="0" class="input-group-text text-decoration-none text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Unit" data-bs-content="Item Unit ex: pcs, in, mm, cm"><i class="fa-solid fa-scale-balanced"></i></a>
                                                <input class="form-control border-0 bg-white" list="default-units" name="unit[]" type="text" value="{{ $itm[1] }}" placeholder="{{ __("Unit") }}" required>
                                                <datalist id="default-units">
                                                    <option value="pcs">
                                                    <option value="in">
                                                    <option value="mm">
                                                    <option value="cm">
                                                </datalist>
                                            </div>
                                        </div>
                                        <!-- item description group -->
                                        <div class="col-12 col-sm-6">
                                            <div class="input-group my-3 shadow">
                                                <a tabindex="0" class="input-group-text text-decoration-none text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Item description" data-bs-content="Item name or description"><i class="fa-solid fa-newspaper"></i></a>
                                                @if(strlen($itm[2]) > 0)
                                                    <input class="form-control border-0 bg-white" name="description[]" type="text" value="{{ $itm[2] }}" placeholder="{{ __("Item description") }}" required>
                                                @else
                                                    <select id="budget-officer-name" class="selectPicker form-select p-0 border-0 bg-white" name="budget-officer-name" data-live-search="true" required>
                                                        @foreach(App\Models\ItemList::getAllitems() as $item)
                                                            <option value="{{ $item->itemlist_id }}">
                                                                {{ $item->itemname }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- quantity group -->
                                        <div class="col-12 col-sm-6">
                                            <div class="input-group my-3 shadow">
                                                <a tabindex="0" class="input-group-text text-decoration-none text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Quantity" data-bs-content="Item quantity"><i class="fa-solid fa-calculator"></i></a>
                                                <input class="form-control border-0 bg-white" name="qty[]" type="number" value="{{ $itm[3] }}" placeholder="{{ __("Qty") }}">
                                            </div>
                                        </div>
                                        <!-- unit cost group -->
                                        <div class="col-12 col-sm-6">
                                            <div class="input-group my-3 shadow">
                                                <a tabindex="0" class="input-group-text text-decoration-none text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Unit cost" data-bs-content="Item cost per unit"><i class="fa-solid fa-coins"></i></a>
                                                <input class="form-control border-0 bg-white" name="unitcost[]" type="number" value="{{ $itm[4] }}" placeholder="{{ __("Unit cost") }}">
                                            </div>
                                        </div>
                                        <!-- total cost group -->
                                        <div class="col-12 col-sm-6">
                                            <div class="input-group my-3 shadow">
                                                <a tabindex="0" class="input-group-text text-decoration-none text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Total cost" data-bs-content="Item total cost"><i class="fa-solid fa-peso-sign"></i></a>
                                                <input class="form-control border-0 bg-white" name="totalcost[]" type="number" value="{{ $itm[5] }}" placeholder="{{ __("Total cost") }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- purpose group -->
                <div class="col-12">
                    <div class="input-group my-3 shadow">
                        <a tabindex="0" class="input-group-text text-decoration-none text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Purpose" data-bs-content="Purpose for purchasing"><i class="fa-solid fa-rocket"></i></a>
                        <input id="purpose-field" class="form-control border-0 bg-white" name="purpose" value="{{ $getPurpose() }}" placeholder="{{ __("Purpose") }}" required>
                    </div>
                </div>
                <!-- add item -->
                <div class="col-12">
                    <div class="my-3 shadow">
                        <button class="pr-form__add-new-item-btn btn text-light" type="button" name="add-item-btn" onclick="javascript:window.add__item()">
                            <i class="fa fa-plus"></i>
                            <span class="text-light" role="text">{{ __("ADD NEW ITEM") }}</span>
                        </button>
                    </div>
                    <hr class="d-block d-lg-none bg-info">
                </div>
                <!-- requester group -->
                <div class="col-12">
                    <div class="input-group my-3 shadow">
                        <a tabindex="0" class="input-group-text text-decoration-none text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Requisitioner" data-bs-content="Purchase requisitioner"><i class="fa-solid fa-user"></i></a>
                        <select id="req-name" class="selectPicker form-select p-0 border-0 bg-white" name="requester-name" data-live-search="true" required>
                            @if(strlen($getRequisitionerName()) > 0)
                                <option value="{{ $getRequisitionerId() }}" selected disabled>
                                    {{ $getRequisitionerName() }} - ({{ App\Models\Accesslevel::getAccesslevelById($getRequisitionerAccessLevelId()) }})
                                </option>
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
                <!-- budget officer group -->
                <div class="col-12">
                    <div class="input-group my-3 shadow">
                        <a tabindex="0" class="input-group-text text-decoration-none text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Budget Officer" data-bs-content="Target budget officer"><i class="fa-solid fa-user"></i></a>
                        <select id="budget-officer-name" class="selectPicker form-select p-0 border-0 bg-white" name="budget-officer-name" data-live-search="true" required>
                            @if(strlen($getBudgetOfficerName()) > 0)
                                <option value="{{ $getBudgetOfficerId() }}" selected disabled>
                                    {{ $getBudgetOfficerName() }} - ({{ App\Models\Accesslevel::getAccesslevelById($getBudgetOfficerAccessLevelId()) }})
                                </option>
                            @else
                                @foreach(App\Models\UserVerificationDetails::getAllBudgetOfficer() as $budgetOfficer)
                                    <option value="{{ $budgetOfficer->user_id }}">
                                        {{ $budgetOfficer->lastname }}, {{ $budgetOfficer->firstname }} {{ $budgetOfficer->middleinitial }} - ({{ App\Models\Accesslevel::getAccesslevelById($budgetOfficer->accesslevel_id) }})
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <!-- recommending approval group -->
                <div class="col-12">
                    <div class="input-group my-3 shadow">
                        <a tabindex="0" class="input-group-text text-decoration-none text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Recommending approval" data-bs-content="Target recommending approval"><i class="fa-solid fa-user"></i></a>
                        @if(strlen($getRecommendingApprovalName()) > 0)
                            <input id="rec-approval-name" class="form-control border-0 bg-white text-truncate"  name="recommending-approval" type="text" value="{{ $getRecommendingApprovalName() }}" placeholder="{{ __("Recommending Approval") }}" required disabled>
                        @else
                            <select id="rec-approval-name" class="selectPicker form-select p-0 border-0 bg-white" name="recommending-approval" data-live-search="true" required>
                                @foreach(App\Models\UserVerificationDetails::getAllRecommendingApprovalByAccesslevelId(Auth::user()->accesslevel_id) as $recommendingApprover)
                                    <option value="{{ $recommendingApprover->user_id }}">
                                        {{ $recommendingApprover->lastname }}, {{ $recommendingApprover->firstname }} {{ $recommendingApprover->middleinitial }} - ({{ App\Models\Accesslevel::getAccesslevelById($recommendingApprover->accesslevel_id) }})
                                    </option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer py-2 py-lg-3 border-0 bg-white">
        <div class="d-flex align-items-center justify-content-center justify-content-lg-between px-2">
            <span class="shadow">
                <button class="pr-form__generate-pr-form-btn btn text-light" type="submit" name="generate-form-btn" form="validation-form" onclick="javascript:generate__pr_form()">
                    <i class="fa fa-file"></i>
                    <span role="text">{{ __("GENERATE FORM") }}</span>
                </button>
            </span>
            <span class="small text-muted" role="text">{{ __("Form v0.4") }}</span>
        </div>
    </div>
</div>

