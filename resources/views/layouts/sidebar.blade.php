<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item {{ (isset($elementActive) && $elementActive == 'news') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('news.admin-index') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">News</span>
            </a>
        </li>

        <li class="nav-item {{ (isset($elementActive) && $elementActive == 'events') ? 'active' : '' }} }}">
            <a class="nav-link" href="{{ route('events.index') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Events</span>
            </a>
        </li>

        <li class="nav-item {{ isset($elementActive) && $elementActive == 'department-types' ? 'active': '' }}">
            <a class="nav-link" href="{{ route('department-types.index') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Department Types</span>
            </a>
        </li>

        <li class="nav-item {{ isset($elementActive) && $elementActive == 'departments' ? 'active': '' }}">
            <a class="nav-link" href="{{ route('departments.index') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Departments</span>
            </a>
        </li>

        <li class="nav-item {{ (isset($elementActive) && Str::startsWith($elementActive, 'profile')) ? 'active' : '' }}">
            <a class="nav-link" data-bs-toggle="collapse" href="#profile" aria-expanded="false"
                aria-controls="ui-basic">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Profile</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ (isset($elementActive) && Str::startsWith($elementActive, 'profile')) ? 'show' : '' }}" id="profile">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item "> <a class="nav-link {{ $elementActive == 'profile.show' ? 'active' : '' }}" href="{{ route('profile.show') }}">View</a></li>
                    <li class="nav-item"> <a class="nav-link {{ $elementActive == 'profile.edit' ? 'active' : '' }}" href="{{ route('profile.edit') }}" href="#">Edit</a></li>
                    {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('user.profileview') }}">View</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('user.profileedit') }}">Edit</a></li> --}}
                    <li class="nav-item"> <a class="nav-link" href="#">Typography</a></li>
                </ul>
            </div>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#conversation" aria-expanded="false"
                aria-controls="conversation">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">C</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="conversation">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="#">Conversations</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('user.chats') }}">Conversations</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('user.profileedit') }}">Edit</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Typography</a></li>
                </ul>
            </div>
        </li> --}}
    </ul>
</nav>
<!-- partial -->
