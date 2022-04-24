@extends("layout.app-main")

@section("title", "AMS | item list")

@section("dependencies")

    {{-- itemlist --}}
    <link rel="stylesheet" href="{{ asset("css/itemlist/itemlist.css") }}">

    {{-- datatable css --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    
@stop

@section("content")

    @if(strcmp(Auth::user()->accesslevel_id, "14") === 0)

        {{-- add "add new item" feature if admin --}}

        {{-- message modal --}}
        <div id="item-list__message-modal" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Info</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{ Session::get("message") }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- add item modal --}}
        <div id="item-list__add-item-modal" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __("Add New Item") }}</h5>
                        <button type="button" class="btn-close rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        
                        <form id="item-list__new-item-form" method="POST" action="{{ url("/itemlist/additem") }}">

                            @csrf

                            <div class="container-fluid">
                                <div class="row">
                                    {{-- item number group --}}
                                    <div class="col-12">
                                        @error("itemnumber")
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <div class="input-group my-2 shadow">
                                            <a tabindex="0" class="input-group-text text-decoration-none bg-primary text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Item number" data-bs-content="Item number"><i class="fa-solid fa-barcode"></i></a>
                                            <input type="number" class="form-control border-0 bg-white" name="itemnumber" placeholder="{{ __("Item no.") }}" required>
                                        </div>
                                    </div>
                                    {{-- item name group --}}
                                    <div class="col-12">
                                        @error("itemname")
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <div class="input-group my-2 shadow">
                                            <a tabindex="0" class="input-group-text text-decoration-none bg-primary text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Item name" data-bs-content="Item name"><i class="fa-solid fa-tag"></i></a>
                                            <input type="text" class="form-control border-0 bg-white" name="itemname" placeholder="{{ __("Item name") }}" required>
                                        </div>
                                    </div>
                                    {{-- item description group --}}
                                    <div class="col-12">
                                        @error("itemdescription")
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <div class="input-group my-2 shadow">
                                            <a tabindex="0" class="input-group-text text-decoration-none bg-primary text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Item description" data-bs-content="Item short description"><i class="fa-solid fa-newspaper"></i></a>
                                            <input type="text" class="form-control border-0 bg-white" name="itemdescription" placeholder="{{ __("Item description") }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-1">
                            <div class="mx-2 shadow">
                                <button type="submit" form="item-list__new-item-form" class="btn btn-primary">Add Item</button>
                            </div>
                            <div class="mx-2 shadow">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button class="item-list__add-new-item-btn btn btn-primary rounded-circle" data-bs-toggle="modal" data-bs-target="#item-list__add-item-modal">
            <i class="fa-solid fa-plus"></i>
        </button>

    @endif

    <div class="d-block py-5">
        <div class="container py-2 rounded-2 shadow-lg">
            <table id="item-list__item-list-table" class="table table-striped table-bordered w-100">
                <thead>
                    <tr>
                        <th class="text-left" scope="col">{{ __("Item No") }}</th>
                        <th class="text-left" scope="col">{{ __("Item Name") }}</th>
                        <th class="text-left" scope="col">{{ __("Item Description") }}</th>
                        <th class="text-center" scope="col">{{ __("Action") }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(App\Models\ItemList::getAllItems() as $item)
                        <tr>
                            <td data-order="{{ $item["itemlist_id"] }}" style="vertical-align: middle !important;">{{ $item["itemnumber"] }}</td>
                            <td style="vertical-align: middle !important;">{{ $item["itemname"] }}</td>
                            <td style="vertical-align: middle !important;">{{ $item["itemdescription"] }}</td>
                            
                            @if(strcmp(Auth::user()->accesslevel_id, "14") === 0)
                                <td class="text-center" style="vertical-align: middle !important;">
                                    <div class="dropdown">
                                        <button id="action-user-{{ $item["itemlist_id"] }}" class="btn btn-sm btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ __("action") }}
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="action-user-{{ $item["itemlist_id"] }}">
                                            <li><a class="dropdown-item" href="#" onclick='javascript: item_list__updateItem("{{ $item["itemlist_id"] }}", "2")'>{{ __("edit") }}</a></li>
                                            <li><a class="dropdown-item" href="#" onclick='javascript: window.deleteItem("{{ $item["itemlist_id"] }}", "3")'>{{ __("delete") }}</a></li>
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

    {{-- itemlist js --}}
    <script type="text/javascript" src="{{ asset("js/item-list/item-list.js") }}"></script>

    @if(Session::has("message"))
        <script>
            $(document).ready(() => {
                $("#item-list__message-modal").modal("show");
            });
        </script>
    @endif

    {{-- if has message or error on submit validation --}}
    @if($errors->any())
        <script>
            $(document).ready(()=>{
                $("#item-list__add-item-modal").modal("show");
            });
        </script>
    @endif

@stop

