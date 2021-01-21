@extends('layouts.app')
@section('title')
    Repayments
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h2 class="card-title">Repayments</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                       {{$dataTable->table()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('assets_/js/app.js')}}"></script>
    {{$dataTable->scripts()}}
@endsection
