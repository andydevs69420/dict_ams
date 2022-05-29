@extends("layout.app-main")

@section("title", "AMS | Approved Forms")

@section("dependencies")

    {{-- purchase request list css  --}}
    <link rel="stylesheet" href="{{ asset("css/purchase-request/purchase-request-list/purchase-request-list.css") }}">

    {{-- datatable css --}}
    <link rel="stylesheet" href="{{ asset("extra/dataTable/dataTable-bs5-1.11.5.min.css") }}">

    {{-- supply officer css --}}
    <link rel="stylesheet" href="{{ asset("css/supplyofficer/so-forms.css") }}">

@stop

@section("content")
    <div class="d-block py-3 mb-5">

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <span class="purchase-request-list__purchase-request-list-header-label d-block px-0 py-3 text-muted" role="text">{{ __("Approved Forms") }}</span>
                </div>
            </div>
        </div>
        
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="container py-2 rounded-2 shadow-lg">
                        <table id="purchase-request-list__purchase-request-list-table" class="table table-striped w-100">
                            <thead>
                                <tr>
                                    <th class="text-left" scope="col">{{ __("Form ID") }}</th>
                                    <th class="text-left" scope="col">{{ __("Form Type") }}</th>
                                    <th class="text-left" scope="col">{{ __("Date Requested") }}</th>
                                    <th class="text-left" scope="col">{{ __("Requesitioner") }}</th>
                                    <th class="text-center" scope="col">{{ __("Action") }}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach(App\Models\Form::getAllApprovedForms() as $form)

                                    {{-- <tr>
                                        <td data-order="{{ $form->createdat }}" style="vertical-align: middle !important;">{{ $form->createdat }}</td>
                                            <td style="vertical-align: middle !important;">{{ $form->prnumber }}</td>
                                            <td style="vertical-align: middle !important;">{{ $form->sainumber }}</td>
                                            <td style="vertical-align: middle !important;">{{ $form->purpose }}</td>
                                            <td class="text-center" style="vertical-align: middle !important;">
                                                <a class="btn btn-sm btn-primary shadow" href="{{ url("/purchaserequest/viewprforminfo?prform=".Illuminate\Support\Facades\Crypt::encrypt($form->form_id)) }}">{{ __("View") }}</a>
                                            </td>
                                        </tr>
                                    --}}
                                    <tr>
                                        <td id="form-id" style="vertical-align: middle !important;">{{ $form["form_id"] }}</td>
                                        <td id="pr-id" style="vertical-align: middle !important;"> @if($form["formtype_id"] === 1) {{ "Purchase Request" }} @elseif($form["formtype_id"] === 2) {{ "Job Order" }} @endif</td>
                                        <td style="vertical-align: middle !important;">{{ $form["createdat"] }}</td>
                                        <td style="vertical-align: middle !important;">Loading..</td>
                                        <td class="text-center" style="vertical-align: middle !important;">
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">{{ __("action") }}</button>
                                                <ul class="dropdown-menu" aria-labelledby="">
                                                    <li><span class="dropdown-item" role="text"  onclick='javascript:view_form("{{ $form["form_id"] }}")'>{{ __("View") }}</a></li>
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

    {{-- external datatable ref. --}}
    <script type="text/javascript" src="{{ asset("js/purchase-request/purchase-request-list.js") }}"></script>

    {{-- so-forms js --}}
    <script type="text/javascript" src="{{ asset("js/supplyofficer/so-forms.js") }}"></script>


@stop




