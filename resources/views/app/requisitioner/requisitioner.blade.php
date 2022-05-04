@extends("layout.app-main")

@section("title", "AMS | requisitioner")

@section("dependencies")

    {{-- requisitioner css --}}
    <link rel="stylesheet" href="{{ asset("css/requisitioner/requisitioner.css") }}">

    {{-- datatable css --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    
@stop

@section("content")
    <div class="d-block py-2">

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <span class="requisitioner__requisitioner-header-label d-block px-0 py-3 text-muted" role="text">{{ __("Requisitioner") }}</span>
                </div>
            </div>
        </div>

        <div class="container py-2 rounded-2 shadow-lg">
            <table id="requisitioner__requisitioner-table" class="table table-striped w-100">
                <thead>
                    <tr>
                        <th class="text-left" scope="col">{{ __("Name") }}</th>
                        <th class="text-left" scope="col">{{ __("Designation") }}</th>
                        <th class="text-left" scope="col">{{ __("Accesslevel") }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(App\Models\UserVerificationDetails::getAllRequisitioner() as $user)
                        <tr>
                            <td data-order="{{ $user["verificationstatus_id"] }}" style="vertical-align: middle !important;">{{ $user["lastname"] .", " . $user["firstname"] . " " .$user["middleinitial"] }}</td>
                            <td style="vertical-align: middle !important;">{{ App\Models\Designation::getDesignationById($user["designation_id"]) }}</td>
                            <td style="vertical-align: middle !important;">{{ App\Models\Accesslevel::getAccesslevelById($user["accesslevel_id"]) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section("javascript")

    {{-- datatable js --}}
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    {{-- requisitioner js --}}
    <script type="text/javascript" src="{{ asset("js/requisitioner/requisitioner.js") }}"></script>

@stop