@extends("layout.app-main")

@section("title", "AMS | approved forms")

@section("dependencies")

    {{-- supply officer css --}}
    <link rel="stylesheet" href="{{ asset("css/supplyofficer/so-forms.css") }}">
    
    {{-- datatable css --}}
    <link rel="stylesheet" href="{{ asset("extra/dataTable/dataTable-bs5-1.11.5.min.css") }}">
    <link rel="stylesheet" href="{{ asset("css/users/users.css") }}">
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

                <table id="users__user-table" class="table table-borderless w-100">
                    <thead>
                        <tr>
                            <th class="text-left" scope="col">{{ __("Form ID") }}</th>
                            <th class="text-left" scope="col">{{ __("PR/JO ID") }}</th>
                            <th class="text-left" scope="col">{{ __("Date Approved") }}</th>
                            <th class="text-left" scope="col">{{ __("Requesitioner") }}</th>
                            <th class="text-center" scope="col">{{ __("Action") }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tbody>
                            @foreach(App\Models\PrItem::getAllPrForms() as $form)
                                <tr>
                                    <td id="form-id" style="vertical-align: middle !important;">{{ $form["form_id"] }}</td>
                                    <td id="pr-id" style="vertical-align: middle !important;">{{ $form["pritem_id"] }}</td>
                                    <td style="vertical-align: middle !important;">Loading..</td>
                                    <td style="vertical-align: middle !important;">Loading..</td>
                                    <td class="text-center" style="vertical-align: middle !important;">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">{{ __("action") }}</button>
                                            <ul class="dropdown-menu" aria-labelledby="">
                                                <li><span class="dropdown-item" role="text"  onclick="javascript:view_form()">{{ __("View") }}</a></li>
                                                <li><span class="dropdown-item" role="text" onclick="javascript:generate__pqs_form()">{{ __("Generate PQS") }}</span></li>
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

            <div class="mx-auto mt-5 py-2 w-50">
                <div class="card border-0 shadow-lg">
                    <div class="card-header py-2 border-0 bg-white">
                        <span class="text-black fw-bolder" role="text">{{ __("UPLOAD PQS") }}</span>
                    </div>
                    <div class="card-body">
                        <div id="file-content-id" class="d-block mb-4">
                            <input id="form-number-input" name="form-number-input" type="text" placeholder="Form Number" class="form-control bg-light">
                        </div>
                        <input id="file-pick-id" class="d-none" type="file" name="file-upload" accept="image/.jpeg,.png,.pdf" multiple>
                        <button class="new-job-order__upload-files-btn btn w-100 border" for="file-pick-id" type="button" onclick='javascript:$("#file-pick-id").click()'>
                            <i class="fa fa-upload"></i>
                            <span role="text">{{ __("UPLOAD PQS") }}</span>
                        </button>
                    </div>
                    <div class="card-footer py-2 py-lg-3 border-0 bg-white">

                        <div class="shadow">
                            <button id="new-job-order__submit" class="new-job-order__submit-btn btn w-100 text-light" type="submit">
                                <i class="fa fa-paper-plane"></i>
                                <span role="text">{{ __("SEND REQUEST") }}</span>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
@stop

@section("javascript")
    {{-- datatable js --}}
    <script type="text/javascript" src="{{ asset("extra/dataTable/jQuery-dataTable-bs5-1.11.5.min.js") }}"></script>
    <script type="text/javascript" src="{{ asset("extra/dataTable/dataTable-bs5-1.11.5.min.js") }}"></script>

    {{-- message modal js --}}
    <script type="text/javascript" src="{{ asset("js/components/message-modal/message-modal.js") }}"></script>


    <script>
        function generate__pqs_form(){
            id = $('#form-id').text();
            prid = $('#pr-id').text();

            let form_data = {
                'formid' : id,
                'prid' : prid,
            };
            return window.open(`/so_approvedforms/generatepqs?data=${JSON.stringify(form_data)}`);



        }


        function view_form(){
            id = $('#form-id').text();

            let form_data = {
                'formid' : id,
            };
            return window.open(`/so_approvedforms/viewform?data=${JSON.stringify(form_data)}`);
        }
    </script>
@stop













