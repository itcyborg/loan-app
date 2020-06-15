<div class="main-panel">
    @include('layouts.navbar')
    <div class="content">
        <div class="container-fluid">
            <!-- your content here -->
            @include('notify::messages')
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
{{--                        {{Session::get('errors')}}--}}
                        @foreach ($errors->all() as $error)
                            <li>{{ $error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @yield('content')
        </div>
    </div>
    @include('layouts.footer')
</div>
