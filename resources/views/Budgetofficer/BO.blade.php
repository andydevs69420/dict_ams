@extends("layout.app-main")

@section('title', 'AMS | Purchase Request Status')

@section('dependencies')
{{-- users css --}}
    <link rel="stylesheet" href="{{ asset("css/users/users.css") }}">
    {{-- datatable css --}}
    <link rel="stylesheet" href="{{ asset("extra/dataTable/dataTable-bs5-1.11.5.min.css") }}">
@stop

@section('content')

<div class="d-block py-3">
	<div class="container">
		<div class="row">
			<div class="col-12">
                <span class="users__users-header-label d-block px-0 py-3 text-muted" role="text">{{ __("Purchase Request Status") }}</span>
            </div>

			<div class="col-12">
                <div class="users__table-wrapper container py-2 rounded-2 shadow-lg">
					<table id="users__user-table" class="table table-striped w-100">
						<thead>
                            <tr>
                            <th class="text-left" scope="col">{{ __("PR number") }}</th>
                            <th class="text-left" scope="col">{{ __("Stock No.") }}</th>
                            <th class="text-left" scope="col">{{ __("Unit") }}</th>
                            <th class="text-left" scope="col">{{ __("Description") }}</th>
                            <th class="text-left" scope="col">{{ __("Quantity") }}</th>
                            <th class="text-left" scope="col">{{ __("Unit cost") }}</th>
                            <th class="text-left" scope="col">{{ __("Total cost") }}</th>
                            <th class="text-left" scope="col">{{ __("Status") }}</th>
                            <th class="text-left" scope="col">{{ __("Actions") }}</th>
                            </tr>
                    				</thead>
						<tbody>
                        @foreach($form as $Form_id)
                                <tr>
                                    <td>{{ $Form_id}}</td>                                       
                                    <td class="align-right">
                                        <a href="{{ url('Budgetofficer/edit-purchaserequest/'.$Form_id) }}" class="ui circular basic icon button tiny"><i class="icon edit outline"></i></a>
                                        <a href="{{ url('Budgetofficer/delete/'.$Form_id) }}" class="ui circular basic icon button tiny"><i class="icon trash alternate outline"></i></a>
                                        <a href="{{ url('Budgetofficer/download/'.$Form_id) }}" class="ui circular basic icon button tiny"><i class="icon download alternate outline"></i></a>

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

    {{-- message modal js --}}
    <script type="text/javascript" src="{{ asset("js/components/message-modal/message-modal.js") }}"></script>

    {{-- users js --}}
    <script type="text/javascript" src="{{ asset("js/users/users.js") }}"></script>
    
@stop
