

<nav class="topbar__topbar navbar navbar-expand-xs navbar-light bg-light shadow px-4">
    <button class="btn btn-light border" data-bs-toggle="collapse" data-bs-target="#sidebar-collapse-id" type="button" name="sidebar-collapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="topbar__avatar d-flex flex-row flex-nowrap align-items-center py-2">
        <span class="topbar__avatar-identifier text-muted ms-3" role="text">{{ $getUsername() }}</span>
        <img class="topbar__avatar-icon ms-3" src="{{ asset('images/dict-transparent.png') }}" alt="avatar-icon">
    </div>
</nav>

