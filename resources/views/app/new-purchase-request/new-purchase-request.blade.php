@extends("layout.app-main")

@section("title", "AMS | purchase request")

@section("dependencies")

    {{-- bootstrap-select css  --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">

    {{-- NEW PURCHASE REQUEST css --}}
    <link rel="stylesheet" href="{{ asset("css/new-purchase-request/new-purchase-request/new-purchase-request.css") }}">

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
                    <div class="col-12 col-lg-9">

                        <x-pr-form
                            :requisitioner="json_decode(json_encode(Auth::user()),true)"></x-pr-form>

                    </div>
                    <div class="col-12 col-lg-3 mt-4 mt-lg-0">

                        <div class="card shadow">
                            <div class="new-purchase-request__card-header card-header">
                                <span class="text-white" role="text">{{ __("FILES") }}</span>
                            </div>
                            <div class="card-body">
                                <div id="file-content-id" class="d-block"></div>
                                <input id="file-pick-id" class="d-none" type="file" name="file[]" accept="image/.jpeg,.png,.pdf" multiple>
                                <button class="new-purchase-request__upload-files-btn btn w-100 border" for="file-pick-id" type="button" onclick="javascript:$("#file-pick-id").click()">
                                    <i class="fa fa-upload"></i>
                                    <span role="text">{{ __("UPLOAD FILES") }}</span>
                                </button>
                            </div>
                            <div class="card-footer">
                                <button class="new-purchase-request__submit-btn btn w-100 text-light" type="submit">
                                    <i class="fa fa-paper-plane"></i>
                                    <span role="text">{{ __("SEND REQUEST") }}</span>
                                </button>
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




