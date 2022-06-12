@extends("layout.app-main")

@section("title", "AMS | Review PR")

@section("dependencies")

    {{-- bootstrap-select css  --}}
    <link rel="stylesheet" href="{{ asset("extra/bs5-select/bs5-select-1.14.0.min.css") }}">

    {{-- PR & JO css --}}
    <link rel="stylesheet" href="{{ asset("css/components/global/pr-and-jo/pr-and-jo.css") }}">

    {{-- PROGRESS BAR css --}}
    <link rel="stylesheet" href="{{ asset("css/components/progressbar/progressbar.css") }}">

    {{-- STEP PROGRES css --}}
    <link rel="stylesheet" href="{{ asset("css/components/step-progress/step-progress.css") }}">

    {{-- REVIEW PURCHASE REQUEST css --}}
    <link rel="stylesheet" href="{{ asset("css/app/role__budget-officer/purchase-request/review-purchase-request/review-purchase-request.css") }}">


@stop

@section("content")
    <div class="d-block py-3">

        {{-- message modal --}}
        <x-message-modal id="review-purchase-request__message-modal"></x-message-modal>

        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-9">
                    <span class="review-purchase-request__review-purchase-request-header-label d-block px-0 py-3 text-muted" role="text">{{ __("Purchase Request Preview") }}</span>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-9">

                    <x-pr-form
                        :items="$pr_items"
                        :purpose="$purpose"
                        :requisitioner="$rQ_data"
                        :budget-officer="$bO_data"
                        :recommending-approval="$rA_data"></x-pr-form>

                </div>

                <div class="col-12 col-lg-3 mt-4 mt-lg-0">
                    <div class="card border-0 shadow-lg bg-white">
                        <div class="card-body px-1 py-2">

                            {{-- files --}}
                            <span class="d-block px-2 py-2 small text-muted mb-2" role="text" style="font-weight: 400;">{{ __("ATTACHED FILE") }}</span>
                            <div class="d-flex flex-row justify-content-center px-2 mb-2">
                                <a class="btn btn-sm text-truncate rounded-pill border-success text-success" href="{{url('/')}}{{ Storage::disk('local')->url($fileembedded)}}" target="_blank" style="width: 95%;" download>{{ explode("/", $fileembedded)[2] }}</a>
                            </div>

                            <div class="d-block px-2">
                                <hr class="bg-info">
                            </div>

                            @if(\App\Models\FormRequiredPersonel::isFormHasActionForBO($form_id))

                                {{-- action --}}
                                <div class="d-block">
                                    <span class="d-block px-2 small text-muted mb-2" role="text" style="font-weight: 400;">{{ __("REQUIRED ACTION") }}</span>
                                    <div class="d-block">
                                        <form action="{{ url("/budgetofficer/reviewpurchaserequest/takeaction") }}" method="post">
                                            @csrf
                                            <input type="hidden" name="formid" value="{{ \Illuminate\Support\Facades\Crypt::encrypt($form_id) }}">
                                            <div class="d-flex flex-row justify-content-center mb-2 px-2">
                                                <input class="form-control form-control-sm mb-2 rounded-pill shadow" type="file" name="file-upload" accept=".pdf" style="width: 95%;" required>
                                            </div>
                                            <div class="d-flex flex-row justify-content-around mb-2 px-2">
                                                <input class="btn btn-sm btn-primary rounded-pill shadow" name="accept" type="submit" style="width: 45%;" value="{{ __("ACCEPT") }}">
                                                <input class="btn btn-sm btn-danger rounded-pill shadow" name="decline" type="submit" style="width: 45%;" value="{{ __("DECLINE") }}" onclick='javascript: $("input[name=\"file-upload\"]").attr("required", false)'>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="d-block px-2">
                                        <hr class="bg-info">
                                    </div>
                                </div>

                            @endif

                            {{-- status --}}
                            <span class="d-block px-2 small text-muted my-2" role="text" style="font-weight: 400;">

                                {{ __("FORM STATUS") }}

                                <x-signiture-status class="float-end"
                                    :personelstatusid="$personelstatus_id"
                                    :personelstatus="$personelstatus"></x-signiture-status>

                            </span>

                            <div class="d-block px-2">
                                <hr class="bg-info">
                            </div>

                            {{-- tracking --}}
                            <span class="d-block px-2 small text-muted mb-2" role="text" style="font-weight: 400;">{{ __("TRACKING") }}</span>
                            <div class="container-fluid mb-2">

                                <x-step-progress :frp=\App\Models\FormRequiredPersonel::getFormByFormID($form_id)>
                                    </x-step-progress>
                                    
                            </div>

                            <div class="d-block px-2">
                                <hr class="bg-info">
                            </div>

                            {{-- comments --}}
                            <div class="accordion accordion-flush">
                                <div class="accordion-item border-0 bg-white">
                                    <h6 class="accordion-header">
                                        <button class="accordion-button collapsed ps-0 py-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                            <span class="d-block px-2 small text-muted" role="text" style="font-weight: 400;">COMMENTS</span>
                                        </button>
                                    </h6>
                                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body px-2" style="max-height: 350px; overflow-y: auto;">
                                            <div class="container-fluid">
                                                <div id="review-purchase-request__comment-list" class="row" data-fid="{{ \Illuminate\Support\Facades\Crypt::encrypt($form_id) }}">
                                                    <div class="px-2 py-5 text-center">
                                                        <i class="d-block text-muted fa-solid fa-comment fa-2x"></i>
                                                        <span class="text-muted text-truncate" role="text">loading comments...</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item bg-white">
                                    <div class="accordion-header p-2">
                                        <div class="input-group mt-2 mb-3 shadow">
                                        <a tabindex="0" class="input-group-text text-decoration-none text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Comment" data-bs-content="Optional comment"><i class="fa-solid fa-paper-plane"></i></a>
                                            <textarea id="review-purchase-request__comment-field" class="form-control border-0 bg-white" rows="1" placeholder="{{ __("write a comment.") }}"></textarea>
                                        </div>
                                        <span class="d-block my-2">
                                            <button id="review-purchase-request__comment-button" class="btn btn-success w-100 shadow" type="button" data-frp="{{ \Illuminate\Support\Facades\Crypt::encrypt($formrequiredpersonel_id) }}">
                                                {{ __("COMMENT") }}
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
@stop


@section("javascript")

    {{-- observer --}}
    <script type="text/javascript" src="{{ asset("js/global/observer/observer.js") }}"></script>

    {{-- bootstrap-select js --}}
    <script type="text/javascript" src="{{ asset("extra/bs5-select/bs5-select-1.14.0.min.js") }}"></script>

    {{-- MESSAGE MODAL js --}}
    <script type="text/javascript" src="{{ asset("js/components/message-modal/message-modal.js") }}"></script>

    {{-- PROGRESS BAR js --}}
    <script type="text/javascript" src="{{ asset("js/components/progressbar/progressbar.js") }}"></script>

    {{-- PR js --}}
    <script type="text/javascript" src="{{ asset("js/components/pr-form/pr-form.js") }}"></script>

    {{-- REVIEW PURCHASE REQUEST js --}}
    <script type="text/javascript" src="{{ asset("js/app/role__budget-officer/purchase-request/review-purchase-request.js") }}"></script>

    @if(Session::has("info"))
        <script defer>
            jQuery(function() {
                new MessageModal("#review-purchase-request__message-modal").show("Info", "{{ session("info") }}");
            });
        </script>
    @endif

@stop
