@extends(
    'layout.app-main', 
    [
        'accesslevelid' => $LoggedUserInfo['accesslevel_id'], // para sa sidebar
        'username'      => $LoggedUserInfo['username']        // para sa topbar
    ]
)

@section('title', 'AMS | Obligation Request')

@section('dependencies')
    <link rel="stylesheet" href="{{ asset('css/Budgetofficer/Budgetoffice.css') }}">
@stop

@section('content')
    <div class = "container-fluid">
        <div class="row">
            <h2 class="page-title">{{ __('Obligation Request/Status') }}</h2>
        </div>

        <div class="row">
            <div class="box box-success">
                <div class="box-body">
                    <table width="100%" class="table table-striped table-hover" id="dataTables-example" data-order='[[ 0, "asc" ]]'>
                        <thead>
                            <tr>
                                <th>{{ __('PR number') }}</th>
                                <th>{{ __('Stock no.') }}</th>
                                <th>{{ __('Unit') }}</th>
                                <th>{{ __('Item description') }}</th>
                                <th>{{ __('Quantity') }}</th>
                                <th>{{ __('Unit cost') }}</th>
                                <th>{{ __('Total cost') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($ORS) //table name
                                @foreach ($ORS as $data)
                                <tr>
                                    <td>{{ $data-> PR_number }}</td>                                       
                                    <td class="align-right">
                                    <a href="{{ url('ORS/edit/'.$data->id) }}" class="ui circular basic icon button tiny"><i class="icon edit outline"></i></a>
                                    <a href="{{ url('ORS/delete/'.$data->id) }}" class="ui circular basic icon button tiny"><i class="icon trash alternate outline"></i></a>
                                    <a href="{{ url('ORS/download/'.$data->id) }}" class="ui circular basic icon button tiny"><i class="icon download alternate outline"></i></a>

                                    @isset($data->comment)
                                        @if($data->comment != null)
                                            <button class="ui circular basic icon button tiny uppercase" data-tooltip='{{ $data->comment }}' data-variation='wide' data-position='top right'><i class="ui icon comment alternate"></i></button>
                                        @endif
                                    @endisset
                                    </td>
                                </tr>
                                @endforeach
                            @endisset        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop