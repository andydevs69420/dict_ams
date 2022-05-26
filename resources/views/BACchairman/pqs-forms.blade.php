@extends("layout.app-main")

@section("title", "AMS | BAC Chairman")

@section("dependencies")
    {{-- users css --}}
    <link rel="stylesheet" href="{{ asset("css/users/users.css") }}">

    {{-- datatable css --}}
    <link rel="stylesheet" href="{{ asset("extra/dataTable/dataTable-bs5-1.11.5.min.css") }}">
@stop

@section("content")
<div class="d-block py-3">
	<div class="container">
		<div class="row">
			    <div class="col-12">
                    <span class="users__users-header-label d-block px-0 py-3 text-muted" role="text">{{ __("Price Quotation Sheets") }}</span>
                </div>

			<div class="col-12">
                    <div class="users__table-wrapper container py-2 rounded-2 shadow-lg">
					    <table id="users__user-table" class="table table-striped w-100">
						<thead>
                            <tr>
                                <th class="text-left" scope="col">{{ __("Form Number") }}</th>
                                <th class="text-left" scope="col">{{ __("Requisitioner") }}</th>
                                <th class="text-left" scope="col">{{ __("Date Generated") }}</th>
                                <th class="text-center" scope="col">{{ __("Status") }}</th>
                                <th class="text-center" scope="col">{{ __("Action") }}</th>
                            </tr>
                    	</thead>
						</tbody>
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










