<div class="sidebar" data-color="orange">
    <!--
    Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"
   -->
    @include('layouts.logo')
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item {{ Request::is('home*') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('home')}}">
                    <i class="fa fa-dashboard"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            @role('superadministrator')
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
                        <i class="fa flaticon-coins"></i>
                        <p>Charges</p>
                    </a>
                </li>
            @endrole
            @canany(['create_client','view_client','update_client','delete_client'])
                <li class="nav-item {{ Request::is('client*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('client.index')}}">
                        <i class="fa fa-users"></i>
                        <p>Clients</p>
                    </a>
                </li>
            @endcanany
            @canany(['view_loan','apply_loan','approve_loan','disburse_loan','reject_loan'])
                <li class="nav-item {{ Request::is('loan-applications*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('loan-applications.index')}}">
                        <i class="fa fa-clipboard"></i>
                        <p>Loan Applications</p>
                    </a>
                </li>
            @endcanany
            @canany(['create_payment','view_payment'])
                <li class="nav-item {{ Request::is('payment*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('payment.index')}}">
                        <i class="fa fa-money"></i>
                        <p>Payments</p>
                    </a>
                </li>
            @endcanany
            @can('view_schedule')
                <li class="nav-item {{ Request::is('repayment*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('repayment.index')}}">
                        <i class="fa fa-calendar"></i>
                        <p>Schedule</p>
                    </a>
                </li>
            @endcan
            @canany(['add_income_expense','view_income_expense','approve_income_expense'])
                <li class="nav-item {{ Request::is('revenue*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('revenue.index')}}">
                        <i class="fa flaticon-arrows"></i>
                        <p>Income & Expense</p>
                    </a>
                </li>
            @endcanany
            @can('view_reports')
                <li class="nav-item {{ Request::is('reports*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('reports.index')}}">
                        <i class="fa fa-bar-chart"></i>
                        <p>Reports</p>
                    </a>
                </li>
            @endcan
        </ul>
    </div>
</div>
