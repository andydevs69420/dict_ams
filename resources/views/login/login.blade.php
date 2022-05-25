@extends("layout.master")

@section("title", "AMS | Login")

@section("dependencies")

    {{-- PAGE FONT dependency --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">

    {{-- LOGIN css --}}
    <link rel="stylesheet" href="{{ asset("css/login/login.css") }}">
    
@stop

@section("body")
    <main class="login__main d-block d-md-flex align-items-center justify-content-center w-100 h-100 bg-primary">
        <div class="login__center-panel d-block position-relative py-4 bg-white">
            <!-- app brand -->
            <div class="login__app-brand d-block mx-auto">
                <div class="d-flex flex-row flex-md-column align-items-center justify-content-md-center flex-nowrap">
                    <img class="login__brand-icon d-block my-0 my-md-1" src="{{ asset("images/dict-logo.jpg") }}" alt="dict-logo">
                    <h4 class="h4 my-0 my-md-1 text-dark" role="text">Login Here</h4>
                </div>
            </div>
            <!-- element as spacing -->
            <div class="d-none d-md-block py-2"></div>
            <!-- form -->
            <form class="login__page-form-0 d-flex flex-column align-items-center justify-content-center mx-auto form-group" action="/login" method="POST">
            
                @error("error")
                    <div class="alert alert-danger alert-dismissible fade show w-100" role="alert">
                        <small class="text-danger">{{ __($message) }}</small>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @enderror

                @csrf

                <div class="input-group my-2">
                    <span class="input-group-text text-white"><i class="fa fa-user"></i></span>
                    <input class="form-control" type="text" name="username" placeholder="{{ __("Username") }}" required value="{{ old("username") }}">
                </div>
                <div class="input-group my-2">
                    <span class="input-group-text text-white"><i class="fa fa-lock"></i></span>
                    <input class="form-control" type="password" name="password" placeholder="{{ __("Password") }}" required>
                </div>
                <div class="input-group">
                    <input id="remember-me" class="form-check-input" type="checkbox" name="remember">
                    <label class="mx-1 text-dark" for="remember-me"><small class="text-muted" style="user-select:none;">{{ __("Remember me") }}</small></label>
                </div>
                <button class="login__login-btn btn text-white lead my-2 mt-md-2 mb-md-0 w-100" type="submit">{{ __("Login") }}</button>
                <hr class="my-1 my-md-3 w-100">
                <a class="login__register-btn btn text-white lead my-2 my-md-0 w-100" href="{{ url("/register") }}">{{ __("Register") }}</a>
            </form>
        </div>
    </main>
@stop


@section("javascript")

    {{-- LOGIN js --}}
    <script type="text/javascript" src="{{ asset("js/login/login.js") }}"></script>

@stop 

