<li class="nav-item {{ Request::is('home*') ? 'active' : '' }}">
    <a class="nav-link" href="{{route('home')}}">
        <i class="material-icons">dashboard</i>
        <p>Dashboard</p>
    </a>
</li>
<li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
    <a class="nav-link" href="{{route('users.index')}}">
        <i class="material-icons">user</i>
        <p>Users</p>
    </a>
</li>
<li class="nav-item {{ Request::is('roles*') ? 'active' : '' }}">
    <a class="nav-link" href="{{route('roles.index')}}">
        <i class="material-icons">user</i>
        <p>Roles</p>
    </a>
</li>
<li class="nav-item {{ Request::is('permissions*') ? 'active' : '' }}">
    <a class="nav-link" href="{{route('permissions.index')}}">
        <i class="material-icons">user</i>
        <p>Permissions</p>
    </a>
</li>
<li class="nav-item {{ Request::is('products*') ? 'active' : '' }}">
    <a class="nav-link" href="{{route('products.index')}}">
        <i class="material-icons">user</i>
        <p>Products</p>
    </a>
</li>
<li class="nav-item {{ Request::is('clients*') ? 'active' : '' }}">
    <a class="nav-link" href="{{route('client.index')}}">
        <i class="material-icons">user</i>
        <p>Clients</p>
    </a>
</li>
