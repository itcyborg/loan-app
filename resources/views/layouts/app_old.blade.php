<html>
<head>
    <title>Loans - @yield('title')</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    @include('layouts.styles')
</head>
<body>
<div class="wrapper ">
    @section('sidebar')
        @include('layouts.sidebar')
    @show
    @section('content-panel')
        @include('layouts.content')
    @show
</div>
<script src="{{asset('assets_/js/core/jquery.min.js')}}"></script>
<script src="{{asset('assets_/js/helpers.js')}}" defer async></script>
<script src="{{asset('assets_/js/core/popper.min.js')}}"></script>
<script src="{{asset('assets_/js/core/bootstrap-material-design.min.js')}}"></script>
@notifyJs
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
@yield('scripts')
</body>
</html>
