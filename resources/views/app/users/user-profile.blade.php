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
                <div class="col-12 col-md-6 col-lg-5 col-xl-4">
                    <div class="card border-0 overflow-hidden bg-white shadow-lg">
                        <div class="user-profile__user-image-wrapper d-flex align-items-center justify-content-center">
                            <img class="card-img-top" src="https://photos.smugmug.com/Kyoto/Kyoto-Romantic-Cherry-Blossom-Itinerary/i-dQdfWJD/0/4575e10a/L/shutterstock_1017748132-L.jpg" alt="Card image cap">
                        </div>
                        <div class="card-body bg-white">
                            <h5 class="card-title">{{ $user->lastname . ', ' . $user->firstname . ' ' . $user->middleinitial }}</h5>
                            <ul class="user_profile__short-info-list bg-white">
                                <li class="text-muted">
                                    <i class="fa-solid fa-envelope"></i>
                                    <span class="text-truncate"><small>{{ $user->email }}</small></span>
                                </li>
                                <li class="text-muted">
                                    <i class="fa-solid fa-building"></i>
                                    <span class="text-truncate"><small>{{ App\Models\Designation::getDesignationById($user->designation_id) }}</small></span>
                                </li>
                                <li class="text-muted">
                                    <i class="fa-solid fa-universal-access"></i>
                                    <span class="text-truncate"><small>{{ App\Models\Accesslevel::getAccesslevelById($user->accesslevel_id) }}</small></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-5 col-xl-8">
                    <form class="mt-2 mt-md-0" action="">
                        <div class="card border-0 bg-white shadow-lg">
                            <div class="card-body bg-white">
                                Hello
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop


@section("javascript")

    {{-- javascript js --}}
    <script type="text/javascript" src="{{ asset("s") }}"></script>

@stop
