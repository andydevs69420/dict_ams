

@extends(
    "layout.app-main", 
    [
        "accesslevelid" => $LoggedUserInfo["accesslevel_id"], // para sa sidebar
        "username"      => $LoggedUserInfo["username"]        // para sa topbar
    ]
)

@section("title", "AMS | purchase request")

@section("dependencies")

    {{-- NEW PURCHASE REQUEST css --}}
    <link rel="stylesheet" href="{{ asset("css/new-purchase-request/new-purchase-request/new-purchase-request.css") }}">

    {{-- PROGRESS BAR css --}}
    <link rel="stylesheet" href="{{ asset("css/components/progressbar/progressbar.css") }}">

    {{-- PR & JO css --}}
    <link rel="stylesheet" href="{{ asset("css/components/global/pr-and-jo/pr-and-jo.css") }}">

@stop

@section("content")
    <div class="d-block py-5">
        <form id="request-pr-form" action="">

            @csrf

            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-9">
                        
                        <x-pr-form 
                            :requisitioner="$LoggedUserInfo"></x-pr-form>

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

    {{-- NEW PURCHASE REQUEST js --}}
    <script type="text/javascript" src="{{ asset("js/new-purchase-request/new-purchase-request.js") }}"></script>

    {{-- PROGRESS BAR js --}}
    <script type="text/javascript" src="{{ asset("js/components/progressbar/progressbar.js") }}"></script>

    {{-- PR js --}}
    <script type="text/javascript" src="{{ asset("js/components/pr-form/pr-form.js") }}"></script>

    <script type="text/javascript">
        $(document).ready((evt) => {
            $("[data-bs-toggle="tooltip"]").tooltip();
            $("[data-bs-toggle="popover"]").popover();
        });
    </script>

@stop




