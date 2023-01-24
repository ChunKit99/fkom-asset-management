<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
            <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{ url('/Admin/Main') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                <div class="sb-sidenav-menu-heading">Interface</div>
                <!-- User Management -->
                <a class="nav-link collapsed" href="{{ url('Admin/Main')}}" data-bs-toggle="collapse" data-bs-target="#collapseLayouts1"
                    aria-expanded="false" aria-controls="collapseLayouts1">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    User Management
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts1" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <!-- side nav component -->
                        <a class="nav-link" href="{{ url('Admin/ManageUserAccount')}}">User Account</a>
                        <a class="nav-link" href="{{ url('Admin/ManageUserDetail')}}">User Details</a>
                    </nav>
                </div>
                <!-- Asset Management -->
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts2"
                    aria-expanded="false" aria-controls="collapseLayouts2">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Asset Management
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <!-- side nav component -->
                        <a class="nav-link" href="{{ url('/Asset') }}">All Asset</a>
                        <a class="nav-link" href="{{ url('/Asset/create') }}">New Asset</a>
                    </nav>
                </div>
                <!-- Budget Management -->
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts3"
                    aria-expanded="false" aria-controls="collapseLayouts3">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Budget Management
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts3" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <!-- side nav component -->
                        <a class="nav-link" href="{{ url('/Budget') }}">All Budget</a>
                        <a class="nav-link" href="{{ url('/BudgetManagement/listBudget') }}">Request Budget List</a>
                    </nav>
                </div>
                <!-- Maintenance -->
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts4"
                    aria-expanded="false" aria-controls="collapseLayouts4">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Maintenance Management
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts4" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <!-- side nav component -->
                        <a class="nav-link" href="{{ url('/MaintenanceManagement') }}">All Maintenance</a>
                        <a class="nav-link" href="{{ url('/maintenanceManagement/status') }}">Maintenance Status</a>
                        <a class="nav-link" href="{{ url('/maintenanceManagement/cost') }}">Maintenance Cost</a>
                    </nav>
                </div>
                <!-- location -->
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts5"
                    aria-expanded="false" aria-controls="collapseLayouts5">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Location Management
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts5" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <!-- side nav component -->
                        <a class="nav-link" href="{{ url('/LocationManagement') }}">All Location</a>
                    </nav>
                </div>
                <!-- vendor -->
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts6"
                    aria-expanded="false" aria-controls="collapseLayouts6">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Vendor Management
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts6" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <!-- side nav component -->
                        <a class="nav-link" href="{{ url('/VendorManagement') }}">All Vendor</a>
                    </nav>
                </div>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ Auth::user()->name }}
        </div>
    </nav>
</div>