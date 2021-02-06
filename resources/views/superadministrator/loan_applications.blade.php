@extends('layouts.app')
@section('title')
    New Loan Application
@endsection
@section('styles')
    <link rel="stylesheet" href="{{asset('assets/print.css')}}" media="print">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{route('loan-applications.create')}}" class="btn btn-primary">
                        Loan Applications
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <div class="card-title">Loan Applications</div>
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
    {{$dataTable->scripts()}}
    <script src="{{asset('assets/print_elements.js')}}"></script>
@endsection
{{--@include('modals.view_loan_application')--}}
@include('modals.new_view_loan_application')
