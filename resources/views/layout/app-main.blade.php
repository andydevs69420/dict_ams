<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- page style -->
    <link rel="stylesheet" href="{{ asset('css/global/app-main/app-main.css') }}">
    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- depenencies -->
    @section('dependencies')
       <!-- DEP -->
    @show
</head>
<body>
    <!-- nojavascript -->
    <noscript>
        <div class="d-flex flex-column align-items-center justify-content-center position-absolute w-100 h-100 bg-primary" style="z-index: 999999999;">
            <div class="d-block px-2 px-md-0">
                <p class="lead h6 text-light">DICT Accounting Management System |</p>
                <h3 class="display-3 text-light">This app works best with javascript.</h3>
            </div>
        </div>
        <style>
            body > *:not(:first-child)
            {
                display: none !important;
            }
            body > *:not(:-moz-first-node)
            {
                display: none !important;
            }
        </style>
    </noscript>
    <!-- end noscript -->
    <!-- content wrapper -->
    <div class="d-flex flex-row flex-nowrap w-100 h-100 overflow-hidden">
       
        @include('layout.sidebar')
      
        <!-- main content -->
        <div class="d-block w-100 h-100 bg-light">
            <!-- topbar -->
            <nav class="navbar navbar-expand-md navbar-light bg-light shadow px-4">
                <button class="btn btn-light border" data-bs-toggle="collapse" data-bs-target="#sidebar-collapse" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </nav>
            <!-- end topbar -->
            <!-- dashboard content -->
            <div class="container-fluid px-4">
                @section('content')
                @show
            </div>
            <!-- end dashboard content -->
        </div>
        <!-- end main content -->
    </div>
    <!-- end content wrapper -->
    <!-- jquery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- bootstrap js with popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- javascript dependencies -->
    @section('javascript')
        <!-- JS -->
    @show
</body>
</html>