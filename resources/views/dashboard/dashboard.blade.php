@extends('layout.app-main')

@section('title', 'AMS | dashboard')

@section('dependencies')
    <link rel="stylesheet" href="{{ asset('css/dashboard/dashboard.css') }}">
@stop


@section('content')
    <!-- label -->
    <span class="d-block py-4 text-muted" role="text" style="font-size: 1.6em;">Dashboard</span>
    <!-- dahboard main content -->
    <div class="container-fluid overflow-auto">
        <div class="row row-cols-2 row-cols-md-0">
            <!-- trap user type here! -->
            @if ($access_level_id === 1)
                <!-- if admin -->
                <div class="col-6 col-md-3 bg-dark">A</div>
                <div class="col-6 col-md-3 bg-primary">B</div>
                <div class="col-6 col-md-3 bg-warning">C</div>
                <div class="col-6 col-md-3 bg-danger">D</div>
            @elseif ($access_level_id === 2)
                <!-- if supply officer or others -->
                <div class="col-md-3 bg-dark">A</div>
                <div class="col-md-3 bg-primary">B</div>
                <div class="col-12 col-md-3 bg-warning">C</div>
            @endif
        </div>
    </div>
@stop

@section('javascript')
    <!-- fontawesome -->
    <script type="text/javascript" src="https://kit.fontawesome.com/0ad786b032.js" crossorigin="anonymous"></script>
@stop