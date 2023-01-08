<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-light">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 min-vh-100" style="position: fixed">
                    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                        <!-- <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg> -->
                        <span class="fs-4">Menu</span>
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <!-- User Management -->
                        <li class="nav-item">
                            <a href="/admin" class="nav-link link-dark px-0 align-middle">
                                <i class="fs-4 bi-person-badge"></i> <span class="d-none d-sm-inline">User
                                    Account</span> </a>
                        </li>
                        <!-- member Management -->
                        <li>
                            <a href="/FacultyMember" class="nav-link link-dark px-0 align-middle"> <i class="fs-4 bi-people"></i>
                                <span class="d-none d-sm-inline">Faculty Member</span></a>

                        </li>
                        <!-- Asset-->
                        <li>
                            <a href="/Asset" class="nav-link link-dark px-0 align-middle"><i class="fs-4 bi-laptop"></i>
                                <span class="d-none d-sm-inline">Asset Management</span></a>
                        </li>
                        <!-- Budget -->

                        <li>
                            <a href="#" class="nav-link link-dark px-0 align-middle"><i class="fs-4 bi-currency-dollar"></i> <span class="d-none d-sm-inline">Budget
                                    Management</span></a>
                        </li>
                        <!-- Maintenance Management -->
                        <li>
                            <a href="/MaintenanceManagement" class="nav-link link-dark px-0 align-middle ">
                                <i class="fs-4 bi-tools"></i> <span class="ms-1 d-none d-sm-inline">Maintenance</span></a>
                        </li>
                        <!-- Vendor Management -->
                        <li>
                            <a href="/VendorManagement" class="nav-link link-dark px-0 align-middle">
                                <i class="fs-4 bi-shop"></i> <span class="ms-1 d-none d-sm-inline">Vendor</span> </a>
                        </li>
                        <!-- Location Management -->
                        <li>
                            <a href="/LocationManagement" class="nav-link link-dark px-0 align-middle">
                                <i class="fs-4 bi-map"></i> <span class="ms-1 d-none d-sm-inline">Location</span> </a>
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
            <div class="col py-3" style="background-color: #DDDDDD;">
                @yield('content')
            </div>
        </div>
    </div>
</body>

</html>