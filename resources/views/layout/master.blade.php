<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield("title")</title>
    <link rel="shortcut icon" href="{{ asset('images/dict-transparent.png') }}" type="image/x-icon">

    {{-- MASTER layout css --}}
    <link rel="stylesheet" href="{{ asset('css/webpack/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global/master/master.css') }}">

    {{-- OTHER CSS|JS dependencies (from extended) --}}
    @yield("dependencies")

</head>
<body>
  
    <noscript>

        <div class="master__noscript-content-wrapper d-flex flex-column align-items-center justify-content-center position-absolute w-100 h-100">
            <div class="d-block px-2 px-md-0">
                <p class="lead h6 text-light">DICT Accounting Management System |</p>
                <h3 class="display-3 text-light">This app works best with Javascript.</h3>
            </div>
        </div>

        <style>
            body > *:not(:first-child)
            { display: none !important; }
            body > *:not(:-moz-first-node)
            { display: none !important; }
        </style>

    </noscript>

    @yield("body")
    
    {{-- MASTER layout js --}}
    <script type="text/javascript" src="{{ asset('js/webpack/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/global/master/master.js') }}"></script>

    {{-- OTHER JS dependencies (from extended) --}}
    @yield("javascript")

</body>
</html>