<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{ url('/home') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                <div class="sb-sidenav-menu-heading">Actions</div>
                <!-- Asset Management -->
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
                    aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Asset Management
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <!-- side nav component -->
                        <a class="nav-link" href="{{ url('/Asset') }}">All Asset</a>
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
                        <a class="nav-link" href="{{ url('/Budget') }}">Budget List</a>
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
                        <a class="nav-link" href="{{ url('#') }}">Add Category</a>
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
                        <a class="nav-link" href="{{ url('#') }}">Add Category</a>
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
                        <a class="nav-link" href="{{ url('#') }}">Add Category</a>
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