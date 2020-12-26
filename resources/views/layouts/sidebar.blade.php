<div class="sidebar" data-color="orange">
    <!--
    Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"
   -->
    @include('layouts.logo')
    <div class="sidebar-wrapper">
        <ul class="nav">
            <!-- super admin -->
            @role('superadministrator')
                @include('layouts.super_admin_sidebar')
            @endrole

            <!-- admin -->
            @role('administrator')
                @include('layouts.admin_sidebar')
            @endrole

            <!-- user -->
            @role('user')
                @include('layouts.user_sidebar')
            @endrole
        </ul>
    </div>
</div>
