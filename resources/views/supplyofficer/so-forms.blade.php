@extends("layout.app-main")

@section("title", "AMS | approved forms")

@section("dependencies")

    {{-- supply officer css --}}
    <link rel="stylesheet" href="{{ asset("css/supplyofficer/so-forms.css") }}">

@stop

@section("content")
    <div class="d-block py-2">
        
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
                        <th class="text-left" scope="col">{{ __("Requisitioner") }}</th>
                        <th class="text-left" scope="col">{{ __("Date Approved") }}</th>
                        <th class="text-center" scope="col">{{ __("Action") }}</th>
                    </tr>
                </thead>
                <tbody>
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
                    <tr>
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
                    </tr>  
                </tbody>
            </table>
        </div>

        <div class="mx-auto mt-5 py-2 w-50">
            <div class="card border-0 shadow-lg">
                <div class="card-header py-2 border-0 bg-white">
                    <span class="text-black fw-bolder" role="text">{{ __("UPLOAD FILES") }}</span>
                </div>
                <div class="card-body">
                    <div id="file-content-id" class="d-block"></div>
                    <input id="file-pick-id" class="d-none" type="file" name="file[]" accept="image/.jpeg,.png,.pdf" multiple>
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

    </div>
@stop

@section("javascript")
    <script>
        function generate__pqs_form(){
            return window.open('/so_approvedforms/generatepqs');
        }
    </script>
@stop







