
<nav id="sidebar" class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div id="sidebar-collapse" class="collapse collapse-horizontal show">
        <div id="sidebar-main">
            <div class="navbar-brand">
                <div class="container-fluid p-0">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-4 p-0">
                            <img id="brand-icon" class="d-block mx-auto" src="{{ asset('images/dict-transparent.png') }}" alt="dict-seal">
                        </div>
                        <div class="col-auto p-0">
                            <span id="brand-label" class="text-light" role="text">AMS</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div id="sidebar-wrapper-scrollable" class="d-block">

                {{-- shared ra sa tanan access level ang dashboard na link --}}
                
                <hr class="sidebar-separator d-block mx-auto my-1 bg-light">
                <!-- dashboard link group  -->
                <ul class="ul-group-override list-group list-group-flush mx-auto">
                    <li class="li-group-item-override list-group-item text-info {{ is_path_match('dashboard') }}">
                        <i class="list-icon fa fa-chart-line"></i><a class="list-label" href="{{ url('/dashboard') }}">Dashboard</a>
                    </li>
                </ul>
                <!-- end dashboard -->
                <hr class="sidebar-separator d-block mx-auto my-1 bg-light">

                @if     ($LoggedUserInfo['accesslevel'] === '3')

                    {{-- kung admin siya --}}

                    <ul class="ul-group-override list-group list-group-flush mx-auto">
                        <span class="ul-group-label py-3 text-info fw-bold" role="text">COMPONENTS</span>
                        <li class="li-group-item-override list-group-item text-info {{ is_path_match('') }}">
                            <i class="list-icon fa fa-users"></i><a class="list-label" href="#">Users</a>
                        </li>
                        <li class="li-group-item-override list-group-item text-info {{ is_path_match('') }}">
                            <i class="list-icon fa fa-clipboard"></i><a class="list-label" href="#">Item List</a>
                        </li>
                        <li class="li-group-item-override list-group-item text-info {{ is_path_match('') }}">
                            <i class="list-icon fa fa-user"></i><a class="list-label" href="#">Requisitioner</a>
                        </li>
                        <li class="li-group-item-override list-group-item text-info {{ is_path_match('') }}">
                            <i class="list-icon fa fa-list"></i><a class="list-label" href="#">Purchase Request List</a>
                        </li>
                    </ul>

                @elseif (
                            $LoggedUserInfo['accesslevel'] === '4' ||
                            $LoggedUserInfo['accesslevel'] === '5'
                        )

                    {{-- kung requisitioner or similar level --}}

                    <ul class="ul-group-override list-group list-group-flush mx-auto">
                        <span class="ul-group-label py-3 text-info fw-bold" role="text">COMPONENTS</span>
                        <li class="li-group-item-override list-group-item text-info {{ is_path_match('newpurchaserequest') }}">
                            <i class="list-icon fa fa-file"></i><a class="list-label" href="{{ url('/newpurchaserequest') }}">New Purchase Request</a>
                        </li>
                        <li class="li-group-item-override list-group-item text-info {{ is_path_match('') }}">
                            <i class="list-icon fa fa-list"></i><a class="list-label" href="#">Purchase Request List</a>
                        </li>
                        <li class="li-group-item-override list-group-item text-info {{ is_path_match('') }}">
                            <i class="list-icon fa fa-clipboard"></i><a class="list-label" href="#">Item List</a>
                        </li>
                        <li class="li-group-item-override list-group-item text-info {{ is_path_match('') }}">
                            <i class="list-icon fa fa-comment"></i><a class="list-label" href="#">Messages</a>
                        </li>
                    </ul>
                @else
                    {{-- debug: pag walay access level --}}
                    <h3 class="d-block mx-auto lead">Invalid Accesslevel</h3>

                @endif

                <hr class="sidebar-separator d-block mx-auto my-1 bg-light">
                <ul class="ul-group-override list-group list-group-flush mx-auto">
                    <span class="ul-group-label py-3 text-info fw-bold" role="text">INTERFACE</span>
                    <li class="li-group-item-override list-group-item text-info {{ is_path_match('') }}">
                        <i class="list-icon fa fa-wrench"></i><a class="list-label" href="/dashboard">Utilities</a>
                    </li>
                </ul>
                <hr class="sidebar-separator d-block mx-auto my-1 bg-light">
               
            </div>
        </div>
    </div>
</nav>


