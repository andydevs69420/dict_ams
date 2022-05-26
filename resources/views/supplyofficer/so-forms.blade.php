@extends("layout.app-main")

@section("title", "AMS | approved forms")

@section("dependencies")

    {{-- supply officer css --}}
    <link rel="stylesheet" href="{{ asset("css/supplyofficer/so-forms.css") }}">

    {{-- datatable css --}}
    <link rel="stylesheet" href="{{ asset("https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css") }}">
@stop

@section("content")
    {{-- message modal --}}
    <x-message-modal id="users__message-modal"></x-message-modal>
    <div class="d-block py-3 mx-2">
        <form action="{{ url("/so_approvedforms/uploadpqs") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <span class="so_forms-header-label d-block px-0 py-3 text-muted" role="text">{{ __("Forms") }}</span>
                    </div>
                </div>
            </div>

            <div class="forms_table-wrapper container m-2 py-2 rounded-2 shadow-lg">

                <table id="so-forms-table" class="table table-borderless w-100">
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
                        <tbody>
                            @foreach(App\Models\Form::getAllForms() as $form)
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
                        {{-- @foreach(App\Models\PrForm::getAllPrForms() as $prform)
                            <tr>
                                <td style="vertical-align: middle !important;">{{ $prform["form_id"] }}</td>
                                <td style="vertical-align: middle !important;">{{ Requisitioner }}</td>
                                <td style="vertical-align: middle !important;">{{ Date }}</td>
                                <td class="text-center" style="vertical-align: middle !important;">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">{{ __("action") }}</button>
                                        <ul class="dropdown-menu" aria-labelledby="">
                                            <li><a class="dropdown-item" href="#">{{ __("View") }}</a></li>
                                            <li><span class="dropdown-item" role="text" onclick="javascript:generate__pqs_form()">{{ __("Generate Price Quotation Sheet") }}</span></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>  
                        @endforeach  --}}
                        {{-- temporary --}}
                        {{-- <tr>
                            <td style="vertical-align: middle !important;">2</td>
                            <td style="vertical-align: middle !important;">Monkey D. Luffy</td>
                            <td style="vertical-align: middle !important;">08/08/08</td>
                            <td class="text-center" style="vertical-align: middle !important;">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">{{ __("action") }}</button>
                                    <ul class="dropdown-menu" aria-labelledby="">
                                        <li><a class="dropdown-item" href="#">{{ __("View") }}</a></li>
                                        <li><span class="dropdown-item" role="text" onclick="javascript:generate__pqs_form()">{{ __("Generate Price Quotation Sheet") }}</span></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>   --}}
                    </tbody>
                </table>
            </div>
        </form>
    </div>
@stop

@section("javascript")
    {{-- datatable js --}}
    <script type="text/javascript" src="{{ asset("https://code.jquery.com/jquery-3.5.1.js") }}"></script>
    <script type="text/javascript" src="{{ asset("https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js") }}"></script>

    {{-- message modal js --}}
    <script type="text/javascript" src="{{ asset("js/components/message-modal/message-modal.js") }}"></script>


    <script>

        function view_form(id){

            let form_data = {
                'formid' : id,
            };
            return window.location.href = `/so_approvedforms/viewform?data=${JSON.stringify(form_data)}`;
        }


        $(document).ready(function () {
            $('#so-forms-table').DataTable();
        });

    </script>
@stop













