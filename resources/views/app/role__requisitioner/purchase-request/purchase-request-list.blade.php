@extends("layout.app-main")

@section("title", "AMS | PR List")

@section("dependencies")

    {{-- datatable css --}}
    <link rel="stylesheet" href="{{ asset("extra/dataTable/dataTable-bs5-1.11.5.min.css") }}">

    {{-- purchase request list css  --}}
    <link rel="stylesheet" href="{{ asset("css/app/role__requisitioner/purchase-request/purchase-request-list/purchase-request-list.css") }}">

@stop

@section("content")
    <div class="d-block py-3">

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <span class="purchase-request-list__purchase-request-list-header-label d-block px-0 py-3 text-muted" role="text">{{ __("Purchase Request List") }}</span>
                </div>
            </div>
        </div>
        
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="container py-4 rounded-2 shadow-lg overflow-hidden">
                        <table id="purchase-request-list__purchase-request-list-table" class="table table-striped w-100">
                            <thead>
                                <tr>
                                    <th class="text-left"   scope="col">{{ __("Request date") }}</th>
                                    <th class="text-left"   scope="col">{{ __("Pr number") }}</th>
                                    <th class="text-left"   scope="col">{{ __("Sai number") }}</th>
                                    <th class="text-left"   scope="col">{{ __("Purpose") }}</th>
                                    <th class="text-center" scope="col">{{ __("Status") }}</th>
                                    <th class="text-center" scope="col">{{ __("Action") }}</th>
                                </tr>
                            </thead>
                            <tbody>

                                {{-- 
                                        getFormByUser(userid);
                                --}}
                                @foreach(\App\Models\FormRequiredPersonel::getFormByUserAndFormType(Auth::user()->user_id, 1) as $form)

                                    <tr>
                                        <td data-order="[{{ $form->personelstatus_id }}, {{ $form->createdat }}]" style="vertical-align: middle !important;">{{ $form->createdat }}</td>
                                        <td style="vertical-align: middle !important;">{{ $form->prnumber?  $form->prnumber  : "TBD" }}</td>
                                        <td style="vertical-align: middle !important;">{{ $form->sainumber? $form->sainumber : "TBD" }}</td>
                                        <td style="vertical-align: middle !important;">{{ $form->purpose }}</td>
                                        <td class="text-center" style="vertical-align: middle !important;">

                                            <x-signiture-status class="w-75"
                                                :personelstatusid="$form->personelstatus_id"
                                                :personelstatus="$form->personelstatus"></x-signiture-status>

                                        </td>
                                        <td class="text-center" style="vertical-align: middle !important;">
                                            <a class="btn btn-sm btn-primary shadow" href="{{ url("/requisitioner/purchaserequest/viewprforminfo/" . Illuminate\Support\Facades\Crypt::encrypt($form->form_id) . "/view") }}">{{ __("View") }}</a>
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

    {{-- purchase request list js --}}
    <script type="text/javascript" src="{{ asset("js/app/role__requisitioner/purchase-request/purchase-request-list.js") }}"></script>

@stop




