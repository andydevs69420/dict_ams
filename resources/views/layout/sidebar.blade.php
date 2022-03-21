
<?php
    /* para ma automatic na ang active na link based sa route */
    function is_path_match(String $path)
    {
        return (request()->is($path)) ? 'active-link' : 'inactive-link';
    }
?>

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
            
            {{-- shared ra sa tanan access level ang dashboard na link --}}
            
            <hr class="sidebar-separator d-block mx-auto my-1 bg-light">
            <!-- dashboard link group  -->
            <ul class="ul-group-override list-group list-group-flush mx-auto">
                <li class="li-group-item-override list-group-item text-info {{ is_path_match('dashboard') }}">
                    <i class="list-icon fa fa-chart-line"></i><a class="list-label" href="/dashboard">Dashboard</a>
                </li>
            </ul>
            <!-- end dashboard -->
            <hr class="sidebar-separator d-block mx-auto my-1 bg-light">

            @if     ($access_level_id === 1)

                {{-- kung admin siya --}}

                <ul class="ul-group-override list-group list-group-flush mx-auto">
                    <span class="py-3 text-info fw-bold" style="font-size: .7em;" role="text">COMPONENTS</span>
                    <li class="li-group-item-override list-group-item text-info {{ is_path_match('users') }}">
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
                        $access_level_id === 2 ||
                        $access_level_id === 3
                    )

                {{-- kung supply officer or similar level --}}

                <ul class="ul-group-override list-group list-group-flush mx-auto">
                    <span class="py-3 text-info fw-bold" style="font-size: .7em;" role="text">COMPONENTS</span>
                    <li class="li-group-item-override list-group-item text-info {{ is_path_match('users') }}">
                        <i class="list-icon fa fa-users"></i><a class="list-label" href="#">Users</a>
                    </li>
                    <li class="li-group-item-override list-group-item text-info {{ is_path_match('') }}">
                        <i class="list-icon fa fa-clipboard"></i><a class="list-label" href="#">Item List</a>
                    </li>
                    <li class="li-group-item-override list-group-item text-info {{ is_path_match('') }}">
                        <i class="list-icon fa fa-list"></i><a class="list-label" href="#">Purchase Request List</a>
                    </li>
                </ul>

            @endif

            <hr class="sidebar-separator d-block mx-auto my-1 bg-light">
            <ul class="ul-group-override list-group list-group-flush mx-auto">
                <span class="py-3 text-info fw-bold" style="font-size: .7em;" role="text">INTERFACE</span>
                <li class="li-group-item-override list-group-item text-info {{ is_path_match('') }}">
                    <i class="list-icon fa fa-wrench"></i><a class="list-label" href="/dashboard">Utilities</a>
                </li>
            </ul>
            <hr class="sidebar-separator d-block mx-auto my-1 bg-light">

        </div>
    </div>
</nav>


