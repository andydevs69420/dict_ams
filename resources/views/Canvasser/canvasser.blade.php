@extends("layout.app-main")

@section('title', 'AMS | Canvasser Price Quotation')

@section('dependencies')
{{-- Budget officer css --}}
    <link rel="stylesheet" href="{{ asset('css/Budgetofficer/Budgetoffice.css') }}">
{{-- datatable css --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
@stop

@section('content')
    <div class="d-block w-100 h-100">
        <div class="container-fluid">
            <span class="dashboard__dashboard-header-label d-block px-0 py-3 text-muted" role="text">{{ __('Price Quotation Request') }}</span>    
        </div>

        <div class="d-block py-5">
            <div class="container py-2 rounded-2 shadow-lg">
                <table id="item-list__item-list-table" class="table table-striped w-100" data-order='[[ 0, "asc" ]]'>
                    <thead>
                        <tr>
                            <th class="text-left" scope="col">{{ __("PQS Number") }}</th>
                            <th class="text-left" scope="col">{{ __("BAC Chairman") }}</th>
                            <th class="text-left" scope="col">{{ __("Date Generated") }}</th>
                            <th class="text-center" scope="col">{{ __("Action") }}</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach($form as $Form_id)
                                <tr>
                                    <td>{{ $Form_id}}</td>                                   
                                    <td class="align-right">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">{{ __("Status") }}</button>
                                            <ul class="dropdown-menu" aria-labelledby="">
                                                <li><a class="dropdown-item" href="#">{{ __("View") }}</a></li>
                                                <li><a class="dropdown-item" href="#">{{ __("Approve") }}</a></li>
                                                <li><a class="dropdown-item" href="#">{{ __("Decline") }}</a></li>
                                                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">{{ __("Send") }}</button>                               
                                            </ul>
                                        </div>
                                        <!-- @isset($data->comment)
                                            @if($data->comment != null)
                                                <button class="ui circular basic icon button tiny uppercase" data-tooltip='{{ $data->comment }}' data-variation='wide' data-position='top right'><i class="ui icon comment alternate"></i></button>
                                            @endif
                                        @endisset -->
                                    </td>
                                </tr>
                            @endforeach    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop