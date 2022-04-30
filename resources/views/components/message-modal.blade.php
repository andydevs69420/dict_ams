<div id="{{ $getID() }}" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="{{ $getID() }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $getID() }}-title">{{ $getTitle() }}</h5>
                <button type="button" class="btn-close rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span id="{{ $getID() }}-message" role="text">{{ $getMessage() }}</span>
            </div>
            <div class="modal-footer">
                <div class="shadow">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>