
<?php
    /* para ma automatic na ang active na link based sa route */
    function is_path_match(String $path)
    {
        return (request()->is($path)) ? 'active-link' : '';
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
            <ul class="li-group-override list-group list-group-flush mx-auto">
                <li class="list-group-item-override list-group-item text-info {{ is_path_match('dashboard') }}">
                    <i class="list-icon fa fa-chart-line"></i><a class="list-label" href="/dashboard">Dashboard</a>
                </li>
            </ul>
            <!-- end dashboard -->
            <hr class="sidebar-separator d-block mx-auto my-1 bg-light">

            @if     ($access_level_id === 1)

                {{-- kung admin siya --}}

                <ul class="li-group-override list-group list-group-flush mx-auto">
                    <small class="py-3 text-info">COMPONENTS</small>
                    <li class="list-group-item-override list-group-item-light text-info {{ is_path_match('users') }}">
                        <i class="list-icon fa fa-users"></i><a class="list-label" href="/dashboard">Users</a>
                    </li>
                    <li class="list-group-item-override list-group-item-light text-info {{ is_path_match('users') }}">
                        <i class="list-icon fa fa-users"></i><a class="list-label" href="/dashboard">Item List</a>
                    </li>
                </ul>

            @elseif (
                        $access_level_id === 2 ||
                        $access_level_id === 3
                    )

                {{-- kung supply officer or similar level --}}

                <span role="text">YEAH</span>

            @endif

        </div>
    </div>
</nav>


