

@extends(
    'layout.app-main', 
    [
        'accesslevelid' => $LoggedUserInfo['accesslevel_id'], // para sa sidebar
        'username'      => $LoggedUserInfo['username']        // para sa topbar
    ]
)

@section('title', 'AMS | job order')

@section('dependencies')

    {{-- NEW JOB ORDER css --}}
    <link rel="stylesheet" href="{{ asset('') }}">

    {{-- PROGRESS BAR css --}}
    <link rel="stylesheet" href="{{ asset('css/components/progressbar/progressbar.css') }}">

    {{-- PR & JO css --}}
    <link rel="stylesheet" href="{{ asset('css/components/global/pr-and-jo/pr-and-jo.css') }}">

@stop

@section('content')
    Mapulihan ni kay amper
@stop

@section('javascript')
    Mapulihan ni kay amper
@stop






