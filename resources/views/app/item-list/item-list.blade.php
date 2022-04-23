





@extends(
    "layout.app-main", 
    [
        "accesslevelid" => $LoggedUserInfo["accesslevel_id"], // para sa sidebar
        "username"      => $LoggedUserInfo["username"]        // para sa topbar
    ]
)

@section("title", "AMS | requisitioner")

@section("dependencies")

    {{-- datatable css --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    
@stop

@section("content")
    <div class="d-block py-5">
        <div class="container py-2 rounded-2 shadow-lg">
            <table id="users__user-table" class="table table-striped w-100">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">{{ __("Item No") }}</th>
                        <th class="text-center" scope="col">{{ __("Item Name") }}</th>
                        <th class="text-center" scope="col">{{ __("Item Description") }}</th>
                        <th class="text-center" scope="col">{{ __("Action") }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(App\Models\ItemList::getAllItems() as $item)
                        <tr>
                            <td data-order="{{ $item["itemlist_id"] }}" style="vertical-align: middle !important;">{{ __($item["itemname"]) }}</td>
                            <td style="vertical-align: middle !important;">{{ __($item["itemdescription"]) }}</td>
                            <td style="vertical-align: middle !important;">{{ __("FOOC") }}</td>
                            
                            @if(strcmp($LoggedUserInfo["accesslevel_id"], "14") === 0)
                                <td class="text-center" style="vertical-align: middle !important;">
                                    <div class="dropdown">
                                        <button id="action-user-{{ $item["itemlist_id"] }}" class="btn btn-sm btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            __("action")
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="action-user-{{ $item["itemlist_id"] }}">
                                            <li><a class="dropdown-item" href="#" onclick="javascript: item_list__updateItem("{{ $item["itemlist_id"] }}", "2")">{{ __("edit") }}</a></li>
                                            <li><a class="dropdown-item" href="#" onclick="javascript: item_list__deleteItem("{{ $item["itemlist_id"] }}", "3")">{{ __("delete") }}</a></li>
                                        </ul>
                                    </div>
                                </td>
                            @endif

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section("javascript")

    {{-- datatable js --}}
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(() => {
            $("#users__user-table").DataTable();
        });
    </script>

@stop

