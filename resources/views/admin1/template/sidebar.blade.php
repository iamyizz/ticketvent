<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-secondary navbar-dark">
        <a href="{{ url('/admin/dashboard') }}" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary">Ticket Event</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="{{ asset('templateadmin/img/avatar-12.jpg') }}" alt="" style="width: 40px; height: 40px;">
            </div>
            <div class="ms-3">
                <h6 class="mb-0">Muhammad Fayyis Khairy</h6>
                <span>Mahasiswa</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="{{ url('/admin/dashboard') }}" class="nav-item nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            <a href="{{ url('view_category') }}" class="nav-item nav-link {{ request()->is('view_category') ? 'active' : '' }}"><i class="fa fa-th me-2"></i>Kategori</a>
            <a href="{{ url('view_event') }}" class="nav-item nav-link {{ request()->is('view_event') ? 'active' : '' }}"><i class="fa fa-keyboard me-2"></i>Event</a>
            <a href="{{ url('view_ticket') }}" class="nav-item nav-link {{ request()->is('view_ticket') ? 'active' : '' }}"><i class="fa fa-ticket-alt me-2"></i>Ticket</a>
            <a href="{{ url('view_order') }}" class="nav-item nav-link {{ request()->is('view_order') ? 'active' : '' }}"><i class="fa fa-shopping-cart me-2"></i>Orders</a>
        </div>
    </nav>
</div>