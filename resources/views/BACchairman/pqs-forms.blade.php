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
                    <span class="so_forms-header-label d-block px-0 py-3 text-muted" role="text">{{ __("Price Quotation Request") }}</span>
                </div>
            </div>
        </div>

        <div class="forms_table-wrapper container m-2 py-2 rounded-2 shadow-lg">

            <table id="users__user-table" class="table table-borderless w-100">
                <thead>
                    <tr>
                        <th class="text-left" scope="col">{{ __("Form Number") }}</th>
                        <th class="text-left" scope="col">{{ __("Requisitioner") }}</th>
                        <th class="text-left" scope="col">{{ __("Date Generated") }}</th>
                        <th class="text-center" scope="col">{{ __("Action") }}</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($form as $Form_id)
                        <tr>
                            <td>{{ $Form_id}}</td>
                            <td style="vertical-align: middle !important;">{{ Requisitioner }}</td>
                            <td style="vertical-align: middle !important;">{{ Date }}</td>
                            <td class="text-center" style="vertical-align: middle !important;">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">{{ __("Status") }}</button>
                                    <ul class="dropdown-menu" aria-labelledby="">
                                        <li><a class="dropdown-item" href="#">{{ __("View") }}</a></li>
                                        <li><a class="dropdown-item" href="#">{{ __("Approve") }}</a></li>
                                        <li><a class="dropdown-item" href="#">{{ __("Decline") }}</a></li>
                                        <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">{{ __("Send") }}</button>                               
                                    </ul>
                                </div>
                            </td>
                        </tr>  
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section("javascript")

@stop









