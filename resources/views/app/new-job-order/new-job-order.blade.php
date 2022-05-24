@extends("layout.app-main")
@section('title', 'AMS | job order')

@section('dependencies')

    {{-- NEW JO STYLESHEET --}}
    <link rel="stylesheet" href="{{ asset("css/new-job-order/new-job-order/new-job-order.css") }}">

    {{-- PR/JO STYLESHEET --}}
    <link rel="stylesheet" href="{{ asset('css/components/global/pr-and-jo/pr-and-jo.css') }}">
@stop

@section('content')
    <div class="d-block py-3">
        @if (Session::has("info"))
            <div class="modal fade" tabindex="-1" aria-hidden="true" style="padding-right: 0 !important;">
                <div class="modal-dialog border-0">
                    <div class="modal-content border-0">
                        <div class="modal-header border-0">
                            <h5 class="modal-title">Success</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <span class="h5" role="text" style="font-weight: 300;">
                                {{ session("info") }}
                            </span>
                        </div>
                        <div class="modal-footer border-0">
                            <div class="mx-auto w-25 shadow">
                                <button type="button" class="btn w-100 btn-primary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif


        <form id="request-form" action="{{ url("/newjoborder/uploadjoform") }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-9">

                        <x-jo-form 
                        :requisitioner="json_decode(json_encode(Auth::user()),true)"></x-jo-form>

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
                            <div class="card-footer py-2 py-lg-3 border-0 bg-white">

                                <div class="input-group mb-2">
                                    <input id="new-job-order__confirm-signature" class="form-check-input rounded-1" type="checkbox" name="remember">
                                    <label class="ms-2 text-dark" for="new-job-order__confirm-signature"><small class="text-muted" style="user-select:none;">{{ __("Confirm signature") }}</small></label>
                                </div>

                                <div class="shadow">
                                    <button id="new-job-order__submit" class="new-job-order__submit-btn btn w-100 text-light" type="submit" disabled>
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

@section('javascript')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/components/jo-form/jo-form.js') }}"></script>
    <script type="text/javascript" src="{{ asset("js/new-job-order/new-job-order.js") }}"></script>
    <script
        $(document).ready((evt) => {

            $('[data-bs-toggle="tooltip"]').tooltip();

        });
    </script>
@stop




