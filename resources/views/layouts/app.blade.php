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
<div class="container">
    @yield('content')
</div>
</body>
</html>
