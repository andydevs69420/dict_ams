@extends('layout.app-main')

@section('title', 'AMS | Job Order Status')

@section('dependencies')
{{-- Budget officer css --}}
    <link rel="stylesheet" href="{{ asset('css/Budgetofficer/Budgetoffice.css') }}">
{{-- datatable css --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
@stop

@section('content')
<div class="d-block w-100 h-100">
        <div class="container-fluid">
            <span class="dashboard__dashboard-header-label d-block px-0 py-3 text-muted" role="text">{{ __('Job Order Status') }}</span>    
        </div>

        <div class="d-block py-5">
            <div class="container py-2 rounded-2 shadow-lg">
                <table id="item-list__item-list-table" class="table table-striped w-100" data-order='[[ 0, "asc" ]]'>
                    <thead>
                        <tr>
                            <th class="text-left" scope="col">{{ __("Request date") }}</th>
                            <th class="text-left" scope="col">{{ __("Jo number") }}</th>
                            <th class="text-left" scope="col">{{ __("Sai number") }}</th>
                            <th class="text-left" scope="col">{{ __("Purpose") }}</th>
                            <th class="text-left" scope="col">{{ __("Actions") }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(\App\Models\FormRequiredPersonel::getFormByUserAndFormType(Auth::user()->user_id, 2) as $form)
                            <tr>
                                <td class="vertical-align: middle !important;">{{ $form->createdat }}</td>
                                <td class="vertical-align: middle !important;">{{ $form->prnumber }}</td>
                                <td class="vertical-align: middle !important;">{{ $form->sainumber }}</td>
                                <td class="vertical-align: middle !important;">{{ $form->purpose }}</td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-primary shadow" href="{{ url("/budgetofficer/editjoborder/" . \Illuminate\Support\Facades\Crypt::encrypt($form->form_id) . "/review") }}">{{ __("View") }}</a>
                                </td>
                            </tr>
                        @endforeach    
                    </tbody>
                </table>
            </div>
        </div>
</div>
@stop