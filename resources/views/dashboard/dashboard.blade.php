

@extends(
    'layout.app-main', 
    [
        'accesslevelid' => $LoggedUserInfo['accesslevel_id'], // para sa sidebar
        'username'      => $LoggedUserInfo['username']        // para sa topbar
    ]
)

@section('title', 'AMS | dashboard')

@section('dependencies')

    {{-- DASHBOARD css --}}
    <link rel="stylesheet" href="{{ asset('css/dashboard/dashboard.css') }}">

@stop

@section('content')
    <div class="d-block w-100 h-100">
        <!-- label -->
        <span class="dashboard__dashboard-header-label d-block text-muted px-2 px-md-5 py-4" role="text">Dashboard</span>
        <!-- dahboard main content -->
        <div class="container-fluid px-2 px-md-5">
            <div class="row row-cols-2 row-cols-md-0">
                
                {{-- trap user type here! --}}
                
                {{-- TODO: Implement!! --}}
                @if (strcmp($LoggedUserInfo['accesslevel_id'], '3') === 0)
                    {{-- kung admin or similar level --}}
                    <div class="col-6 col-md-3 bg-dark">A</div>
                    <div class="col-6 col-md-3 bg-primary">B</div>
                    <div class="col-6 col-md-3 bg-warning">C</div>
                    <div class="col-6 col-md-3 bg-secondary">D</div>
                {{-- TODO: Implement!! --}}
                @elseif (
                            strcmp($LoggedUserInfo['accesslevel_id'],'4')  === 0 ||
                            strcmp($LoggedUserInfo['accesslevel_id'],'5')  === 0 ||
                            strcmp($LoggedUserInfo['accesslevel_id'],'13') === 0
                        )
                    {{-- kung requisitioner or similar level --}}
                    <div class="col-md-3 bg-dark">A</div>
                    <div class="col-md-3 bg-primary">B</div>
                    <div class="col-12 col-md-3 bg-warning">C</div>
                @else
                    {{-- debug pag walay access level --}}
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h1 class="display-3">Invalid Accesslevel := {{ $LoggedUserInfo['accesslevel_id'] }}</h1>
                            <p class="lead">Wala pa na implement gooys!</p>
                            <hr class="my-2">
                            <p>TBD</p>
                            <p class="lead">
                                <a class="btn btn-primary btn-lg" href="{{ url('/login') }}" role="button">Login</a>
                            </p>
                        </div>
                    </div>
                @endif
            </div>
            
        </div>
    </div>
@stop

@section('javascript')

    {{-- DASHBOARD js --}}
    <script type="text/javascript" src="{{ asset('js/dashboard/dashboard.js') }}"></script>
   
@stop



