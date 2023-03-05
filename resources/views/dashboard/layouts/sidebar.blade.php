<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center mt-5 mb-5" href="#">
        <!-- <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div> -->
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <div id="collapseOperationalMenus" class="collapse {{request()->route()->getPrefix()=='dashboard/users/operationals' ? 'show' : ''}}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{Route::currentRouteName()=='dashboard.user.create' ? 'active' : ''}}" href="{{route('dashboard.operational.index')}}">
                    <i class="fas fa-fw fa-user-plus"></i>
                    <span>Index</span>
                </a>
            </div>
        </div>
    </li>

    @can('view settings menus')
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSettings" aria-expanded="true" aria-controls="collapseSettings">
            <i class="fas fa-fw fa-cog"></i>
            <span>Users</span>
        </a>
        <div id="collapseSettings" class="collapse {{request()->route()->getPrefix()=='dashboard/users' || request()->route()->getPrefix()=='dashboard/users/roles' || request()->route()->getPrefix()=='dashboard/users/permissions' ? 'show' : ''}}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{Route::currentRouteName()=='dashboard.user.create' ? 'active' : ''}}" href="{{route('dashboard.user.create')}}">
                    <i class="fas fa-fw fa-user-plus"></i>
                    <span>Create User</span>
                </a>
                @can('view users')
                <a class="collapse-item {{Route::currentRouteName()=='dashboard.user.index' ? 'active' : ''}}" href="{{route('dashboard.user.index')}}">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Users</span>
                </a>
                @endcan
            </div>
        </div>
    </li>
    @endcan

    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>

<!-- //start js section -->

<!-- //end js section -->