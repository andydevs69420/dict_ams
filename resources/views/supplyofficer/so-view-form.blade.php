@extends("layout.app-main")
@section('title', 'AMS | job order')

@section('dependencies')

    {{-- NEW JO STYLESHEET --}}
    <link rel="stylesheet" href="{{ asset("css/new-job-order/new-job-order/new-job-order.css") }}">

    {{-- PR/JO STYLESHEET --}}
    <link rel="stylesheet" href="{{ asset('css/components/global/pr-and-jo/pr-and-jo.css') }}">

@stop


@section('content')
    {{-- MODAL --}}
    <form id="request-form" class="my-3" action="{{ url("/so_approvedforms/uploadpqs") }}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-9">
                    {{-- TABLE FORM --}}
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
                            <p>&nbspForm Information</p>
                        </div>
                        <div class="card-body p-0">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12">
                
                                        <ul id="item-list-id"class="list-group">
                
                                            
                                            {{-- default item --}}
                
                
                                                <li class="list-group-item bg-transparent border-0 rounded-0 p-0">
                                                    <div class="container-fluid p-0 mt-2">
                                                        <div class="row">
                                                            <!-- Form ID group -->
                                                            <div class="col-12 pb-4">
                                                                <div  class="input-group">
                                                                    <a tabindex="0" class="input-group-text text-decoration-none text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Item description" data-bs-content="Item name or description"><i class="fa-solid fa-newspaper"></i></a>
                                                                    <input class="form-control bg-light jo-description" value={{ $form["form_id"] }} name="form-id" type="text" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <!-- Form Type group -->
                                                            <div class="col-12 pb-4">
                                                                <div  class="input-group">
                                                                    <a tabindex="0" class="input-group-text text-decoration-none text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Item description" data-bs-content="Item name or description"><i class="fa-solid fa-newspaper"></i></a>
                                                                    <input class="form-control bg-light jo-description" value= @if($form["formtype_id"] === 1) 'Purchase Request' @elseif($form["formtype_id"] === 2) 'Job Order' @endif name="form-type" type="text" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            
                                        </ul>
                                    </div>
                                    <!-- Canvasser group -->
                                    <div class="col-12">
                                        <div class="input-group mb-4">
                                            <a tabindex="0" class="input-group-text text-decoration-none text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Requisitioner" data-bs-content="Purchase requisitioner"><i class="fa-solid fa-user"></i></a>
                                            <select class="selectPicker form-select bg-light" name="requester"  placeholder="{{ __("Requisitioner") }}"  data-live-search="true" required>
                                                @foreach(App\Models\UserVerificationDetails::getAllRequisitioner() as $canvasser)
                                                    <option value="{{ $canvasser->user_id }}">
                                                        {{ $canvasser->lastname }}, {{ $canvasser->firstname }} {{ $canvasser->middleinitial }} - ({{ App\Models\Accesslevel::getAccesslevelById($canvasser->accesslevel_id) }})
                                                    </option>
                                                @endforeach                                        
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="card-body px-1 py-2 w-50 mx-auto">

                                            {{-- file attached --}}
                                            <span class="d-block px-2 py-2 text-center small text-muted mb-2" role="text" style="font-weight: 400;">ATTACHED FILE</span>
                
                                            <div class="d-block px-2 mb-2">
                                                <a class="btn btn-sm text-truncate rounded-pill w-100 border-success text-success" href="{{url('/')}}{{ Storage::disk('local')->url($form["fileembedded"])}}" target="_blank" download>{{ explode("/", $form["fileembedded"])[2] }}</a>
                                            </div>
                                            <div class="d-block px-2">
                                                <hr class="bg-info">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer py-4 border-0 bg-white">
                            <div class="d-flex justify-content-center justify-content-lg-between align-items-center px-2">
                                <button class="jo-form__generate-jo-form-btn btn btn-primary text-light float-start" type="submit" form="validation-form" onclick='javascript:generate__pqs_form("{{ $form["form_id"] }}")'">
                                    <i class="fa fa-file"></i>
                                    <span role="text">{{ __("GENERATE PRICE QUOTATION") }}</span>
                                </button>
                                <span class="float-end text-muted" role="text">Form v0.4</span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-12 col-lg-3 mt-4 mt-lg-0">
                    <div class="card border-0 shadow-lg">
                        <div class="card-header py-2 border-0 bg-white">
                            <span class="text-black fw-bolder" role="text">{{ __("FILES") }}</span>
                        </div>
                        <div class="card-body">
                            <div id="file-content-id" class="d-block"></div>
                            <input id="file-pick-id" class="d-none" type="file" name="file-upload" accept="image/.jpeg,.png,.pdf" multiple>
                            <button class="new-job-order__upload-files-btn btn w-100 border" for="file-pick-id" type="button" onclick='javascript:$("#file-pick-id").click()'>
                                <i class="fa fa-upload"></i>
                                <span role="text">{{ __("UPLOAD FILES") }}</span>
                            </button>
                        </div>
                        <div class="card-footer py-2 py-lg-3 pt-lg-1 border-0 bg-white">

                            <div class="input-group mb-2">
                                <input id="new-job-order__confirm-signature" class="form-check-input rounded-1" type="checkbox" name="remember">
                                <label class="ms-2 text-dark" for="new-job-order__confirm-signature"><small class="text-muted" style="user-select:none;">{{ __("Confirm signature") }}</small></label>
                            </div>

                            <div class="shadow">
                                <button id="new-job-order__submit" class="new-job-order__submit-btn btn w-100 text-light" type="submit" disabled>
                                    <i class="fa fa-paper-plane"></i>
                                    <span role="text">{{ __("UPLOAD PQS") }}</span>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>
    
@stop


@section('javascript')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script type="text/javascript" src="{{ asset("js/components/pr-form/pr-form.js") }}"></script>
    <script type="text/javascript" src="{{ asset("js/new-job-order/new-job-order.js") }}"></script>
    
    
    <script>

        function generate__pqs_form(id){
            canvasser = $('.selectPicker').val();

            // date
            today = new Date();
            date = (today.getMonth()+1)+'/'+today.getDate()+'/'+today.getFullYear();

            let form_data = {
                'formid' : id,
                'canvasserid': canvasser,
                'date': date,
            };
            return window.open(`/so_approvedforms/generatepqs?data=${JSON.stringify(form_data)}`);

        }

        $(document).ready((evt) => {

            $('[data-bs-toggle="tooltip"]').tooltip();

        });

    </script>
@stop


