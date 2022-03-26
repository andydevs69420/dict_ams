
<nav id="sidebar" class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div id="sidebar-collapse" class="collapse collapse-horizontal show">
        <div class="sidebar__sidebar-main">
            <div class="sidebar__navbar-brand-group navbar-brand">
                <div class="container-fluid p-0">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-4 p-0">
                            <img class="sidebar__brand-icon d-block mx-auto" src="{{ asset('images/dict-transparent.png') }}" alt="dict-seal">
                        </div>
                        <div class="col-auto p-0">
                            <span class="sidebar__brand-label text-light" role="text">AMS</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="sidebar__sidebar-wrapper-scrollable d-block">

                {{-- shared ra sa tanan access level ang dashboard na link --}}
                
                <hr class="sidebar__sidebar-separator d-block mx-auto my-1 bg-light">
                <ul class="sidebar__ul-group-override list-group list-group-flush mx-auto">
                    <li class="sidebar__li-group-item-override list-group-item text-info {{ $is_path_match('dashboard') }}">
                        <i class="sidebar__list-icon fa fa-chart-line"></i><a class="sidebar__list-label" href="{{ url('/dashboard') }}">Dashboard</a>
                    </li>
                </ul>
                <hr class="sidebar__sidebar-separator d-block mx-auto my-1 bg-light">

                @if     (strcmp($accessLevelId,'3') === 0)

                    {{-- kung admin siya --}}

                    <ul class="sidebar__ul-group-override list-group list-group-flush mx-auto">
                        <span class="sidebar__ul-group-label d-block w-100 py-3 text-info fw-bold" role="text">COMPONENTS</span>
                        <li class="sidebar__li-group-item-override list-group-item text-info {{ $is_path_match('') }}">
                            <i class="sidebar__list-icon fa fa-users"></i><a class="sidebar__list-label" href="#">Users</a>
                        </li>
                        <li class="sidebar__li-group-item-override list-group-item text-info {{ $is_path_match('') }}">
                            <i class="sidebar__list-icon fa fa-clipboard"></i><a class="sidebar__list-label" href="#">Item List</a>
                        </li>
                        <li class="sidebar__li-group-item-override list-group-item text-info {{ $is_path_match('') }}">
                            <i class="sidebar__list-icon fa fa-user"></i><a class="sidebar__list-label" href="#">Requisitioner</a>
                        </li>
                        <li class="sidebar__li-group-item-override list-group-item text-info {{ $is_path_match('') }}">
                            <i class="sidebar__list-icon fa fa-list"></i><a class="sidebar__list-label" href="#">Purchase Request List</a>
                        </li>
                    </ul>

                @elseif (
                            strcmp($accessLevelId,'4') === 0 ||
                            strcmp($accessLevelId,'5') === 0
                        )

                    {{-- kung requisitioner or similar level --}}

                    <ul class="sidebar__ul-group-override list-group list-group-flush mx-auto">
                        <span class="sidebar__ul-group-label py-3 text-info fw-bold" role="text">COMPONENTS</span>
                        <li class="sidebar__li-group-item-override list-group-item text-info {{ $is_path_match('createform') }}">
                            <i class="sidebar__list-icon fa fa-file"></i><a class="sidebar__list-label" href="{{ url('/createform') }}">Create Form</a>
                        </li>
                        <li class="sidebar__li-group-item-override list-group-item text-info {{ $is_path_match('') }}">
                            <i class="sidebar__list-icon fa fa-list"></i><a class="sidebar__list-label" href="#">Form List</a>
                        </li>
                        <li class="sidebar__li-group-item-override list-group-item text-info {{ $is_path_match('') }}">
                            <i class="sidebar__list-icon fa fa-clipboard"></i><a class="sidebar__list-label" href="#">Item List</a>
                        </li>
                        <li class="sidebar__li-group-item-override list-group-item text-info {{ $is_path_match('') }}">
                            <i class="sidebar__list-icon fa fa-comment"></i><a class="sidebar__list-label" href="#">Messages</a>
                        </li>
                    </ul>
                    
                @else
                    {{-- debug: pag walay access level --}}
                    <h3 class="d-block mx-auto lead">Invalid Accesslevel => "{{$accessLevelId}}"</h3>
                @endif

                <hr class="sidebar__sidebar-separator d-block mx-auto my-1 bg-light">
                <ul class="sidebar__ul-group-override list-group list-group-flush mx-auto">
                    <span class="sidebar__ul-group-label py-3 text-info fw-bold" role="text">INTERFACE</span>
                    <li class="sidebar__li-group-item-override list-group-item text-info {{ $is_path_match('') }}">
                        <i class="sidebar__list-icon fa fa-wrench"></i><a class="sidebar__list-label" href="/dashboard">Utilities</a>
                    </li>
                </ul>
                <hr class="sidebar__sidebar-separator d-block mx-auto my-1 bg-light">
                
            </div>
        </div>
    </div>
</nav>


