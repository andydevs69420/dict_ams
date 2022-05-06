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
                        <th class="text-left" scope="col">{{ __("Form Type") }}</th>
                        <th class="text-left" scope="col">{{ __("Requisitioner") }}</th>
                        <th class="text-left" scope="col">{{ __("Date Approved") }}</th>
                        <th class="text-center" scope="col">{{ __("Action") }}</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td style="vertical-align: middle !important;">Purchase Request</td>
                            <td style="vertical-align: middle !important;">Monkey D. Luffy</td>
                            <td style="vertical-align: middle !important;">05/23/2022</td>
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
    </div>
@stop

@section("javascript")
    <script>
        function generate__pqs_form(){
            return window.open('/so_approvedforms/generatepqs');
        }
    </script>
@stop









