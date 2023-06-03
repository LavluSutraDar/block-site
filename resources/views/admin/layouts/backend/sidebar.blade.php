<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="">
            <img class="img-fluid" height="50px" width="50px" src="{{ asset('backend/img/1680368190453.png') }}">
        </div>
        <div class="sidebar-brand-text mx-3">Apurva Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item @if ($page == 'Dashboard') active @endif">

        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Apurva Admin Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        CORE
    </div>

    <!-- Nav Item - Tables -->
    <li class="nav-item  @if ($page == 'Categories')active @endif">

        <a class="nav-link" href="{{route('category.index')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>Category Table</span>
        </a>
    </li>

     <li class="nav-item @if ($page == 'post')active @endif">

        <a class="nav-link" href="{{route('post.index')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>Post Table</span>
        </a>
    </li>

     <li class="nav-item @if ($page == 'message')active @endif">

        <a class="nav-link" href="{{route('messages.index')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>Contuct Messages</span>
        </a>
    </li>

  

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item" href="">Login</a>
                <a class="collapse-item" href="">Register</a>
                <a class="collapse-item" href="">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="">404 Page</a>
                <a class="collapse-item" href="">Blank Page</a>
            </div>
        </div>
    </li>
</ul>

<!-- End of Sidebar -->
