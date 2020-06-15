<div class="main-panel">
    @include('layouts.navbar')
    <div class="content">
        <div class="container-fluid">
            <!-- your content here -->
            @include('notify::messages')
            @yield('content')
        </div>
    </div>
    @include('layouts.footer')
</div>
