

<div class="col-12 my-1 p-0">
    <span class="d-inline p-0" style="font-size: .6em;" role="text">
        {{ Auth::user()->lastname . "," . Auth::user()->firstname . " " . Auth::user()->middleinitial}}
    </span>
    <span class="d-block bg-primary text-white small p-2 rounded-3 shadow-sm\" style="font-size:.8em;" role="text">
        {{ $comment }}
    </span>
    <span class="d-inline small float-end" style="font-size:.5em;" role="text">{{ $created_at }}</span>
</div>
