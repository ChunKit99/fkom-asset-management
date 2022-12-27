<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
</head>
<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-light">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 min-vh-100">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                <!-- <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg> -->
                <span class="fs-4">Menu</span>
            </a>
            <hr>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <!-- Home -->
                    <!-- Report part, show the summary graph and provide some function -->
                    <li class="nav-item">
                        <a href="#" class="nav-link link-dark align-middle px-0 ">
                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                        </a>
                    </li>
                    <!-- User Management -->
                    <li>
                        <a href="#submenu1" data-bs-toggle="collapse" class="nav-link link-dark px-0 align-middle">
                            <i class="fs-4 bi-person"></i> <span class="ms-1 d-none d-sm-inline">User</span> </a>
                        <ul class="collapse nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="#" class="nav-link link-dark px-0 align-middle">
                                    <i class="fs-4 bi-person-badge"></i> <span class="d-none d-sm-inline">User Account</span> </a>
                            </li>
                            <li>
                                <a href="#" class="nav-link link-dark px-0 align-middle"> <i class="fs-4 bi-people"></i> <span class="d-none d-sm-inline">Faculty Member</span></a>
                            </li>
                        </ul>
                    </li>
                    <!-- Asset $ Budget -->
                    <li>
                        <a href="#submenu2" data-bs-toggle="collapse" class="nav-link link-dark px-0 align-middle">
                            <i class="fs-4 bi-bank"></i> <span class="ms-1 d-none d-sm-inline">Asset & Budget</span></a>
                        <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                            <li class="w-100">
                             <a href="#" class="nav-link link-dark px-0 align-middle"><i class="fs-4 bi-laptop"></i> <span class="d-none d-sm-inline">Asset Management</span></a>
                            </li>
                            <li>
                            <a href="#" class="nav-link link-dark px-0 align-middle"><i class="fs-4 bi-currency-dollar"></i> <span class="d-none d-sm-inline">Budget Management</span></a>
                            </li>
                        </ul>
                    </li>
                    <!-- Maintenance Management -->
                    <li>
                        <a href="#" class="nav-link link-dark px-0 align-middle ">
                            <i class="fs-4 bi-tools"></i> <span class="ms-1 d-none d-sm-inline">Maintenance</span></a>
                    </li>
                    <!-- Vendor Management -->
                    <li>
                        <a href="#" class="nav-link link-dark px-0 align-middle">
                            <i class="fs-4 bi-shop"></i> <span class="ms-1 d-none d-sm-inline">Vendor</span> </a>
                    </li>
                </ul>
                <hr>
                <div class="dropdown pb-4">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
                        <span class="d-none d-sm-inline mx-1 text-dark">loser</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-light text-small shadow">
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col py-3">
            @yield('content')
        </div>
    </div>
    </div>
</body>

</html>