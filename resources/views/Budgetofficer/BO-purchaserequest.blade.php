@extends("layout.app-main")

@section('title', 'AMS | Purchase Request Status')

@section('dependencies')

   
    {{-- datatable css --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

    {{-- Budget officer css --}}
    <link rel="stylesheet" href="{{ asset('css/Budgetofficer/pr-status-list/pr-status-list.css') }}">

    {{-- Budget officer css --}}
    <link rel="stylesheet" href="{{ asset('css/Budgetofficer/Budgetoffice.css') }}">



@stop

@section('content')
    <div class="d-block py-3">

        <div class="container">
            <span class="budget-officer__pr-status-header-label d-block px-0 py-3 text-muted" role="text">{{ __('Purchase Request Status') }}</span>    
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="container py-2 rounded-2 shadow-lg overflow-hidden">
                        <table id="pr-list__pr-list-table" class="table table-striped w-100" data-order='[[ 0, "asc" ]]'>
                            <thead>
                                    <tr>
                                    <th class="text-left" scope="col">{{ __("Request date") }}</th>
                                    <th class="text-left" scope="col">{{ __("Pr number") }}</th>
                                    <th class="text-left" scope="col">{{ __("Sai number") }}</th>
                                    <th class="text-left" scope="col">{{ __("Purpose") }}</th>
                                    <th class="text-left" scope="col">{{ __("Actions") }}</th>
                                    </tr>
                            </thead>
                            <tbody>
                                @foreach(\App\Models\FormRequiredPersonel::getFormByUserAndFormType(Auth::user()->user_id, 1) as $form)
                                    <tr>
                                        <td class="vertical-align: middle !important;">{{ $form->createdat }}</td>
                                        <td class="vertical-align: middle !important;">{{ $form->prnumber }}</td>
                                        <td class="vertical-align: middle !important;">{{ $form->sainumber }}</td>
                                        <td class="vertical-align: middle !important;">{{ $form->purpose }}</td>
                                        <td class="text-center">

                                            <a class="btn btn-sm btn-primary shadow">{{ __("View") }}</a>

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

    <script>
        $("#pr-list__pr-list-table").dataTable({
            responsive : true
        });
    </script>

@stop