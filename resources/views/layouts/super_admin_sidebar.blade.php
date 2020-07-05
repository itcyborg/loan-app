<li class="nav-item {{ Request::is('home*') ? 'active' : '' }}">
    <a class="nav-link" href="{{route('home')}}">
        <i class="material-icons">dashboard</i>
        <p>Dashboard</p>
    </a>
</li>
<li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
    <a class="nav-link" href="{{route('users.index')}}">
        <i class="material-icons">supervisor_account</i>
        <p>Users</p>
    </a>
</li>
<li class="nav-item {{ Request::is('roles*') ? 'active' : '' }}">
    <a class="nav-link" href="{{route('roles.index')}}">
        <i class="material-icons">lock</i>
        <p>Roles</p>
    </a>
</li>
<li class="nav-item {{ Request::is('permissions*') ? 'active' : '' }}">
    <a class="nav-link" href="{{route('permissions.index')}}">
        <i class="material-icons">vpn_key</i>
        <p>Permissions</p>
    </a>
</li>
<li class="nav-item {{ Request::is('products*') ? 'active' : '' }}">
    <a class="nav-link" href="{{route('products.index')}}">
        <i class="material-icons">dns</i>
        <p>Products</p>
    </a>
</li>
<li class="nav-item {{ Request::is('charges*') ? 'active' : '' }}">
    <a class="nav-link" href="{{route('charges.index')}}">
        <i class="material-icons">money</i>
        <p>Charges</p>
    </a>
</li>
<li class="nav-item {{ Request::is('client*') ? 'active' : '' }}">
    <a class="nav-link" href="{{route('client.index')}}">
        <i class="material-icons">people_alt</i>
        <p>Clients</p>
    </a>
</li>
<li class="nav-item {{ Request::is('loan-applications*') ? 'active' : '' }}">
    <a class="nav-link" href="{{route('loan-applications.index')}}">
        <i class="material-icons">assignment</i>
        <p>Loan Applications</p>
    </a>
</li>
