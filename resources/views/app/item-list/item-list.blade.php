@extends("layout.app-main")

@section("title", "AMS | item list")

@section("dependencies")

    {{-- itemlist --}}
    <link rel="stylesheet" href="{{ asset("css/itemlist/itemlist.css") }}">

    {{-- datatable css --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    
@stop

@section("content")

    {{-- 
        accesslevel table
            14 := ADMIN    
    --}}
    @if(strcmp(Auth::user()->accesslevel_id, "14") === 0)

        {{-- add "add new item" feature if admin --}}

        {{-- message modal --}}
        <x-message-modal id="item-list__message-modal"></x-message-modal>

        {{-- add item modal --}}
        <div id="item-list__add-update-item-modal" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __("Add New Item") }}</h5>
                        <button type="button" class="btn-close rounded-circle" data-bs-dismiss="modal" aria-label="Close" onclick="javascript: window.resetModal()"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                {{-- item number group --}}
                                <div class="col-12">
                                    <div class="input-group my-2 shadow">
                                        <a tabindex="0" class="input-group-text text-decoration-none bg-primary text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Item number" data-bs-content="Item number"><i class="fa-solid fa-barcode"></i></a>
                                        <input type="number" class="form-control border-0 bg-white" name="itemnumber" placeholder="{{ __("Item no.") }}" required>
                                    </div>
                                </div>
                                {{-- item name group --}}
                                <div class="col-12">
                                    <div class="input-group my-2 shadow">
                                        <a tabindex="0" class="input-group-text text-decoration-none bg-primary text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Item name" data-bs-content="Item name"><i class="fa-solid fa-tag"></i></a>
                                        <input type="text" class="form-control border-0 bg-white" name="itemname" placeholder="{{ __("Item name") }}" required>
                                    </div>
                                </div>
                                {{-- item description group --}}
                                <div class="col-12">
                                    <div class="input-group my-2 shadow">
                                        <a tabindex="0" class="input-group-text text-decoration-none bg-primary text-white border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" title="Item description" data-bs-content="Item short description"><i class="fa-solid fa-newspaper"></i></a>
                                        <input type="text" class="form-control border-0 bg-white" name="itemdescription" placeholder="{{ __("Item description") }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-1">
                            <div class="mx-2 shadow">
                                <button type="button" class="btn btn-primary" onclick="javascript: window.addNewItem()">Add Item</button>
                            </div>
                            <div class="mx-2 shadow">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="javascript: window.resetModal()">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button class="item-list__add-new-item-btn btn btn-primary rounded-circle" data-bs-toggle="modal" data-bs-target="#item-list__add-update-item-modal">
            <i class="fa-solid fa-plus"></i>
        </button>

    @endif

    <div class="d-block py-2">

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <span class="requisitioner__requisitioner-header-label d-block px-0 py-3 text-muted" role="text">{{ __("Item List") }}</span>
                </div>
            </div>
        </div>

        <div class="container py-2 rounded-2 shadow-lg">
            <table id="item-list__item-list-table" class="table table-striped w-100">
                <thead>
                    <tr>
                        <th class="text-left" scope="col">{{ __("Item No") }}</th>
                        <th class="text-left" scope="col">{{ __("Item Name") }}</th>
                        <th class="text-left" scope="col">{{ __("Item Description") }}</th>

                        @if(strcmp(Auth::user()->accesslevel_id, "14") === 0)
                            <th class="text-center" scope="col">{{ __("Action") }}</th>
                        @endif
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach(App\Models\ItemList::getAllItems() as $item)

                        <tr id="item-list__row-item-{{ $item["itemlist_id"] }}">
                            <td data-order="{{ $item["itemlist_id"] }}" style="vertical-align: middle !important;">{{ $item["itemnumber"] }}</td>
                            <td style="vertical-align: middle !important;">{{ $item["itemname"] }}</td>
                            <td style="vertical-align: middle !important;">{{ $item["itemdescription"] }}</td>
                            
                            {{-- 
                                accesslevel table
                                    14 := ADMIN    
                            --}}
                            @if(strcmp(Auth::user()->accesslevel_id, "14") === 0)
                                <td class="text-center" style="vertical-align: middle !important;">
                                    <div class="dropdown">
                                        <button id="action-user-{{ $item["itemlist_id"] }}" class="btn btn-sm btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ __("action") }}
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="action-user-{{ $item["itemlist_id"] }}">
                                            <li><a class="dropdown-item" href="#" onclick='javascript: window.updateCandidate( {{ $item }} )'>{{ __("edit") }}</a></li>
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

    {{-- message modal js --}}
    <script type="text/javascript" src="{{ asset("js/components/message-modal/message-modal.js") }}"></script>

    {{-- itemlist js --}}
    <script type="text/javascript" src="{{ asset("js/item-list/item-list.js") }}"></script>
    
@stop

