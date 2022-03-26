<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="shortcut icon" href="{{ asset('images/dict-transparent.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/global/master/master.css') }}">
    @yield('dependencies')
</head>
<body>
  
    <noscript>

        <div class="master__noscript-content-wrapper d-flex flex-column align-items-center justify-content-center position-absolute w-100 h-100 bg-primary">
            <div class="d-block px-2 px-md-0">
                <p class="lead h6 text-light">DICT Accounting Management System |</p>
                <h3 class="display-3 text-light">This app works best with javascript.</h3>
            </div>
        </div>

        <style>
            body > *:not(:first-child)
            { display: none !important; }
            body > *:not(:-moz-first-node)
            { display: none !important; }
        </style>

    </noscript>

    @yield('body')
   
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/0ad786b032.js" crossorigin="anonymous"></script>
    @yield('javascript')

</body>
</html>