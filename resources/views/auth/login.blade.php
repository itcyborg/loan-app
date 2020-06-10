@extends('layouts.auth')
@section('title')
    Login Page
@endsection

@section('brand_link')
    <a class="navbar-brand" href="{{url(route('login'))}}">LoginPage</a>
@endsection
@section('content')
    <form class="form" method="post" action="{{url(route('login'))}}">
        <div class="card card-login card-hidden">
            <div class="card-header card-header-primary text-center">
                <h4 class="card-title">Login</h4>
            </div>
            <div class="card-body ">
                <div class="container">
                    <div class="row">
                        <div class="form-group w-100"><br><br>
                            <input type="email" name="email" id="email" class="form-control form-control-lg" placeholder="Email"><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group w-100">
                            <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="Password">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer justify-content-center">
                <button class="btn btn-rose btn-link btn-lg">Lets Go</button>
            </div>
        </div>
    </form>
@endsection
