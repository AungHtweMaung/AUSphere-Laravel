<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item {{ (isset($elementActive) && $elementActive == 'news') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('news.index') }}">
                {{-- <i class="icon-grid menu-icon"></i> --}}
                <i class="fa-regular fa-newspaper fa-2x menu-icon"></i>
                <span class="menu-title">News</span>
            </a>
        </li>

        <li class="nav-item {{ (isset($elementActive) && $elementActive == 'events') ? 'active' : '' }} }}">
            <a class="nav-link" href="{{ route('events.index') }}">
                <i class="fa-regular fa-calendar menu-icon"></i>
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
                <i class="fa-regular fa-building menu-icon"></i>
                <span class="menu-title">Departments</span>
            </a>
        </li>

        <li class="nav-item {{ isset($elementActive) && $elementActive == 'profiles' ? 'active': '' }}">
            <a class="nav-link" href="{{ route('profiles.show', auth()->user()->id) }}">
                <i class="fa-regular fa-user menu-icon"></i>
                <span class="menu-title">Profile</span>
            </a>
        </li>

        {{-- <li class="nav-item {{ (isset($elementActive) && Str::startsWith($elementActive, 'campus-information')) ? 'active' : '' }}">
            <a class="nav-link" data-bs-toggle="collapse" href="#campus-information" aria-expanded="false"
                aria-controls="ui-basic">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Campus Information</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ (isset($elementActive) && Str::startsWith($elementActive, 'campus-information')) ? 'show' : '' }}" id="campus-information">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item "> <a class="nav-link {{ $elementActive == 'campus-information.show' ? 'active' : '' }}" href="{{ route('campus-information.show') }}">View</a></li>
                    <li class="nav-item"> <a class="nav-link {{ $elementActive == 'campus-information.edit' ? 'active' : '' }}" href="{{ route('campus-information.edit') }}" href="#">Edit</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('user.profileview') }}">View</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('user.profileedit') }}">Edit</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Typography</a></li>
                </ul>
            </div>
        </li> --}}
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
