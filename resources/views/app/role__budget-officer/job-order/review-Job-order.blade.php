@extends("layout.app-main")

@section("title", "AMS | Review JO")

@section("dependencies")

    {{-- observer --}}
    <script type="text/javascript" src="{{ asset("js/global/observer/observer.js") }}"></script>

    {{-- bootstrap-select css  --}}
    <link rel="stylesheet" href="{{ asset("extra/bs5-select/bs5-select-1.14.0.min.css") }}">

    {{-- PR & JO css --}}
    <link rel="stylesheet" href="{{ asset("css/components/global/pr-and-jo/pr-and-jo.css") }}">

    {{-- PROGRESS BAR css --}}
    <link rel="stylesheet" href="{{ asset("css/components/progressbar/progressbar.css") }}">

    {{-- STEP PROGRES css --}}
    <link rel="stylesheet" href="{{ asset("css/components/step-progress/step-progress.css") }}">

    {{-- REVIEW JOB ORDER css --}}
    <link rel="stylesheet" href="{{ asset("css/app/role__budget-officer/job-order/review-job-order/review-job-order.css") }}">

@stop

@section("content")
    <div class="d-block py-3">

        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-9">
                    <span class="review-job-order__review-job-order-header-label d-block px-0 py-3 text-muted" role="text">{{ __("Job Order Preview") }}</span>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-9">

                    <x-jo-form
                        :items="$jo_items"
                        :conforme="'LOADING..'"
                        :requisitioner="$requester_data"
                        :authofficial="$authofficial_data"></x-jo-form>

                </div>

                <div class="col-12 col-lg-3 mt-4 mt-lg-0">
                    <div class="card border-0 shadow-lg">
                        <div class="card-body px-1 py-2">

                            {{-- files --}}
                            <span class="d-block px-2 py-2 small text-muted mb-2" role="text" style="font-weight: 400;">ATTACHED FILE</span>

                            <div class="d-block px-2 mb-2">
                                <a class="btn btn-sm text-truncate rounded-pill w-100 border-success text-success" href="{{url("/")}}{{ Storage::disk("local")->url($fileembedded)}}" target="_blank" download>{{ explode("/", $fileembedded)[2] }}</a>
                            </div>

                            <div class="d-block px-2">
                                <hr class="bg-info">
                            </div>

                            @if(\App\Models\FormRequiredPersonel::isFormHasActionForBO($form_id))

                                {{-- action --}}
                                <div class="d-block">
                                    <span class="d-block px-2 small text-muted mb-2" role="text" style="font-weight: 400;">{{ __("REQUIRED ACTION") }}</span>
                                    <div class="d-block">
                                        <form action="{{ url("/budgetofficer/reviewjoborder/takeaction") }}" method="POST">
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

                            <span class="d-block px-2 small text-muted mb-2" role="text" style="font-weight: 400;">TRACKING</span>
                            <div class="container-fluid mb-2">
                                <div class="row flex-nowrap">
                                    <div class="col-1">

                                      <x-step-progress :frp=\App\Models\FormRequiredPersonel::getFormByFormID($form_id)>
                                        </x-step-progress>

                                    </div>
                                    <div class="col-11 pl-0">
                                        <div class="progress-label">
                                            @foreach(\App\Models\FormRequiredPersonel::getFormByFormID($form_id) as $frp)
                                                <div class="d-block small text-truncate @if(strcmp($frp->personelstatus, "unsignitured") === 0) text-muted @endif" role="text">
                                                    <span class="d-block" role="text">{{ \App\Models\Accesslevel::getAccesslevelById($frp->accesslevel_id) }}</span>
                                                    <span class="d-block small" role="text" style="font-size: .5em">{{ $frp->updatedat? $frp->updatedat : "----:--:--" }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- comments --}}
                            <div class="accordion">
                                <div class="accordion-item">
                                    <h6 class="accordion-header">
                                        <button class="accordion-button collapsed py-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                            <span class="d-block px-2 small text-muted" role="text" style="font-weight: 400;">COMMENTS</span>
                                        </button>
                                    </h6>
                                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body px-2" style="max-height: 350px; overflow-y: auto;">
                                            <div class="container-fluid">
                                                <div id="review-job-order__comment-list" class="row" data-fid="{{ \Illuminate\Support\Facades\Crypt::encrypt($form_id) }}">
                                                    <div class="px-2 py-5 text-center">
                                                        <i class="d-block text-muted fa-solid fa-comment fa-2x"></i>
                                                        <span class="text-muted text-truncate" role="text">loading comments...</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <div class="accordion-header p-2">
                                        <div class="input-group mt-2 mb-3">
                                            <textarea id="review-job-order__comment-field" class="form-control" rows="1" placeholder="{{ __("write a comment.") }}"></textarea>
                                        </div>
                                        <span class="d-block my-2">
                                            <button id="review-job-order__comment-button" class="btn btn-success w-100" type="button" data-frp="{{ \Illuminate\Support\Facades\Crypt::encrypt($formrequiredpersonel_id) }}">
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

    {{-- bootstrap-select js --}}
    <script type="text/javascript" src="{{ asset("extra/bs5-select/bs5-select-1.14.0.min.js") }}"></script>

    {{-- message modal js --}}
    <script type="text/javascript" src="{{ asset("js/components/message-modal/message-modal.js") }}"></script>

    {{-- PROGRESS BAR js --}}
    <script type="text/javascript" src="{{ asset("js/components/progressbar/progressbar.js") }}"></script>

    {{-- JO FORM js --}}
    <script type="text/javascript" src="{{ asset('js/components/jo-form/jo-form.js') }}"></script>

    {{-- REVIEW JOB ORDER js --}}
    <script type="text/javascript" src="{{ asset("js/app/role__budget-officer/job-order/review-job-order.js") }}"></script>

@stop
