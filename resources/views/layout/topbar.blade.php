
<nav class="navbar navbar-expand-xxl navbar-light bg-light shadow px-4">
    <button class="btn btn-light border" data-bs-toggle="collapse" data-bs-target="#sidebar-collapse" type="button">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div id="avatar-group" class="d-flex flex-row flex-nowrap align-items-center py-2">
        <span id="avatar-identifier" class="lead text-muted ms-3" style="font-size: .8em;" role="text">{{ $LoggedUserInfo['username'] }}</span>
        <img id="avatar-icon" class="ms-3" src="{{ asset('images/dict-transparent.png') }}" alt="avatar-icon">
    </div>
</nav>
