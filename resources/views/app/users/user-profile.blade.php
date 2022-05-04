@extends("layout.app-main")

@section("title", "AMS | user profile")

@section("dependencies")

    {{-- user profile css --}}
    <link rel="stylesheet" href="{{ asset("css/users/user-profile.css") }}">

@stop



@section("content")
    <div class="d-block py-2">
        <div class="container py-2">
            <div class="row">
                <div class="col-12 col-lg-3">
                    <div class="user-profile__dp-image-wrapper d-block my-4 position-relative shadow">

                    </div>
                </div>
                <div class="col-12">
                    B
                </div>
            </div>
        </div>
    </div>
@stop


@section("javascript")

    {{-- javascript js --}}
    <script type="text/javascript" src="{{ asset("s") }}"></script>

@stop
