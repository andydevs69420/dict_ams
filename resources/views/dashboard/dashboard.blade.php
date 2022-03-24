

@extends('layout.app-main')

@section('title', 'AMS | dashboard')

@section('dependencies')
    <link rel="stylesheet" href="{{ asset('css/dashboard/dashboard.css') }}">
    <!-- fontawesome css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@stop

@section('content')
    <div class="d-block w-100 h-100">
        <!-- label -->
        <span class="d-block text-muted px-2 px-md-5 py-4" role="text" style="font-size: 1.6em;">Dashboard</span>
        <!-- dahboard main content -->
        <div class="container-fluid px-2 px-md-5">
            <div class="row row-cols-2 row-cols-md-0">
                <!-- trap user type here! -->
                @if ($LoggedUserInfo['accesslevel'] === '3')
                    {{-- kung admin or similar level --}}
                    <div class="col-6 col-md-3 bg-dark">A</div>
                    <div class="col-6 col-md-3 bg-primary">B</div>
                    <div class="col-6 col-md-3 bg-warning">C</div>
                    <div class="col-6 col-md-3 bg-secondary">D</div>
                @elseif (
                            $LoggedUserInfo['accesslevel'] === '4' ||
                            $LoggedUserInfo['accesslevel'] === '5'
                        )
                    {{-- kung requisitioner or similar level --}}
                    <div class="col-md-3 bg-dark">A</div>
                    <div class="col-md-3 bg-primary">B</div>
                    <div class="col-12 col-md-3 bg-warning">C</div>
                @else
                    {{-- debug pag walay access level --}}
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h1 class="display-3">Invalid Accesslevel</h1>
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
    <!-- fontawesome js -->
    <script type="text/javascript" src="https://kit.fontawesome.com/0ad786b032.js" crossorigin="anonymous"></script>
@stop



