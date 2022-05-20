@extends("layout.app-main")

@section("title", "AMS | PR Info")

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
                    <div class="card border-0 shadow-lg">
                        <div class="card-body px-1 py-2">

                            {{-- files --}}
                            <span class="d-block px-2 small text-muted mb-2" role="text" style="font-weight: 400;">FILES</span>

                            <div class="d-block px-2 mb-2">
                                <a class="btn btn-sm text-truncate rounded-pill w-100 border-primary" href="{{url('/')}}{{ Storage::disk('local')->url($fileembedded)}}" target="_blank" download>{{ explode("/", $fileembedded)[2] }}</a>
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

                                            @if(strcmp($rQ_STATUS, "signitured") === 0)
                                                <li class="progress-step ok">
                                                    <i class="fa fa-check fa-2xs"></i>
                                                </li>
                                            @else
                                                <li class="progress-step not-ok">
                                                    <i class="fa fa-times fa-2xs"></i>
                                                </li>
                                            @endif

                                            @if(strcmp($bO_STATUS, "signitured") === 0)
                                                <li class="progress-step ok">
                                                    <i class="fa fa-check fa-2xs"></i>
                                                </li>
                                            @else
                                                <li class="progress-step not-ok">
                                                    <i class="fa fa-times fa-2xs"></i>
                                                </li>
                                            @endif

                                            @if(strcmp($rA_STATUS, "signitured") === 0)
                                                <li class="progress-step ok">
                                                    <i class="fa fa-check fa-2xs"></i>
                                                </li>
                                            @else
                                                <li class="progress-step not-ok">
                                                    <i class="fa fa-times fa-2xs"></i>
                                                </li>
                                            @endif

                                        </ol>
                                    </div>
                                    <div class="col-11 pl-0">
                                        <div class="progress-label">
                                            <span class="d-block small text-truncate @if(strcmp($rQ_STATUS, "unsignitured") === 0) text-muted @endif" role="text">Requisitioner</span>
                                            <span class="d-block small text-truncate @if(strcmp($bO_STATUS, "unsignitured") === 0) text-muted @endif" role="text">Budget Officer</span>
                                            <span class="d-block small text-truncate @if(strcmp($rA_STATUS, "unsignitured") === 0) text-muted @endif" role="text">Recommending Approval</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- comments --}}
                            <span class="d-block px-2 small text-muted mb-2" role="text" style="font-weight: 400;">COMMENTS</span>
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

    {{-- PR js --}}
    <script type="text/javascript" src="{{ asset("js/components/pr-form/pr-form.js") }}"></script>

    {{-- PROGRESS BAR js --}}
    <script type="text/javascript" src="{{ asset("js/components/progressbar/progressbar.js") }}"></script>

@stop




