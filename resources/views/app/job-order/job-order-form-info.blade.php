@extends("layout.app-main")

@section("title", "AMS | JO Info")

@section("dependencies")

    {{-- bootstrap-select css  --}}
    <link rel="stylesheet" href="{{ asset("extra/bs5-select/bs5-select-1.14.0.min.css") }}">

    {{-- PR & JO css --}}
    <link rel="stylesheet" href="{{ asset("css/components/global/pr-and-jo/pr-and-jo.css") }}">

    {{-- PROGRESS BAR css --}}
    <link rel="stylesheet" href="{{ asset("css/components/progressbar/progressbar.css") }}">

    {{-- step progress css --}}
    <link rel="stylesheet" href="{{ asset("css/step-progress/step-progress.css") }}">

@stop

@section("content")
    <div class="d-block py-3">

        <form action="POST" enctype="multipart/form-data">
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
                                <span class="d-block px-2 small text-muted mb-2" role="text" style="font-weight: 400;">ATTACHED FILE</span>

                                <div class="d-block px-2 mb-2">
                                    <a class="btn btn-sm text-truncate rounded-pill w-100 border-success" href="{{url('/')}}{{ Storage::disk('local')->url($fileembedded)}}" target="_blank" download>{{ explode("/", $fileembedded)[2] }}</a>
                                </div>

                                <div class="d-block px-2">
                                    <hr class="bg-info">
                                </div>

                                {{-- tracking --}}

                                <span class="d-block px-2 small text-muted mb-2" role="text" style="font-weight: 400;">TRACKING</span>
                                <div class="container-fluid mb-2">
                                    <div class="row flex-nowrap">
                                        <div class="col-1">
                                            <ol class="step-progress">

                                                @foreach(\App\Models\FormRequiredPersonel::getFormByFormID($form_id) as $frp)
                                                    
                                                    @if(strcmp($frp->personelstatus, "signitured") === 0)
                                                        <li class="progress-step ok">
                                                            <i class="fa fa-check fa-2xs"></i>
                                                        </li>
                                                    @else
                                                        <li class="progress-step not-ok">
                                                            <i class="fa fa-times fa-2xs"></i>
                                                        </li>
                                                    @endif

                                                @endforeach

                                            </ol>
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
                                                    <div id="job-order-form-info__comment-list" class="row" data-fid="{{ \Illuminate\Support\Facades\Crypt::encrypt($frp->form_id) }}">
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
                                                <textarea id="job-order-form-info__comment-field" class="form-control" rows="1" placeholder="{{ __("write a comment.") }}"></textarea>
                                            </div>
                                            <span class="d-block my-2">
                                                <button id="job-order-form-info__comment-button" class="btn btn-success w-100" type="button" data-frp="{{ \Illuminate\Support\Facades\Crypt::encrypt($formrequiredpersonel_id) }}">
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

        </form>
    
    </div>
@stop

@section("javascript")

    {{-- bootstrap-select js --}}
    <script type="text/javascript" src="{{ asset("extra/bs5-select/bs5-select-1.14.0.min.js") }}"></script>

    {{-- PROGRESS BAR js --}}
    <script type="text/javascript" src="{{ asset("js/components/progressbar/progressbar.js") }}"></script>

    {{-- JO FORM js --}}
    <script type="text/javascript" src="{{ asset('js/components/jo-form/jo-form.js') }}"></script>

    {{-- JOB ORDER FORM INFO js --}}
    <script type="text/javascript" src="{{ asset("js/job-order/job-order-form-info.js") }}"></script>

    {{--
        readonly if admin.
    --}}
    @if(Auth::user()->isAdmin())
        <script>
            $("form").find("input, textarea, button")
            .attr("readonly", true)
            .attr("disabled", true);
        </script>
    @endif

@stop




