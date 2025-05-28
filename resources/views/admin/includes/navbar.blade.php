<nav class="navbar navbar-header navbar-expand-lg">
    <div class="container-fluid">

        <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
            <!-- Profil -->
            <li class="nav-item dropdown">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#">

                    <span>{{ auth()->user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#"><i class="ti-settings"></i> View Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="ti-settings"></i> Logout
                    </a>

                    <form id="logout-form" method="POST" action="{{ route('admin.delete.logout') }}"
                        style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>

                </ul>
            </li>
        </ul>
    </div>
</nav>
