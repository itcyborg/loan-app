<div class="main-panel">
    @include('layouts.navbar')
    <div class="content">
        <div class="container-fluid">
            <!-- your content here -->
            @yield('content')
        </div>
    </div>
    @include('layouts.footer')
</div>
