

@extends('layout.app-main')

@section('title', 'AMS | dashboard')

@section('dependencies')
    <link rel="stylesheet" href="{{ asset('css/dashboard/dashboard.css') }}">
@stop

@section('content')
    <div class="d-block w-100 h-100">
        <!-- label -->
        <span class="d-block text-muted px-2 px-md-5 py-4" role="text" style="font-size: 1.6em;">Dashboard</span>
        <!-- dahboard main content -->
        <div class="container-fluid">
            <div class="row row-cols-2 row-cols-md-0 px-2 px-md-5 py-4">
                <!-- trap user type here! -->
                @if ($LoggedUserInfo['accesslevel'] === '1')
                    <!-- if admin -->
                    <div class="col-6 col-md-3 m-0 p-2 p-md-0">
                        <div class="dashboard-tile tile-blue-variant d-block position-relative overflow-hidden my-0 mx-auto mx-lg-0 bg-light shadow-lg">
                            <div class="d-block position-absolute w-100 h-100" style="inset: 0;">
                                <span class="display-6" role="text">
                                    !! | <br>
                                    <p class="lead text-muted">Ayha na ang dahboard pag humana ang request</p>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 m-0 p-2 p-md-0">
                        <div class="dashboard-tile tile-green-variant d-block position-relative overflow-hidden my-0 mx-auto mx-lg-0 bg-light shadow-lg">
                            <div class="d-block position-absolute w-100 h-100" style="inset: 0;">
                                <span class="display-6" role="text">
                                    !! | <br>
                                    <p class="lead text-muted">Ayha na ang dahboard pag humana ang request</p>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 m-0 p-2 p-md-0">
                        <div class="dashboard-tile tile-light-blue-variant d-block position-relative overflow-hidden my-0 mx-auto mx-lg-0 bg-light shadow-lg">
                            <div class="d-block position-absolute w-100 h-100" style="inset: 0;">
                                <span class="display-6" role="text">
                                    !! | <br>
                                    <p class="lead text-muted">Ayha na ang dahboard pag humana ang request</p>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 m-0 p-2 p-md-0">
                        <div class="dashboard-tile tile-light-green-variant d-block position-relative overflow-hidden my-0 mx-auto mx-lg-0 bg-light shadow-lg">
                            <div class="d-block position-absolute w-100 h-100" style="inset: 0;">
                                <span class="display-6" role="text">
                                    !! | <br>
                                    <p class="lead text-muted">Ayha na ang dahboard pag humana ang request</p>
                                </span>
                            </div>
                        </div>
                    </div>
                @elseif ($LoggedUserInfo['accesslevel'] === '2')
                    <!-- if supply officer or others -->
                    <div class="col-md-3 bg-dark">A</div>
                    <div class="col-md-3 bg-primary">B</div>
                    <div class="col-12 col-md-3 bg-warning">C</div>
                @endif
            </div>
            
        </div>
    </div>
@stop

@section('javascript')
    <!-- fontawesome -->
    <script type="text/javascript" src="https://kit.fontawesome.com/0ad786b032.js" crossorigin="anonymous"></script>
@stop



