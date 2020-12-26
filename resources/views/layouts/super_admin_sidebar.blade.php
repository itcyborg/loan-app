<li class="nav-item {{ Request::is('home*') ? 'active' : '' }}">
    <a class="nav-link" href="{{route('home')}}">
        <i class="fa fa-tachometer-alt"></i>
        <p>Dashboard</p>
    </a>
</li>
<li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
    <a class="nav-link" href="{{route('users.index')}}">
        <i class="fa fa-user"></i>
        <p>Users</p>
    </a>
</li>
<li class="nav-item {{ Request::is('roles*') ? 'active' : '' }}">
    <a class="nav-link" href="{{route('roles.index')}}">
        <i class="fa fa-lock"></i>
        <p>Roles</p>
    </a>
</li>
<li class="nav-item {{ Request::is('permissions*') ? 'active' : '' }}">
    <a class="nav-link" href="{{route('permissions.index')}}">
        <i class="fa fa-key"></i>
        <p>Permissions</p>
    </a>
</li>
<li class="nav-item {{ Request::is('products*') ? 'active' : '' }}">
    <a class="nav-link" href="{{route('products.index')}}">
        <i class="fa fa-list-alt"></i>
        <p>Products</p>
    </a>
</li>
<li class="nav-item {{ Request::is('charges*') ? 'active' : '' }}">
    <a class="nav-link" href="{{route('charges.index')}}">
        <i class="fa fa-coins"></i>
        <p>Charges</p>
    </a>
</li>
<li class="nav-item {{ Request::is('client*') ? 'active' : '' }}">
    <a class="nav-link" href="{{route('client.index')}}">
        <i class="fa fa-users"></i>
        <p>Clients</p>
    </a>
</li>
<li class="nav-item {{ Request::is('loan-applications*') ? 'active' : '' }}">
    <a class="nav-link" href="{{route('loan-applications.index')}}">
        <i class="fa fa-clipboard"></i>
        <p>Loan Applications</p>
    </a>
</li>
<li class="nav-item {{ Request::is('repayment*') ? 'active' : '' }}">
    <a class="nav-link" href="{{route('repayment.index')}}">
        <i class="fa fa-money-bill"></i>
        <p>Repayments</p>
    </a>
</li>
<li class="nav-item {{ Request::is('reports*') ? 'active' : '' }}">
    <a class="nav-link" href="{{route('reports.index')}}">
        <i class="fa fa-file-alt"></i>
        <p>Reports</p>
    </a>
</li>

