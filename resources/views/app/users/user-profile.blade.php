@extends("layout.app-main")

@section("title", "AMS | user profile")

@section("dependencies")

    {{-- user profile css --}}
    <link rel="stylesheet" href="{{ asset("css/users/user-profile.css") }}">

@stop



@section("content")
    <div class="d-block py-3">

        @if(Session::has("info"))
            {{-- on success modal --}}
            <div class="modal fade" tabindex="-1" aria-hidden="true" style="padding-right: 0 !important;">
                <div class="modal-dialog border-0">
                    <div class="modal-content border-0">
                        <div class="modal-header border-0">
                            <h5 class="modal-title">Success</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <span class="h5" role="text" style="font-weight: 300;">
                                {{ session("info") }}
                            </span>
                        </div>
                        <div class="modal-footer border-0">
                            <div class="mx-auto w-25 shadow">
                                <button type="button" class="btn w-100 btn-primary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-9 col-lg-5 col-xl-4 col-xxl-3">
                    <div class="card border-0 bg-white shadow-lg">
                        <div class="d-block p-3 overflow-hidden position-relative">

                            {{-- add delete profile --}}
                            @if(strcmp($user->user_id,Auth::user()->user_id) === 0)
                                <div class="dropdown dropdown-end position-absolute" style="top: 10px; left:10px;">
                                    <button id="user-profile__image-option" class="btn" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis-v text-muted"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end rounded shadow" aria-labelledby="user-profile__image-option">
                                        <li>

                                            @if(strcmp(App\Models\UserProfileImages::getProfileImagePathByUserId($user->user_id), "images/no-image.png") === 0)
                                                <span class="dropdown-item text-muted" style="cursor: pointer"> 
                                                    <i class="fa-solid fa-trash"></i>
                                                    &nbsp;
                                                    Delete profile image 
                                                </span>
                                            @else
                                                <a class="dropdown-item" href="{{ url("/user/deleteprofilepicture?user=" . \Illuminate\Support\Facades\Crypt::encrypt(Auth::user()->user_id)) }}"> 
                                                    <i class="fa-solid fa-trash"></i>
                                                    &nbsp;
                                                    Delete profile image 
                                                </a>
                                            @endif
                                            
                                        </li>
                                    </ul>
                                </div>
                            @endif

                            <div class="user-profile__avatar-wrapper d-block position-relative mx-auto bg-white shadow">
                                
                                {{-- add enable edit if self profile --}}
                                @if(strcmp($user->user_id,Auth::user()->user_id) === 0)
                                    <div class="d-block position-absolute rounded-circle shadow" style="right: 0;bottom: 15%;transform: translateY(-15%);z-index: 3;">
                                        
                                        <form id="user-profile__image-upload" action="{{ url("/user/uploadprofilepicture") }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input id="user-profile__edit-profile" class="d-none" accept=".jpg, .png" name="user-image-upload" type="file">
                                        </form>
                                        
                                        <button type="label" class="btn btn-light rounded-circle" for="user-profile__edit-profile" style="padding:0;width: 35px;height: 35px;" onclick='javascript: $("#user-profile__edit-profile").click()'>
                                            <i class="fa-solid fa-pencil"></i>
                                        </button>

                                    </div>
                                @endif

                                <div class="user-profile__avatar-floater d-flex position-absolute align-items-center justify-content-center overflow-hidden">
                                    <img class="img" src="{{ asset(App\Models\UserProfileImages::getProfileImagePathByUserId($user->user_id)) }}" alt="Avatar" style="min-width: 100%;min-height: 100%;">
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
                                                {{ __("SIGNOUT") }}
                                            </a>
                                        </div>
                                    </li>
                                @endif

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-9 col-lg-5 col-xl-8">
                   
                    <div class="card mt-4 mt-lg-0 border-0 bg-white shadow-lg">

                        {{-- add edit account if self profile --}}
                        @if(strcmp($user->user_id,Auth::user()->user_id) === 0)
                            <div class="card-header py-3 border-0 bg-white">
                                <div class="input-group mb-2">
                                    <input id="user-profile__enable-edit" class="form-check-input rounded-1" type="checkbox" name="enable" value="off" @if($errors->all()) checked @endif>
                                    <label class="ms-2 text-dark" for="user-profile__enable-edit"><small class="text-muted" style="user-select:none;">{{ __("Enable editing") }}</small></label>
                                </div>
                            </div>
                        @endif

                        <div class="card-body bg-white">
                            <form id="user-profile__edit-profile-form" action="{{ url("/user/editprofile") }}" method="POST">

                                @csrf

                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12">
                                            <span class="text-muted" style="font-size: 1.4em; font-weight: 300;" role="text">User profile</span>
                                        </div>
                                        <div class="col-12">
                                            {{-- firstname group --}}
                                            <div class="shadow my-3">
                                                <div class="input-group">
                                                    <span class="input-group-text border-0 bg-primary text-light">FN</span>
                                                    <input class="form-control form-control-sm border-0 bg-white text-truncate" type="text" name="firstname" placeholder="{{ __("Firstname") }}" value="{{ old("firstname")? old("firstname") : $user->firstname }}" disabled autocomplete="firstname">
                                                </div>
                                            </div>
                                            @error("firstname")
                                                <span class="text-danger small" role="text">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            {{-- lastname group --}}
                                            <div class="shadow my-3">
                                                <div class="input-group">
                                                    <span class="input-group-text border-0 bg-primary text-light">LN</span>
                                                    <input class="form-control form-control-sm border-0 bg-white text-truncate" type="text" name="lastname" placeholder="{{ __("Lastname") }}" value="{{ old("lastname")? old("lastname") : $user->lastname }}" disabled>
                                                </div>
                                            </div>
                                            @error("lastname")
                                                <span class="text-danger small" role="text">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            {{-- middleinital group --}}
                                            <div class="shadow my-3">
                                                <div class="input-group">
                                                    <span class="input-group-text border-0 bg-primary text-light">MI</span>
                                                    <input class="form-control form-control-sm border-0 bg-white text-truncate" type="text" name="middleinitial" placeholder="{{__("MI") }}" value="{{ old("middleinitial")? old("middleinitial") : $user->middleinitial }}" disabled>
                                                </div>
                                            </div>
                                            @error("middleinitial")
                                                <span class="text-danger small" role="text">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12"><hr class="bg-secondary"></div>
                                        <div class="col-12">
                                            <span class="text-muted" style="font-size: 1.4em; font-weight: 300;" role="text">Credentials</span>
                                        </div>
                                        <div class="col-12 col-lg-12 col-xl-6">
                                            {{-- username group --}}
                                            <div class="shadow my-3">
                                                <div class="input-group">
                                                    <span class="input-group-text border-0 bg-primary text-light"><i class="fa-solid fa-user"></i></span>
                                                    <input class="form-control form-control-sm border-0 bg-white text-truncate" type="text" name="username" placeholder="{{ __("Username") }}" value="{{ old("username")? old("username") : $user->username }}" disabled>
                                                </div>
                                            </div>
                                            @error("username")
                                                <span class="text-danger small" role="text">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-lg-12 col-xl-6">
                                            {{-- email group --}}
                                            <div class="shadow my-3">
                                                <div class="input-group">
                                                    <span class="input-group-text border-0 bg-primary text-light"><i class="fa-solid fa-envelope"></i></span>
                                                    <input class="form-control form-control-sm border-0 bg-white text-truncate" type="text" name="email" placeholder="{{ __("Email") }}" value="{{ old("email")? old("email") :$user->email }}" disabled>
                                                </div>
                                            </div>
                                            @error("email")
                                                <span class="text-danger small" role="text">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-lg-12 col-xl-6">
                                            {{-- password group --}}
                                            <div class="shadow my-3">
                                                <div class="input-group">
                                                    <span class="input-group-text border-0 bg-primary text-light"><i class="fa-solid fa-lock"></i></span>
                                                    <input class="form-control form-control-sm border-0 bg-white text-truncate" type="password" name="password" placeholder="{{ __("Password") }}" value="{{ old("password")? old("password") : "********" }}" disabled>
                                                </div>
                                            </div>
                                            @error("password")
                                                <span class="text-danger small" role="text">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-lg-12 col-xl-6">
                                            {{-- confirm password group --}}
                                            <div class="shadow my-3">
                                                <div class="input-group">
                                                    <span class="input-group-text border-0 bg-primary text-light"><i class="fa-solid fa-check-circle"></i></span>
                                                    <input class="form-control form-control-sm border-0 bg-white text-truncate" type="password" name="password_confirmation" placeholder="{{ __("Confirm password") }}" value="{{ old("password_confirmation")? old("password_confirmation") : "********" }}" disabled>
                                                </div>
                                            </div>
                                            @error("confirm-password")
                                                <span class="text-danger small" role="text">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12"><hr class="bg-secondary"></div>
                                        <div class="col-12">
                                            <span class="text-muted" style="font-size: 1.4em; font-weight: 300;" role="text">Role</span>
                                        </div>
                                        <div class="col-12 col-lg-12 col-xl-6">
                                            {{-- designation group --}}
                                            <div class="shadow my-3">
                                                <div class="input-group">
                                                    <span class="input-group-text border-0 bg-primary text-light"><i class="fa-solid fa-building"></i></span>
                                                    <select class="form-select form-select-sm border-0 bg-white text-truncate" type="text" name="designation" placeholder="{{__("Designation") }}" disabled>
                                                        @foreach(App\Models\Designation::all() as $desig)
                                                            <option value="{{ $desig->designation_id }}" @if(strcmp($desig->designation_id, $user->designation_id) === 0) selected @endif >{{ App\Models\Designation::getDesignationById($desig->designation_id) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @error("designation")
                                                <span class="text-danger small" role="text">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-lg-12 col-xl-6">
                                            {{-- accesslevel group --}}
                                            <div class="shadow my-3">
                                                <div class="input-group">
                                                    <span class="input-group-text border-0 bg-primary text-light"><i class="fa-solid fa-universal-access"></i></span>
                                                    <select class="form-select form-select-sm border-0 bg-white text-truncate" type="text" name="accesslevel" placeholder="{{ __("Accesslevel") }}" disabled>
                                                        
                                                        {{-- "14" := admin --}}
                                                        @if(strcmp($user->accesslevel_id, "14") === 0)
                                                            <option value="{{ Auth::user()->accesslevel_id }}" selected>{{ App\Models\Accesslevel::getAccesslevelById(Auth::user()->accesslevel_id) }}</option>
                                                        @else
                                                            @foreach(App\Models\Accesslevel::all() as $al)
                                                                <option value="{{ $al->accesslevel_id }}" @if(strcmp($al->accesslevel_id, $user->accesslevel_id) === 0) selected @endif >{{ App\Models\Accesslevel::getAccesslevelById($al->accesslevel_id) }}</option>
                                                            @endforeach
                                                        @endif

                                                    </select>
                                                </div>
                                            </div>
                                            @error("accesslevel")
                                                <span class="text-danger small" role="text">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- add update btn if self profile --}}
                                        @if(strcmp($user->user_id, Auth::user()->user_id) === 0)
                                            <div class="col-12 d-block">
                                                <div class="user-profile__update-btn-wrapper shadow my-3 float-end">
                                                    <button class="user-profile__update-btn btn btn-primary w-100" disabled>
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

    @if($errors->any())
        <script defer>
            jQuery(() => {
                window.updateFormState("on");
            })
        </script>
    @endif

    @if (Session::has("info"))
        <script>
            jQuery(() => {
                $(".modal").modal("show");
            });
        </script> 
    @endif

@stop
