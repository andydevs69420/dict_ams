@extends("layout.app-main")

@section("title", "AMS | PR Price Quotation")

@section("dependencies")

    {{-- bootstrap-select css  --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">

    {{-- PURCHASE REQUEST css --}}
    <link rel="stylesheet" href="{{ asset("css/new-purchase-request/new-purchase-request/new-purchase-request.css") }}">
    
    {{-- NEW PURCHASE REQUEST css --}}
    <link rel="stylesheet" href="{{ asset("css/Budgetofficer/Budgetoffice.css") }}">

    {{-- PR & JO css --}}
    <link rel="stylesheet" href="{{ asset("css/components/global/pr-and-jo/pr-and-jo.css") }}">

    {{-- PROGRESS BAR css --}}
    <link rel="stylesheet" href="{{ asset("css/components/progressbar/progressbar.css") }}">

@stop

@section("content")
    <div class="d-block py-5">
        <form id="request-pr-form" action="">

            @csrf

            <div class="container">
                <div class="row">
                    <div class="col-15 col-lg-9 bg-white">
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="fw-bold" role="text">Ordered Item</span>
                            <button class="btn rounded-circle" type="button" data-bs-toggle="tooltip" data-bs-placement="right" title="Remove item 1">&times;</button>
                        </div>
                            <div class="container-fluid p-15">
                                    <div class="row">
                                        <!-- stock no group -->
                                        <div class="col-12 col-sm-6">
                                            <div class="input-group my-2 shadow">
                                                <a tabindex="0" class="input-group-text text-decoration-none text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Stock number" data-bs-content="Item stock number"><i class="fa-solid fa-barcode"></i></a>
                                                <input class="form-control border-0 bg-white" readonly="" name="stock[]" type="number" placeholder="{{ __("Stock no.") }}">
                                            </div>
                                        </div>
                                        <!-- unit group -->
                                        <div class="col-12 col-sm-6">
                                            <div class="input-group my-2 shadow">
                                                <a tabindex="0" class="input-group-text text-decoration-none text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Unit" data-bs-content="Item Unit ex: pcs, in, mm, cm"><i class="fa-solid fa-scale-balanced"></i></a>
                                                <input class="form-control border-0 bg-white" readonly="" list="default-units" name="unit[]" type="text"  placeholder="{{ __("Unit") }}" required>
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
                                                <input class="form-control border-0 bg-white" readonly="" name="description[]" type="text" placeholder="{{ __("Item description") }}" required>

                                                </select>
                                            </div>
                                        </div>
                                        <!-- quantity group -->
                                        <div class="col-12 col-sm-6">
                                            <div class="input-group my-3 shadow">
                                                <a tabindex="0" class="input-group-text text-decoration-none text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Quantity" data-bs-content="Item quantity"><i class="fa-solid fa-calculator"></i></a>
                                                <input class="form-control border-0 bg-white" name="qty[]" type="number"  placeholder="{{ __("Qty") }}">
                                            </div>
                                        </div>
                                        <!-- unit cost group -->
                                        <div class="col-12 col-sm-6">
                                            <div class="input-group my-3 shadow">
                                                <a tabindex="0" class="input-group-text text-decoration-none text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Unit cost" data-bs-content="Item cost per unit"><i class="fa-solid fa-coins"></i></a>
                                                <input class="form-control border-0 bg-white" name="unitcost[]" type="number" placeholder="{{ __("Unit cost") }}">
                                            </div>
                                        </div>
                                        <!-- total cost group -->
                                        <div class="col-12 col-sm-6">
                                            <div class="input-group my-3 shadow">
                                                <a tabindex="0" class="input-group-text text-decoration-none text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Total cost" data-bs-content="Item total cost"><i class="fa-solid fa-peso-sign"></i></a>
                                                <input class="form-control border-0 bg-white" name="totalcost[]" type="number" placeholder="{{ __("Total cost") }}">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="input-group my-3 shadow">
                                                <a tabindex="0" class="input-group-text text-decoration-none text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Purpose" data-bs-content="Purpose for purchasing"><i class="fa-solid fa-rocket"></i></a>
                                                <input class="form-control border-0 bg-white" name="purpose"     placeholder="{{ __("Purpose") }}" required>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    <div class="col-12 col-lg-3 mt-4 mt-lg-0">

                        <div class="card border-0 shadow-lg">
                            {{-- new-purchase-request__card-header --}}
                            <div class="card-header py-2 border-0 bg-white">
                                <span class="text-black fw-bolder" role="text">{{ __("FILES") }}</span>
                            </div>
                            <div class="card-body">
                                <div id="file-content-id" class="d-block"></div>
                                <input id="file-pick-id" class="d-none" type="file" name="file[]" accept="image/.jpeg,.png,.pdf" multiple>
                                <button class="new-purchase-request__upload-files-btn btn w-100 border" for="file-pick-id" type="button" onclick='javascript:$("#file-pick-id").click()'>
                                    <i class="fa fa-upload"></i>
                                    <span role="text">{{ __("UPLOAD FILES") }}</span>
                                </button>
                            </div>
                            <div class="card-footer py-2 py-lg-3 border-0 bg-white">

                                <div class="input-group mb-2">
                                    <input id="new-purchasse-request__confirm-signature" class="form-check-input rounded-1" type="checkbox" name="remember">
                                    <label class="ms-2 text-dark" for="new-purchasse-request__confirm-signature"><small class="text-muted" style="user-select:none;">{{ __("Confirm signature") }}</small></label>
                                </div>

                                <div class="shadow">
                                    <button id="new-purchase-request__submit" class="new-purchase-request__submit-btn btn w-100 text-light" type="submit" disabled>
                                        <i class="fa fa-paper-plane"></i>
                                        <span role="text">{{ __("SEND REQUEST") }}</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>
@stop

@section("javascript")

    {{-- bootstrap-select js --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

    {{-- NEW PURCHASE REQUEST js --}}
    <script type="text/javascript" src="{{ asset("js/new-purchase-request/new-purchase-request.js") }}"></script>


    {{-- PR js --}}
    <script type="text/javascript" src="{{ asset("js/components/pr-form/pr-form.js") }}"></script>

    {{-- PROGRESS BAR js --}}
    <script type="text/javascript" src="{{ asset("js/components/progressbar/progressbar.js") }}"></script>

@stop




