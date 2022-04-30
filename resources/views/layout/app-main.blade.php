
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield("title")</title>
    <link rel="shortcut icon" href="{{ asset('images/dict-transparent.png') }}" type="image/x-icon">

    {{-- APP-MAIN layout css --}}
    <link rel="stylesheet" href="{{ asset('css/webpack/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global/app-main/app-main.css') }}">

    {{-- TOPBAR & SIDEBAR css --}}
    <link rel="stylesheet" href="{{ asset('css/components/topbar/topbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/sidebar/sidebar.css') }}">
    
    {{-- OTHER CSS|JS dependencies (from extended) --}}
    @yield("dependencies")

</head>
<body>

    <noscript>

        <div class="app-main__noscript-content-wrapper d-flex flex-column align-items-center justify-content-center position-absolute w-100 h-100">
            <div class="d-block px-2 px-md-0">
                <p class="lead h6 text-light">{{ __("DICT Accounting Management System |") }}</p>
                <h3 class="display-3 text-light">{{ __("This app works best with Javascript.") }}</h3>
            </div>
        </div>

        <style>
            body > *:not(:first-child)
            { display: none !important; }
            body > *:not(:-moz-first-node)
            { display: none !important; }
        </style>

    </noscript>
    
    <main class="d-flex flex-row flex-nowrap w-100 h-100 overflow-hidden">
        
        <x-sidebar access-level-id="{{ Auth::user()->accesslevel_id }}"></x-sidebar>

        <div class="app-main__content-root d-block w-100 h-100 bg-light">

            <x-topbar username="{{ Auth::user()->username }}"></x-topbar>

            <div class="app-main__content-wrapper d-block w-100">
                @yield("content")
            </div>
            
        </div>
    </main>
    
    {{-- APP-MAIN layout js --}}
    <script type="text/javascript" src="{{ asset('js/webpack/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/global/app-main/app-main.js') }}"></script>

    {{-- TOPBAR & SIDEBAR js --}}
    <script type="text/javascript" src="{{ asset('js/components/topbar/topbar.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/components/sidebar/sidebar.js') }}"></script>

    {{-- OTHER JS dependencies (from extended) --}}
    @yield("javascript")

</body>
</html>
