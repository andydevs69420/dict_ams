@extends("layout.app-main")

@section("title", "AMS | Job Order Status")

@section("dependencies")

    {{-- datatable css --}}
    <link rel="stylesheet" href="{{ asset("extra/dataTable/dataTable-bs5-1.11.5.min.css") }}">

    {{-- JO STATUS css --}}
    <link rel="stylesheet" href="{{ asset("css/app/role__budget-officer/job-order/jo-status-list/jo-status-list.css") }}">

@stop

@section("content")
    <div class="d-block py-3">

        <div class="container">
            <span class="budget-officer__jo-status-header-label d-block px-0 py-3 text-muted" role="text">{{ __("Requested Job Order List") }}</span>    
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="container py-4 rounded-2 shadow-lg overflow-hidden">
                        <table id="jo-list__jo-list-table" class="table table-striped w-100">
                            <thead>
                                <tr>
                                    <th class="text-left"   scope="col">{{ __("Request date") }}</th>
                                    <th class="text-left"   scope="col">{{ __("Pr number") }}</th>
                                    <th class="text-left"   scope="col">{{ __("Sai number") }}</th>
                                    <th class="text-center" scope="col">{{ __("Status") }}</th>
                                    <th class="text-center" scope="col">{{ __("Actions") }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(\App\Models\FormRequiredPersonel::getFormByUserAndFormType(Auth::user()->user_id, 2) as $form)
                                    
                                    {{-- list only those items with requisitioners signiture --}}
                                    @if(!\App\Models\FormRequiredPersonel::isFormHasStatusFor($form->form_id, 1, config("global.VALID_REQUISITIONER")))
                                        @continue
                                    @endif
                                
                                    <tr>
                                        <td data-order="[{{ $form->personelstatus_id }}, {{ $form->createdat }}]" style="vertical-align: middle !important;">{{ $form->createdat }}</td>
                                        <td style="vertical-align: middle !important;">{{ $form->prnumber?  $form->prnumber  : "TBD"  }}</td>
                                        <td style="vertical-align: middle !important;">{{ $form->sainumber? $form->sainumber : "TBD" }}</td>
                                        <td class="text-center" style="vertical-align: middle !important;">
                                                
                                            <x-signiture-status class="w-75"
                                                :personelstatusid="$form->personelstatus_id"
                                                :personelstatus="$form->personelstatus"></x-signiture-status>

                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-sm btn-primary shadow" href="{{ url("/budgetofficer/reviewjoborder/" . \Illuminate\Support\Facades\Crypt::encrypt($form->form_id) . "/review") }}">{{ __("View") }}</a>
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

    {{-- BUDGET OFFICER JOB ORDER --}}
    <script type="text/javascript" src="{{ asset("js/app/role__budget-officer/job-order/requested-job-order-list.js") }}"></script>

@stop