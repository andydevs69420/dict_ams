
<div class="col-12 my-1 p-0">
    <div class="d-flex flex-row flex-nowrap align-items-center my-1">
        <div class="d-flex align-items-center justify-content-center overflow-hidden rounded-circle shadow-sm">
            <img class="img-fluid" src="{{ asset(App\Models\UserProfileImages::getProfileImagePathByUserId($user_id)) }}" alt="avatar" style="width: 30px; height: auto;">
        </div>
        <a class="d-inline ms-1 p-0" style="font-size: .6em; text-decoration: none" href="{{ url("/user/userprofile?user=" . Illuminate\Support\Facades\Crypt::encrypt(Auth::user()->user_id)) }}" role="text">
            {{ $lastname . ", " . $firstname . " " . $middleinitial }}
        </a>
    </div>
    <span class="d-block bg-primary text-white small p-2 rounded-3 shadow-sm" style="font-size:.8em; white-space: pre-wrap; text-align: left;" role="text">
        {{ $comment }}
    </span>
    <span class="d-inline small float-end" style="font-size:.5em;" role="text">{{ $created_at }}</span>
</div>
