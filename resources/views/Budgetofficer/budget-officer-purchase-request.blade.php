@extends("layout.app-main")

@section("title", "AMS | Purchase Request Status")

@section("dependencies")

    {{-- datatable css --}}
    <link rel="stylesheet" href="{{ asset("extra/dataTable/dataTable-bs5-1.11.5.min.css") }}">

    {{-- PR STATUS css --}}
    <link rel="stylesheet" href="{{ asset("css/budget-officer/purchase-request/pr-status-list/pr-status-list.css") }}">

@stop

@section("content")
    <div class="d-block py-3">

        <div class="container">
            <span class="budget-officer__pr-status-header-label d-block px-0 py-3 text-muted" role="text">{{ __("Requested Purchase Request List") }}</span>    
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="container py-4 rounded-2 shadow-lg overflow-hidden">
                        <table id="pr-list__pr-list-table" class="table table-striped w-100">
                            <thead>
                                <tr>
                                    <th class="text-left" scope="col">{{ __("Request date") }}</th>
                                    <th class="text-left" scope="col">{{ __("Pr number") }}</th>
                                    <th class="text-left" scope="col">{{ __("Sai number") }}</th>
                                    <th class="text-left" scope="col">{{ __("Purpose") }}</th>
                                    <th class="text-left" scope="col">{{ __("Status") }}</th>
                                    <th class="text-left" scope="col">{{ __("Actions") }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(\App\Models\FormRequiredPersonel::getFormByUserAndFormType(Auth::user()->user_id, 1) as $form)
                                    <tr>
                                        <td style="vertical-align: middle !important;">{{ $form->createdat }}</td>
                                        <td style="vertical-align: middle !important;">{{ $form->prnumber }}</td>
                                        <td style="vertical-align: middle !important;">{{ $form->sainumber }}</td>
                                        <td style="vertical-align: middle !important;">{{ $form->purpose }}</td>
                                        <td style="vertical-align: middle !important;">{{ $form->personelstatus }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-sm btn-primary shadow" href="{{ url("/budgetofficer/editpurchaserequest/" . \Illuminate\Support\Facades\Crypt::encrypt($form->form_id) . "/review") }}">{{ __("View") }}</a>
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
    
    {{-- BUDGET OFFICER PURCHASE REQUEST --}}
    <script type="text/javascript" src="{{ asset("js/budget-officer/budget-officer-purchase-request.js") }}"></script>

@stop