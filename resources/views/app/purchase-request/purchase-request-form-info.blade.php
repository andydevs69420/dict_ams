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

                <div class="col-12 col-lg-3">
                    <div class="card border-0 shadow-lg">
                        <div class="card-body">

                            <ol class="step-progress">
                                <li class="progress-step">
                                    <span>asdasd</span>
                                </li>
                                <li class="progress-step"></li>
                                <li class="progress-step"></li>
                            </ol>

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




