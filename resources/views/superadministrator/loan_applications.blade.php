@extends('layouts.app')
@section('title')
    New Loan Application
@endsection
@section('styles')
    <link rel="stylesheet" href="{{asset('assets/print.css')}}" media="print">
    <style>
        .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
            padding: 3px 7px;
            vertical-align: middle;
        }
    </style>
@endsection
@section('content')
    @can('apply_loan')
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
    @endcan
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
    <script>
        $(document).ready(function(){
            $('#loanapplication-table').on('draw.dt', function(){
                    $('[data-toggle="tooltip"]').tooltip()
            });
        });
    </script>
@endsection
{{--@include('modals.view_loan_application')--}}
@include('modals.new_view_loan_application')
