@extends('layout.app-main')


@section('title', 'AMS | purchase request')

@section('dependencies')
    <!-- self style -->
    <link rel="stylesheet" href="{{ asset('css/new-purchase-request/new-purchase-request.css') }}">
    <!-- fontawesome css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@stop

@section('content')
    <div class="d-block py-5">
        <form id="new-purchase-request-form" action="">

            @csrf

            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-7 col-xxl-6">
                        <div class="card">
                            <div class="card-header bg-primary">
                                <span class="text-white" role="header">NEW PURCHASE REQUEST FORM</span>
                            </div>
                            <dv class="card-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <!-- stock no group -->
                                        <div class="col-6">
                                            <label class="text-dark py-1"><small>Stock no*</small></label>
                                            <div  class="input-group">
                                                <input class="form-control bg-light" name="stock[]" type="number" placeholder="Stock no." required>
                                            </div>
                                        </div>
                                        <!-- unit group -->
                                        <div class="col-6">
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
                                        <div class="col-6">
                                            <label class="text-dark py-1"><small>Qty*</small></label>
                                            <div class="input-group">
                                                <input class="form-control bg-light" name="qty[]" type="number" placeholder="Qty" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label class="text-dark py-1"><small>Unit cost*</small></label>
                                            <div class="input-group">
                                                <input class="form-control bg-light" name="unitcost[]" type="number" placeholder="Unit cost" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="text-dark py-1"><small>Total cost*</small></label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fa-solid fa-peso-sign"></i></span>
                                                <input class="form-control bg-light" name="totalcost[]" type="number" placeholder="Total cost" required>
                                            </div>
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
                            </dv>
                            <div class="card-footer">
                                <button class="btn text-light float-end" style="background-color:#5ea832;">SUBMIT REQUEST</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-5 col-xxl-6">
                        <div class="card">
                            <div class="card-header bg-primary">
                                <span class="text-white" role="header">FILES</span>
                            </div>
                            <div class="card-body"></div>
                            <div class="card-footer">
                                <input id="file-pick" class="d-none" type="file" name="file[]">
                                <button class="btn btn-primary text-light float-end" for="file-pick" type="button" onclick="javascript:document.getElementById('file-pick').click()">UPLOAD</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop

@section('javascript')
    <!-- fontawesome js -->
    <script type="text/javascript" src="https://kit.fontawesome.com/0ad786b032.js" crossorigin="anonymous"></script>
@stop




