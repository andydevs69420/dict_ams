@extends("layout.app-main")

@section('title', 'AMS | Canvasser Price')

@section('dependencies')
{{-- Budget officer css --}}
    <link rel="stylesheet" href="{{ asset('css/Budgetofficer/Budgetoffice.css') }}">
{{-- datatable css --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
@stop

@section('content')
    <div class="d-block w-100 h-100">
        <div class="container-fluid">
            <span class="dashboard__dashboard-header-label d-block px-0 py-3 text-muted" role="text">{{ __('Purchase Request') }}</span>    
        </div>

        <div class="d-block py-5">
            <div class="container py-2 rounded-2 shadow-lg">
                <table id="item-list__item-list-table" class="table table-striped w-100" data-order='[[ 0, "asc" ]]'>
                    <thead>
                            <tr>
                            <th class="text-left" scope="col">{{ __("PQ number") }}</th>
                            <th class="text-left" scope="col">{{ __("Description") }}</th>
                            <th class="text-left" scope="col">{{ __("Quantity") }}</th>
                            <th class="text-left" scope="col">{{ __("Price") }}</th>
                            <th class="text-left" scope="col">{{ __("Actions") }}</th>
                            </tr>
                    </thead>
                    <tbody>
                        @foreach(App\Models\ItemList::getAllItems() as $item)
                                <tr>
                                    <td>{{ $item-> $itemnumber }}</td>                                       
                                    <td class="align-right">
                                    <a href="{{ url('BO/edit/'.$data->id) }}" class="ui circular basic icon button tiny"><i class="icon edit outline"></i></a>
                                    <a href="{{ url('BO/delete/'.$data->id) }}" class="ui circular basic icon button tiny"><i class="icon trash alternate outline"></i></a>
                                    <a href="{{ url('BO/download/'.$data->id) }}" class="ui circular basic icon button tiny"><i class="icon download alternate outline"></i></a>

                                    @isset($data->comment)
                                        @if($data->comment != null)
                                            <button class="ui circular basic icon button tiny uppercase" data-tooltip='{{ $data->comment }}' data-variation='wide' data-position='top right'><i class="ui icon comment alternate"></i></button>
                                        @endif
                                    @endisset
                                    </td>
                                </tr>
                        @endforeach    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop