@extends("layout.app-main")

@section("title", "AMS | users")

@section("dependencies")

    {{-- users css --}}
    <link rel="stylesheet" href="{{ asset("css/users/users.css") }}">

    {{-- datatable css --}}
    <link rel="stylesheet" href="{{ asset("extra/dataTable/dataTable-bs5-1.11.5.min.css") }}">
    
@stop

@section("content")

    {{-- message modal --}}
    <x-message-modal id="users__message-modal"></x-message-modal>

    <div class="d-block py-3">

        <div class="container">

            <div class="row">

                <div class="col-12">
                    <span class="users__users-header-label d-block px-0 py-3 text-muted" role="text">{{ __("Users") }}</span>
                </div>

                <div class="col-12">
                    <div class="users__table-wrapper container py-2 rounded-2 shadow-lg">

                        <table id="users__user-table" class="table table-striped w-100">
                            <thead>
                                <tr>
                                    <th class="text-left" scope="col">{{ __("Name") }}</th>
                                    <th class="text-left" scope="col">{{ __("Designation") }}</th>
                                    <th class="text-left" scope="col">{{ __("Accesslevel") }}</th>
                                    <th class="text-center" scope="col">{{ __("Action") }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(App\Models\UserVerificationDetails::getAllUsers() as $user)
    
                                    <tr id="user-row__user-{{ $user["user_id"] }}">
                                        <td data-order="{{ $user["verificationstatus_id"] }}" style="vertical-align: middle !important;">{{ $user["lastname"] .", " . $user["firstname"] . " " .$user["middleinitial"] }}</td>
                                        <td style="vertical-align: middle !important;">{{ App\Models\Designation::getDesignationById($user["designation_id"]) }}</td>
                                        <td style="vertical-align: middle !important;">{{ App\Models\Accesslevel::getAccesslevelById($user["accesslevel_id"]) }}</td>
                                        <td class="text-center" style="vertical-align: middle !important;">
                                            
                                            <div class="dropdown">
                                                <button id="action-user-{{ $user["user_id"] }}" class="btn btn-sm shadow @if(strcmp($user["verificationstatus_id"], "1") === 0) btn-danger @elseif (strcmp($user["verificationstatus_id"], "2") === 0) btn-primary @else btn-success  @endif dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">{{ __("action") }}</button>
                                                <ul class="dropdown-menu" aria-labelledby="action-user-{{ $user["user_id"] }}">
                                                    @switch($user["verificationstatus_id"])
                                                        @case(1)
                                                            <li><a class="dropdown-item" href="#" onclick='javascript:window.updateUserVerificationStatus("{{ $user["user_id"] }}", "2")'>{{ __("accept") }}</a></li>
                                                            <li><a class="dropdown-item" href="#" onclick='javascript:window.updateUserVerificationStatus("{{ $user["user_id"] }}", "3")'>{{ __("decline") }}</a></li>
                                                            @break
                                                        @case(2)
                                                            <li><a class="dropdown-item" href="{{ url("/user/userprofile?user=" . Illuminate\Support\Facades\Crypt::encrypt($user->user_id)) }}">{{ __("view profile") }}</a></li>
                                                            @break
                                                        @default {{-- 3? declined user --}}
                                                            <li><a class="dropdown-item @if(strcmp($user["user_id"], Auth::user()->user_id) === 0) disabled @endif" href="#" onclick='javascript:window.deleteUser("{{ $user["user_id"] }}")'>{{ __("delete") }}</a></li>
                                                            @break
                                                    @endswitch
                                                </ul>
                                            </div>
                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@stop

@section("javascript")

    {{-- datatable js --}}
    <script type="text/javascript" src="{{ asset("extra/dataTable/jQuery-dataTable-bs5-1.11.5.min.js") }}"></script>
    <script type="text/javascript" src="{{ asset("extra/dataTable/dataTable-bs5-1.11.5.min.js") }}"></script>

    {{-- message modal js --}}
    <script type="text/javascript" src="{{ asset("js/components/message-modal/message-modal.js") }}"></script>

    {{-- users js --}}
    <script type="text/javascript" src="{{ asset("js/users/users.js") }}"></script>
    
@stop









