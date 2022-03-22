@extends('layout.master')

@section('title', 'AMS | Login')

@section('dependencies')
    <!-- page style -->
    <link rel="stylesheet" href="{{ asset('css/login/login.css') }}">
    <!-- quicksand font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
@stop

@section('body')
    <div id="root" class="d-block d-md-flex align-items-center justify-content-center w-100 h-100 bg-primary">
        <div id="center-panel" class="d-block position-relative py-4 bg-white">
            <!-- app brand -->
            <div id="app-brand" class="d-block mx-auto">
                <div class="d-flex flex-row flex-md-column align-items-center justify-content-md-center flex-nowrap">
                    <img id="brand-icon" class="d-block my-0 my-md-1" src="{{ asset('images/dict-logo.jpg') }}" alt="dict-logo">
                    <h4 class="h4 my-0 my-md-1 text-dark" role="text">Login Here</h4>
                </div>
            </div>
            <!-- element as spacing -->
            <div class="d-none d-md-block py-2"></div>
            <!-- form -->
            <form class="page-form-0 d-flex flex-column align-items-center justify-content-center mx-auto form-group" action="/dashboard" methd="POST">
                <div class="input-group my-2">
                    <span class="input-group-text"><i class="text-dark fa fa-user"></i></span>
                    <input class="form-control" type="text" name="username" placeholder="Username" required>
                </div>
                <div class="input-group my-2">
                    <span class="input-group-text"><i class="text-dark fa fa-lock"></i></span>
                    <input class="form-control" type="password" name="password" placeholder="Password" required>
                </div>
                <div class="input-group">
                    <input id="remember-me" class="form-check-input" type="checkbox" name="remember-me">
                    <label class="mx-1 text-dark" for="remember-me"><small class="text-muted" style="user-select:none;">Remember me</small></label>
                </div>
                <button class="btn btn-primary lead my-2 mt-md-2 mb-md-0 w-100" type="submit">Login</button>
                <hr class="my-1 my-md-3 w-100">
                <a class="btn btn-primary lead my-2 my-md-0 w-100">Register</a>
            </form>
        </div>
    </div>
@stop

@section('javascript')
    <!-- fontawesome -->
    <script type="text/javascript" src="https://kit.fontawesome.com/0ad786b032.js" crossorigin="anonymous"></script>
@stop



