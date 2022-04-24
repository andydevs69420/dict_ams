

<nav class="topbar__topbar navbar navbar-expand-xs navbar-light bg-light shadow px-4">
    <button class="btn btn-light border" data-bs-toggle="collapse" data-bs-target="#sidebar-collapse-id" type="button" name="sidebar-collapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="hstack gap-1">
        <div class="vr"></div>
        <span class="topbar__avatar-identifier text-muted ms-3" role="text">{{ $getUsername() }}</span>
        <img class="topbar__avatar-icon ms-3" src="{{ asset("images/dict-transparent.png") }}" alt="avatar-icon">
        <div class="topbar__dropdown">
            <i class="topbar__dropdown-trigger-icon fa-solid fa-caret-down"></i>
            <ul class="topbar__dropdown-dropper">
                <li class="topbar__dropdown-dropper-item">
                    <a class="text-dark" href="{{ url("/logout") }}"><small><i class="me-2 fa-solid fa-arrow-right-from-bracket"></i> {{ __("logout") }}</small></a>
                </li>
                <li class="topbar__dropdown-dropper-item">
                    <a class="text-dark" href="{{ url("/logout") }}"><small><i class="me-2 fa-solid fa-user-gear"></i> {{ __("account settings") }}</small></a>
                </li>
            </ul>
        </div>
    </div>
</nav>

