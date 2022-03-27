@extends('layout.app-main', ['accesslevelid' => $LoggedUserInfo['accesslevel'],'username' => $LoggedUserInfo['username']])

@section('title', 'AMS | purchase request')

@section('dependencies')
    <link rel="stylesheet" href="{{ asset('css/create-form/create-form.css') }}">
@stop

@section('content')
    <div class="d-block py-5">
        <form id="request-form" action="">

            @csrf

            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-9">
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
                                                <textarea id="purpose-field" class="form-control bg-light" form="new-purchase-request-form" name="purpose" placeholder="Purpose" rows="3" required style="resize: none;"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <span class="text-muted" role="text">Form v0.1</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3">
                        <div class="card">
                            <div class="card-header bg-primary">
                                <span class="text-white" role="header">FILES</span>
                            </div>
                            <div class="card-body">
                                <div id="file-content-id" class="d-flex"></div>
                                <input id="file-pick-id" class="d-none" type="file" name="file[]">
                                <button class="btn w-100 border border-primary text-primary" for="file-pick-id" type="button" onclick="javascript:$('#file-pick-id').click()">
                                    <i class="fa fa-plus-circle"></i>
                                    <span role="text">ADD FILE</span>
                                </button>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary w-100 text-light" type="button">REQUEST</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop

@section('javascript')
    <script src="{{ asset('js/components/pr-form/pr-form.js') }}"></script>
    <script>
        $(document).ready((evt) => {

            $('[data-bs-toggle="tooltip"]').tooltip();

        });
    </script>
@stop




