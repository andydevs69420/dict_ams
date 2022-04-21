





@extends(
    'layout.app-main', 
    [
        'accesslevelid' => $LoggedUserInfo['accesslevel_id'], // para sa sidebar
        'username'      => $LoggedUserInfo['username']        // para sa topbar
    ]
)

@section('title', 'AMS | requisitioner')

@section('dependencies')

    {{-- users css --}}
    <link rel="stylesheet" href="{{ asset('css/components/global/pr-and-jo/pr-and-jo.css') }}">

    {{-- datatable css --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    
@stop

@section('content')
    <div class="d-block py-5">
        <div class="container py-2 rounded-2 shadow-lg">
            <table id="users__user-table" class="table table-striped w-100">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">Name</th>
                        <th class="text-center" scope="col">Designation</th>
                        <th class="text-center" scope="col">Accesslevel</th>
                    </tr>
                </thead>
                <tbody style="max-height: 400px !important; overflow-y: auto !important;">
                    @foreach(App\Models\UserVerificationDetails::getAllRequisitioner() as $user)
                        <tr>
                            <td data-order="{{ $user['verificationstatus_id'] }}" style="vertical-align: middle !important;">{{ $user['lastname'] .', ' . $user['firstname'] . ' ' .$user['middleinitial'] }}</td>
                            <td style="vertical-align: middle !important;">{{ App\Models\Designation::getDesignationById($user['designation_id']) }}</td>
                            <td style="vertical-align: middle !important;">{{ App\Models\Accesslevel::getAccesslevelById($user['accesslevel_id']) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript')

    {{-- users js --}}
    <script type="text/javascript" src="{{ asset('js/users/users.js') }}"></script>

    {{-- datatable js --}}
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(() => {
            $('#users__user-table').DataTable();
        });
    </script>
@stop

