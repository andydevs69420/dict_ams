

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
                        <a class="sidebar__list-label" href="{{ url("/dashboard") }}"> <i class="sidebar__list-icon fa fa-chart-line"></i> {{ __("Dashboard") }}</a>
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
                                            <button class="sidebar__accordion-button accordion-button" data-bs-toggle="collapse" data-bs-target="#create-form-accordion-collapse-id">
                                                <span class="sidebar__accordion-button-label" role="text"> <i class="sidebar__accordion-button-icon fa fa-file"></i> {{ __("Create Form") }}</span>
                                            </button>
                                        </div>
                                        <div id="create-form-accordion-collapse-id" class="sidebar__accordion-collapse accordion-collapse collapse show">
                                            <ul class="sidebar__accordion-body accordion-body list-group list-group-flush">
                                                <li class="sidebar__accordion-body-item list-group-item {{ $isPathMatch("purchaserequest/newpurchaserequest") }}">
                                                    <a class="sidebar__accordon-body-item-label" href="{{ url("/purchaserequest/newpurchaserequest") }}"> <i class="sidebar__accordon-body-item-icon fa fa-rectangle-list"></i> {{ __("Purchase Request") }}</a>
                                                </li>
                                                <li class="sidebar__accordion-body-item list-group-item {{ $isPathMatch("newjoborder") }}">
                                                    <a class="sidebar__accordon-body-item-label" href="{{ url("/newjoborder") }}"> <i class="sidebar__accordon-body-item-icon fa fa-helmet-safety"></i> {{ __("Job Order") }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="sidebar__li-item list-group-item">
                                <div class="sidebar__accordion accordion accordion-flush">
                                    <div class="sidebar__accordion-item accordion-item">
                                        <div class="sidebar__accordion-header accordion-header">
                                            <button class="sidebar__accordion-button accordion-button" data-bs-toggle="collapse" data-bs-target="#form-list-accordion-collapse-id">
                                                <span class="sidebar__accordion-button-label" role="text"> <i class="sidebar__accordion-button-icon fa fa-list"></i> {{ __("Form List") }}</span>
                                            </button>
                                        </div>
                                        <div id="form-list-accordion-collapse-id" class="sidebar__accordion-collapse accordion-collapse collapse show">
                                            <ul class="sidebar__accordion-body accordion-body list-group list-group-flush">
                                                <li class="sidebar__accordion-body-item list-group-item {{ $isPathMatch("purchaserequest/viewprlist") }}">
                                                    <a class="sidebar__accordon-body-item-label" href="{{ url("/purchaserequest/viewprlist") }}"> <i class="sidebar__accordon-body-item-icon fa fa-rectangle-list"></i> {{ __("Purchase Request") }}</a>
                                                </li>
                                                <li class="sidebar__accordion-body-item list-group-item {{ $isPathMatch("#") }}">
                                                    <a class="sidebar__accordon-body-item-label" href="{{ url("#") }}"> <i class="sidebar__accordon-body-item-icon fa fa-helmet-safety"></i> {{ __("Job Order") }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        @break
                        @case(8)
                        {{-- 
                            NOTE: tanawa sa accesslevel table unsay id
                                 8 := BAC chairman
                        --}}
                        <ul class="sidebar__ul list-group list-group-flush mx-auto">
                            <span class="sidebar__ul-label d-block py-3 text-info fw-bold" role="text">{{ __("COMPONENTS") }}</span>
                            <li class="sidebar__li-item list-group-item">
                                <div class="sidebar__accordion accordion accordion-flush">
                                    <div class="sidebar__accordion-item accordion-item">
                                        <div class="sidebar__accordion-header accordion-header">
                                            <button class="sidebar__accordion-button accordion-button" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-id">
                                                <i class="sidebar__accordion-button-icon fa fa-file"></i><span class="sidebar__accordion-button-label" role="text">{{ __("Forms") }}</span>
                                            </button>
                                        </div>
                                        <div id="accordion-collapse-id" class="sidebar__accordion-collapse accordion-collapse collapse show">
                                            <ul class="sidebar__accordion-body accordion-body list-group list-group-flush">
                                                <li class="sidebar__accordion-body-item list-group-item {{ $isPathMatch("newpurchaserequest") }}">
                                                    <i class="sidebar__accordon-body-item-icon fa fa-rectangle-list"></i><a class="sidebar__accordon-body-item-label" href="{{ url("/BACpricequotation") }}">{{ __("Price Quotation Status") }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @break
                        @case(9)
                        {{-- 
                            NOTE: tanawa sa accesslevel table unsay id
                                 9 := Canvasser
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
                                                    <i class="sidebar__accordon-body-item-icon fa fa-rectangle-list"></i><a class="sidebar__accordon-body-item-label" href="{{ url("/CanVpricequotation") }}">{{ __("Price Quotation") }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @break
                        @case(10)
                        {{-- 
                            NOTE: tanawa sa accesslevel table unsay id sa admin
                                10 := SUPPLY OFFICER
                        --}}
                        <ul class="sidebar__ul list-group list-group-flush mx-auto">
                            <span class="sidebar__ul-label d-block py-3 text-info fw-bold" role="text">{{ __("COMPONENTS") }}</span>
                            <li class="sidebar__li-item list-group-item {{ $isPathMatch("so-forms") }}">
                                <i class="sidebar__accordion-button-icon fa fa-file"></i>
                                <a class="sidebar__list-label" href="{{ url("/so_approvedforms") }}">{{ __("Forms") }}</a>
                            </li>

                        </ul>
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
                                <a class="sidebar__list-label" href="{{ url("/users") }}">
                                    <i class="sidebar__list-icon fa fa-users"></i>
                                    {{ __("Users") }}
                                    @if (($result = App\Models\UserVerificationDetails::countUserByVerificationStatusId("1")) > 0)
                                        <span class="badge bg-danger float-end">
                                            +{{ $result }}
                                        </span>
                                    @endif
                                </a>
                            <li class="sidebar__li-item list-group-item {{ $isPathMatch("requisitioner") }}">
                                <a class="sidebar__list-label" href="{{ url("/requisitioner") }}"> <i class="sidebar__list-icon fa fa-user"></i> {{ __("Requisitioner") }}</a>
                            </li>
                            <li class="sidebar__li-item list-group-item">
                                <div class="sidebar__accordion accordion accordion-flush">
                                    <div class="sidebar__accordion-item accordion-item">
                                        <div class="sidebar__accordion-header accordion-header">
                                            <button class="sidebar__accordion-button accordion-button" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-id">
                                                <span class="sidebar__accordion-button-label" role="text"> <i class="sidebar__accordion-button-icon fa fa-file"></i> {{ __("Forms List") }}</span>
                                            </button>
                                        </div>
                                        <div id="accordion-collapse-id" class="sidebar__accordion-collapse accordion-collapse collapse show">
                                            <ul class="sidebar__accordion-body accordion-body list-group list-group-flush">
                                                <li class="sidebar__accordion-body-item list-group-item {{ $isPathMatch("purchaserequest/viewprlist") }}">
                                                    <a class="sidebar__accordon-body-item-label" href="{{ url("/purchaserequest/viewprlist") }}"> <i class="sidebar__accordon-body-item-icon fa fa-rectangle-list"></i> {{ __("Purchase Request") }}</a>
                                                </li>
                                                <li class="sidebar__accordion-body-item list-group-item {{ $isPathMatch("newjoborder") }}">
                                                    <a class="sidebar__accordon-body-item-label" href="{{ url("/newjoborder") }}"> <i class="sidebar__accordon-body-item-icon fa fa-helmet-safety"></i> {{ __("Job Order") }}</a>
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
                        <a class="sidebar__list-label" href="/dashboard"> <i class="sidebar__list-icon fa fa-wrench"></i> {{ __("Utilities") }}</a>
                    </li>
                </ul>
                <hr class="sidebar__sidebar-separator d-block mx-auto my-1 bg-light">
                
            </div>
        </div>
    </div>
</nav>
