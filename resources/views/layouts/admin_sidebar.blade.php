<li class="nav-item {{ Request::is('home*') ? 'active' : '' }}">
    <a class="nav-link" href="{{route('home')}}">
        <i class="material-icons">dashboard</i>
        <p>Dashboard</p>
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
