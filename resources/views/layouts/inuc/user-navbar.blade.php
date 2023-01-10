 <!-- Scripts -->
 <link href="{{asset('assets/css/styles.css')}}" rel="stylesheet">
 <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
     integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
 </script>

 <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
     <!-- Navbar Brand-->
     <a class="navbar-brand ps-3" href="/">Asset Management</a>
     <!-- Navbar-->
     <ul class="navbar-nav ms-auto me-0 me-md-3 my-2 my-md-0">
         <li class="nav-item dropdown">
             <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                 aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
             <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                 <li><a class="dropdown-item" href="{{url('/ManageUserProfile')}}">Profile</a></li>
                 <li>
                     <hr class="dropdown-divider" />
                 </li>
                 <li><a class="dropdown-item" href="{{route('logout')}}"
                         onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                     <form id="logout-form" action="{{route('logout')}}" method="POST" class="d-none">
                         @csrf
                     </form>
                 </li>
             </ul>
         </li>
     </ul>
 </nav>