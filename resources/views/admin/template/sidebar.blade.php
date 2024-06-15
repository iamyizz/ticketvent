<div class="d-flex align-items-stretch">
    <!-- Sidebar Navigation-->
    <nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
            <div class="avatar"><img src="{{ asset('templateadmin/img/avatar-12.jpg') }}" alt="..." class="img-fluid rounded-circle"></div>
            <div class="title">
                <h1 class="h5">Muhammad Fayyis Khairy</h1>
                <p>Mahasiswa</p>
            </div>
        </div>
        <ul class="list-unstyled">
            <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}"><a href="{{ url('admin/dashboard') }}"> <i class="icon-home"></i>Home </a></li>
            <li class="{{ Request::is('view_category') ? 'active' : '' }}"><a href="{{ url('view_category') }}"> <i class="icon-grid"></i>Event Kategori</a></li>
            <li class="{{ Request::is('view_event') ? 'active' : '' }}"><a href="{{ url('view_event') }}"> <i class="fa fa-ticket"></i>Event</a></li>
            <li class="{{ Request::is('profil') ? 'active' : '' }}"><a href="{{ url('/profile') }}"> <i class="fa fa-user-o"></i>Profile</a></li>
        </ul>
    </nav>