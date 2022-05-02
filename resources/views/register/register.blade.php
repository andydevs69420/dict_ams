@extends('layout.master')

@section('title', 'AMS | Registration')

@section('dependencies')
    <link href="{{ asset('css/register/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/register/register.css') }}">
@stop

@section('body')
    <div class="container d-flex align-items-center justify-content-center w-100 h-100">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <!--<div class="card-header">{{ __('Register') }}</div>-->

                    <div class="card-body bg-white">
                        <div class="row justify-content-center">
                            <img id="dict-logo" src="{{ url("images/dict-transparent.png") }}" alt="" class="img-fluid">
                        </div>
                    </div>

                    <div class="row my-2">
                        <p class="title row justify-content-center">Register Here</p>
                    </div>

                    {{-- <div class="row border-bottom mb-4 separator">
                    </div> --}}

                    <form method="POST" action="{{ url('/register') }}" class="row pb-5 px-4 justify-content-center">
                        @csrf
                        <div class="row mb-1">
                            <div class="col-lg-5 p-2">
                                <input id="firstname" type="text" placeholder="Firstname" class="w-100 form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>

                                @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-5 p-2">
                                <input id="lastname" type="text" placeholder="Lastname" class="w-100 form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>

                                @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-2 p-2">
                                <input id="middleinitial" type="text" placeholder="M.I." class="w-100 form-control @error('middleinitial') is-invalid @enderror" name="middleinitial" value="{{ old('middleinitial') }}" required autocomplete="middleinitial" autofocus>

                                @error('middleinitial')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="row mb-1">
                            <div class="col-lg-6 p-2">
                                <input id="username" type="text" placeholder="Username" class="w-100 form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-6 p-2">
                                <input id="email" type="email" placeholder="Email" class="w-100 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="row mb-1">
                            <div class="col-lg-6 p-2">
                                <input id="password" type="password" placeholder="Password" class="w-100 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-lg-6 p-2">
                                <input id="password-confirm" placeholder="Confirm Password" type="password" class="w-100 form-control @error('password-confirm') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">
                            
                                
                                @error('password-confirm')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="row mb-1">
                            <div class="col-lg-6 p-2">
                                <select class="form-control form-select w-100 @error('designation') is-invalid @enderror" name="designation" id="designation" required>
                                    <option selected disabled>Select Designation</option>
                                    {{-- <option value=1>ITO 1</option>
                                    <option value=2>ITO 2</option>
                                    <option value=3>Enginner 1</option>
                                    <option value=4>Enginner 2</option>
                                    <option value=5>ISA 1</option>
                                    <option value=6>PDO 1</option>
                                    <option value=7>Regional Director</option>
                                    <option value=8>Assistant Director</option>
                                    <option value=9>Chief Admin</option> --}}

                                    @foreach ($designations as $d)
                                        <option value={{ $d['designation_id'] }}>{{ $d['designation'] }}</option>
                                    @endforeach

                                </select>
                                @error('designation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-6 p-2">
                                <select class="form-control form-select w-100 @error('accesslevel') is-invalid @enderror" name="accesslevel" id="accesslevel" required>
                                    <option selected disabled>Select Access Level</option>
                                    
                                    {{-- <option value=1>Regional Director</option>
                                    <option value=2>Assistant Regional Director</option>
                                    <option value=3>Chief Admin Officer</option>
                                    <option value=4>Provincial Officer</option>
                                    <option value=5>Focal</option>
                                    <option value=6>Inspector</option>
                                    <option value=7>BAC Member</option>
                                    <option value=8>BAC Chair</option>
                                    <option value=9>Canvasser</option>
                                    <option value=10>Supply Officer</option>
                                    <option value=11>Budget Officer</option>
                                    <option value=12>Chief TOD</option> --}}

                                    @foreach ($accesslevels as $als)
                                        <option value={{ $als['accesslevel_id'] }}>{{ $als['accesslevel'] }}</option>
                                    @endforeach

                                </select>

                                @error('accesslevel')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="row mt-4">
                            <div class="col d-flex h-100">
                                <p class="my-auto reg-notice">*You must fill in all fields to proceed</p>
                            </div>
                            <div class="col d-flex justify-content-end h-100">
                                <a href="{{ '/login' }}" class="btn btn-secondary cancel-button mx-2">
                                    {{ __('Cancel') }}
                                </a>
                                <button type="submit" class="btn register-button mx-2">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
            
                </div>
            </div>
        </div>
    </div>
@stop
