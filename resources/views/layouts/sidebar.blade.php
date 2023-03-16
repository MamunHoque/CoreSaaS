<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{route('dashboard')}}">
            <span class="align-middle">{{ config('app.name', 'Laravel') }}</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                ORGANIZATION
            </li>
            <li class="sidebar-item active">
                <a class="sidebar-link" >
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Personal</span>
                </a>
            </li>

            <li class="sidebar-item active">
                <a class="sidebar-link" href="index.html">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('permissions.index')}}">
                    <i class="align-middle" data-feather="square"></i> <span class="align-middle">Users</span>
                </a>
            </li>

            <li class="sidebar-header">
                Settings
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('permissions.index')}}">
                    <i class="align-middle" data-feather="square"></i> <span class="align-middle">Roles</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('permissions.index')}}">
                    <i class="align-middle" data-feather="square"></i> <span class="align-middle">Permissions</span>
                </a>
            </li>

        </ul>
    </div>
</nav>
