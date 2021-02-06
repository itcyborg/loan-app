@extends('layouts.app')
@section('title')
    Payments
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                @can('create_payment')
                    <div class="w-100 p-4">
                        <a href="{{url('/payment/create')}}" class="btn btn-primary pull-right">Add Payment</a>
                    </div>
                @endcan
                <div class="card-header card-header-primary">
                    <div class="card-title">Payment</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-condensed">
                       {{$dataTable->table()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    {{$dataTable->scripts()}}
@endsection
