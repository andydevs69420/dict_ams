@extends("layout.app-main")

@section("title", "AMS | user profile")

@section("dependencies")

    {{-- user profile css --}}
    <link rel="stylesheet" href="{{ asset("css/users/user-profile.css") }}">

@stop



@section("content")
    <div class="d-block py-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-10 col-md-9 col-lg-5 col-xl-3">
                    <div class="card border-0 bg-white shadow-lg">
                        <div class="d-block p-3 overflow-hidden">
                            <div class="user-profile__avatar-wrapper d-block position-relative mx-auto bg-light shadow">
                                
                                {{-- add enable edit if self profile --}}
                                @if(strcmp($user->user_id,Auth::user()->user_id) === 0)
                                    <div class="d-block position-absolute rounded-circle shadow" style="right: 0;bottom: 15%;transform: translateY(-15%);z-index: 3;">
                                        <input id="user-profile__edit-profile" accept=".jpg, .png" class="d-none" type="file" >
                                        <button type="label" class="btn btn-light rounded-circle" for="user-profile__edit-profile" style="padding:0;width: 35px;height: 35px;" onclick='javascript: $("#user-profile__edit-profile").click()'>
                                            <i class="fa-solid fa-pencil"></i>
                                        </button>
                                    </div>
                                @endif

                                <div class="user-profile__avatar-floater d-flex position-absolute align-items-center justify-content-center overflow-hidden">
                                    <img style="min-width: 100%;min-height: 100%;" src="data:image/png;base64,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" alt="Avatar">
                                </div>
                            </div>

                        </div>
                        <div class="card-body bg-white">
                            <h5 class="card-title text-center">{{ $user->lastname . ', ' . $user->firstname . ' ' . $user->middleinitial }}</h5>
                            <ul class="user_profile__short-info-list list-group list-group-flush bg-white">
                                <li class="list-group-item border-0 text-truncate">
                                    <i class="fa-solid fa-envelope"></i>
                                    <span class="text-muted text-truncate" role="text">{{ $user->email }}</span>
                                </li>
                                <li class="list-group-item border-0 text-truncate">
                                    <i class="fa-solid fa-building"></i>
                                    <span class="text-muted text-truncate" role="text">{{ App\Models\Designation::getDesignationById($user->designation_id) }}</span>
                                </li>
                                <li class="list-group-item border-0 text-truncate">
                                    <i class="fa-solid fa-universal-access"></i>
                                    <span class="text-muted text-truncate" role="text">{{ App\Models\Accesslevel::getAccesslevelById($user->accesslevel_id) }}</span>
                                </li>

                                {{-- add logout if self profile --}}
                                @if(strcmp($user->user_id,Auth::user()->user_id) === 0)
                                    <li class="list-group-item">
                                        <div class="shadow">
                                            <a class="btn btn-success w-100" href="{{ url("/logout") }}">
                                                <i class="fa-solid fa-right-from-bracket"></i>
                                                Signout
                                            </a>
                                        </div>
                                    </li>
                                @endif

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-10 col-md-9 col-lg-5 col-xl-8">
                   
                    <div class="card mt-4 mt-lg-0 border-0 bg-white shadow-lg">

                        {{-- add edit account if self profile --}}
                        @if(strcmp($user->user_id,Auth::user()->user_id) === 0)
                            <div class="card-header py-3 border-0 bg-white">
                                <div class="input-group mb-2">
                                    <input id="user-profile__enable-edit" class="form-check-input rounded-1" type="checkbox" name="enable" value="off">
                                    <label class="ms-2 text-dark" for="user-profile__enable-edit"><small class="text-muted" style="user-select:none;">{{ __("Enable editing") }}</small></label>
                                </div>
                            </div>
                        @endif

                        <div class="card-body bg-white">
                            <form action="">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12">
                                            <span class="text-muted" style="font-size: 1.4em; font-weight: 300;">User profile</span>
                                        </div>
                                        <div class="col-12">
                                            {{-- firstname group --}}
                                            <div class="shadow my-3">
                                                <div class="input-group">
                                                    <span class="input-group-text border-0 bg-primary text-light">FN</span>
                                                    <input class="form-control border-0 bg-white text-truncate" type="text" name="firstname" placeholder="{{ __("Firstname") }}" value="{{ $user->firstname }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            {{-- lastname group --}}
                                            <div class="shadow my-3">
                                                <div class="input-group">
                                                    <span class="input-group-text border-0 bg-primary text-light">LN</span>
                                                    <input class="form-control border-0 bg-white text-truncate" type="text" name="lastname" placeholder="Lastname" value="{{ $user->lastname }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            {{-- middleinital group --}}
                                            <div class="shadow my-3">
                                                <div class="input-group">
                                                    <span class="input-group-text border-0 bg-primary text-light">MI</span>
                                                    <input class="form-control border-0 bg-white text-truncate" type="text" name="middleinitial" placeholder="MI" value="{{ $user->middleinitial }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12"><hr class="bg-secondary"></div>
                                        <div class="col-12">
                                            <span class="text-muted" style="font-size: 1.4em; font-weight: 300;">Credentials</span>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            {{-- username group --}}
                                            <div class="shadow my-3">
                                                <div class="input-group">
                                                    <span class="input-group-text border-0 bg-primary text-light"><i class="fa-solid fa-user"></i></span>
                                                    <input class="form-control border-0 bg-white text-truncate" type="text" name="username" placeholder="Username" value="{{ $user->username }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-12 col-xl-6">
                                            {{-- email group --}}
                                            <div class="shadow my-3">
                                                <div class="input-group">
                                                    <span class="input-group-text border-0 bg-primary text-light"><i class="fa-solid fa-envelope"></i></span>
                                                    <input class="form-control border-0 bg-white text-truncate" type="text" name="email" placeholder="Email" value="{{ $user->email }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            {{-- password group --}}
                                            <div class="shadow my-3">
                                                <div class="input-group">
                                                    <span class="input-group-text border-0 bg-primary text-light"><i class="fa-solid fa-lock"></i></span>
                                                    <input class="form-control border-0 bg-white text-truncate" type="password" name="password" placeholder="Password" value="********">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            {{-- confirm password group --}}
                                            <div class="shadow my-3">
                                                <div class="input-group">
                                                    <span class="input-group-text border-0 bg-primary text-light"><i class="fa-solid fa-check-circle"></i></span>
                                                    <input class="form-control border-0 bg-white text-truncate" type="password" name="confirm-password" placeholder="Confirm password" value="********">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12"><hr class="bg-secondary"></div>
                                        <div class="col-12">
                                            <span class="text-muted" style="font-size: 1.4em; font-weight: 300;">Role</span>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            {{-- designation group --}}
                                            <div class="shadow my-3">
                                                <div class="input-group">
                                                    <span class="input-group-text border-0 bg-primary text-light"><i class="fa-solid fa-building"></i></span>
                                                    <select class="form-select border-0 bg-white text-truncate" type="text" name="confirm-password" placeholder="Confirm password">
                                                        @foreach(App\Models\Designation::all() as $desig)
                                                            <option value="{{ $desig->designation_id }}" @if(strcmp($desig->designation_id, $user->designation_id) === 0) selected @endif >{{ App\Models\Designation::getDesignationById($desig->designation_id) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            {{-- accesslevel group --}}
                                            <div class="shadow my-3">
                                                <div class="input-group">
                                                    <span class="input-group-text border-0 bg-primary text-light"><i class="fa-solid fa-universal-access"></i></span>
                                                    <select class="form-select border-0 bg-white text-truncate" type="text" name="accesslevel" placeholder="Accesslevel">

                                                        @foreach(App\Models\Accesslevel::all() as $al)
                                                            <option value="{{ $al->accesslevel_id }}" @if(strcmp($al->accesslevel_id, $user->accesslevel_id) === 0) selected @endif >{{ App\Models\Accesslevel::getAccesslevelById($al->accesslevel_id) }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- add update btn if self profile --}}
                                        @if(strcmp($user->user_id, Auth::user()->user_id) === 0)
                                            <div class="col-12 d-block">
                                                <div class="shadow my-3 w-100">
                                                    <button class="user-profile__update-btn btn btn-primary w-100">
                                                        <i class="fa-solid fa-refresh"></i>
                                                        UPDATE
                                                    </button>
                                                </div>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@stop


@section("javascript")

    {{-- javascript js --}}
    <script type="text/javascript" src="{{ asset("js/users/user-profile.js") }}"></script>

@stop
