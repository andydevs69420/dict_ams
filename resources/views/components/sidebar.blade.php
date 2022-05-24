

<nav class="sidebar__sidebar navbar navbar-expand-lg navbar-dark shadow-sm">
    <div id="sidebar-collapse-id" class="sidebar__sidebar-collapse collapse collapse-horizontal show">
        <div class="sidebar__sidebar-main">
            <div class="sidebar__navbar-brand-group navbar-brand">
                <div class="container-fluid p-0">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-4 p-0">
                            <img class="sidebar__brand-icon d-block mx-auto" src="{{ asset("images/dict-transparent.png") }}" alt="dict-seal">
                        </div>
                        <div class="col-auto p-0">
                            <span class="sidebar__brand-label text-light" role="text">{{ __("AMS") }}</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="sidebar__scrollable-wrapper d-block">

                {{-- shared ra sa tanan access level ang dashboard na link --}}
                
                <hr class="sidebar__sidebar-separator d-block mx-auto my-1 bg-light">
                <ul class="sidebar__ul list-group list-group-flush mx-auto">
                    <li class="sidebar__li-item list-group-item {{ $isPathMatch("dashboard") }}">
                        <i class="sidebar__list-icon fa fa-chart-line"></i><a class="sidebar__list-label" href="{{ url("/dashboard") }}">{{ __("Dashboard") }}</a>
                    </li>
                </ul>
                <hr class="sidebar__sidebar-separator d-block mx-auto my-1 bg-light">

                {{-- TODO: Implement!! --}}

                @switch($getAccesslevelId())
                    @case(1)
                        @break
                    @case(4)
                    @case(5)
                    @case(13)
                        {{-- 
                            NOTE: tanawa sa accesslevel table unsay id
                                 4 := PROVINCIAL OFFICER
                                 5 := FOCAL
                                13 := STAFF
                        --}}
                        <ul class="sidebar__ul list-group list-group-flush mx-auto">
                            <span class="sidebar__ul-label d-block py-3 text-info fw-bold" role="text">{{ __("COMPONENTS") }}</span>
                            <li class="sidebar__li-item list-group-item">
                                <div class="sidebar__accordion accordion accordion-flush">
                                    <div class="sidebar__accordion-item accordion-item">
                                        <div class="sidebar__accordion-header accordion-header">
                                            <button class="sidebar__accordion-button accordion-button" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-id">
                                                <i class="sidebar__accordion-button-icon fa fa-file"></i><span class="sidebar__accordion-button-label" role="text">{{ __("Create Form") }}</span>
                                            </button>
                                        </div>
                                        <div id="accordion-collapse-id" class="sidebar__accordion-collapse accordion-collapse collapse show">
                                            <ul class="sidebar__accordion-body accordion-body list-group list-group-flush">
                                                <li class="sidebar__accordion-body-item list-group-item {{ $isPathMatch("newpurchaserequest") }}">
                                                    <i class="sidebar__accordon-body-item-icon fa fa-rectangle-list"></i><a class="sidebar__accordon-body-item-label" href="{{ url("/newpurchaserequest") }}">{{ __("Purchase Request") }}</a>
                                                </li>
                                                <li class="sidebar__accordion-body-item list-group-item {{ $isPathMatch("newjoborder") }}">
                                                    <i class="sidebar__accordon-body-item-icon fa fa-helmet-safety"></i><a class="sidebar__accordon-body-item-label" href="{{ url("/newjoborder") }}">{{ __("Job Order") }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="sidebar__li-item list-group-item {{ $isPathMatch("") }}">
                                <i class="sidebar__list-icon fa fa-list"></i><a class="sidebar__list-label" href="#">{{ __("Form List") }}</a>
                            </li>
                            <li class="sidebar__li-item list-group-item {{ $isPathMatch("itemlist") }}">
                                <i class="sidebar__list-icon fa fa-clipboard"></i><a class="sidebar__list-label" href="{{ url("/itemlist") }}">{{ __("Item List") }}</a>
                            </li>
                            <li class="sidebar__li-item list-group-item {{ $isPathMatch("") }}">
                                <i class="sidebar__list-icon fa fa-comment"></i><a class="sidebar__list-label" href="#">{{ __("Messages") }}</a>
                            </li>
                        </ul>
                        @break
                    @case(11)
                        {{-- 
                            NOTE: tanawa sa accesslevel table unsay id
                                 11 := BUDGET OFFICER
                        --}}
                        <ul class="sidebar__ul list-group list-group-flush mx-auto">
                            <span class="sidebar__ul-label d-block py-3 text-info fw-bold" role="text">{{ __("COMPONENTS") }}</span>
                            <li class="sidebar__li-item list-group-item">
                                <div class="sidebar__accordion accordion accordion-flush">
                                    <div class="sidebar__accordion-item accordion-item">
                                        <div class="sidebar__accordion-header accordion-header">
                                            <button class="sidebar__accordion-button accordion-button" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-id">
                                                <i class="sidebar__accordion-button-icon fa fa-file"></i><span class="sidebar__accordion-button-label" role="text">{{ __("Order Status") }}</span>
                                            </button>
                                        </div>
                                        <div id="accordion-collapse-id" class="sidebar__accordion-collapse accordion-collapse collapse show">
                                            <ul class="sidebar__accordion-body accordion-body list-group list-group-flush">
                                                <li class="sidebar__accordion-body-item list-group-item {{ $isPathMatch("newpurchaserequest") }}">
                                                    <i class="sidebar__accordon-body-item-icon fa fa-rectangle-list"></i><a class="sidebar__accordon-body-item-label" href="{{ url("/purchaserequeststatus") }}">{{ __("Purchase Request") }}</a>
                                                </li>
                                                <li class="sidebar__accordion-body-item list-group-item {{ $isPathMatch("newjoborder") }}">
                                                    <i class="sidebar__accordon-body-item-icon fa fa-helmet-safety"></i><a class="sidebar__accordon-body-item-label" href="{{ url("/joborderstatus") }}">{{ __("Job Order") }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>

                        @break
                    @case(14)
                        {{-- 
                            NOTE: tanawa sa accesslevel table unsay id sa admin
                                14 := ADMIN
                        --}}
                        <ul class="sidebar__ul list-group list-group-flush mx-auto">
                            <span class="sidebar__ul-label d-block w-100 py-3 text-info fw-bold" role="text">{{ __("COMPONENTS") }}</span>
                            <li class="sidebar__li-item list-group-item {{ $isPathMatch("users") }}">
                                <i class="sidebar__list-icon fa fa-users"></i>
                                <a class="sidebar__list-label" href="{{ url("/users") }}">
                                    {{ __("Users") }}
                                    @if (($result = App\Models\UserVerificationDetails::countUserByVerificationStatusId("1")) > 0)
                                        <span class="badge bg-danger">
                                            +{{ $result }}
                                        </span>
                                    @endif
                                </a>
                            <li class="sidebar__li-item list-group-item {{ $isPathMatch("itemlist") }}">
                                <i class="sidebar__list-icon fa fa-clipboard"></i><a class="sidebar__list-label" href="{{ url("/itemlist") }}">{{ __("Item List") }}</a>
                            </li>
                            <li class="sidebar__li-item list-group-item {{ $isPathMatch("requisitioner") }}">
                                <i class="sidebar__list-icon fa fa-user"></i><a class="sidebar__list-label" href="{{ url("/requisitioner") }}">{{ __("Requisitioner") }}</a>
                            </li>
                            <li class="sidebar__li-item list-group-item">
                                <div class="sidebar__accordion accordion accordion-flush">
                                    <div class="sidebar__accordion-item accordion-item">
                                        <div class="sidebar__accordion-header accordion-header">
                                            <button class="sidebar__accordion-button accordion-button" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-id">
                                                <i class="sidebar__accordion-button-icon fa fa-file"></i><span class="sidebar__accordion-button-label" role="text">{{ __("Forms List") }}</span>
                                            </button>
                                        </div>
                                        <div id="accordion-collapse-id" class="sidebar__accordion-collapse accordion-collapse collapse show">
                                            <ul class="sidebar__accordion-body accordion-body list-group list-group-flush">
                                                <li class="sidebar__accordion-body-item list-group-item {{ $isPathMatch("newpurchaserequest") }}">
                                                    <i class="sidebar__accordon-body-item-icon fa fa-rectangle-list"></i><a class="sidebar__accordon-body-item-label" href="{{ url("/newpurchaserequest") }}">{{ __("Purchase Request") }}</a>
                                                </li>
                                                <li class="sidebar__accordion-body-item list-group-item {{ $isPathMatch("newjoborder") }}">
                                                    <i class="sidebar__accordon-body-item-icon fa fa-helmet-safety"></i><a class="sidebar__accordon-body-item-label" href="{{ url("/newjoborder") }}">{{ __("Job Order") }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        @break

                    @default
                        {{-- debug: pag walay access level --}}
                        <h3 class="d-block mx-auto lead">Invalid Accesslevel => "{{ $getAccesslevelId() }}"</h3>
                        @break
                        
                @endswitch

                <hr class="sidebar__sidebar-separator d-block mx-auto my-1 bg-light">
                <ul class="sidebar__ul list-group list-group-flush mx-auto">
                    <span class="sidebar__ul-label d-block py-3 text-info fw-bold" role="text">{{ __("INTERFACE") }}</span>
                    <li class="sidebar__li-item list-group-item {{ $isPathMatch("") }}">
                        <i class="sidebar__list-icon fa fa-wrench"></i><a class="sidebar__list-label" href="/dashboard">{{ __("Utilities") }}</a>
                    </li>
                </ul>
                <hr class="sidebar__sidebar-separator d-block mx-auto my-1 bg-light">
                
            </div>
        </div>
    </div>
</nav>
