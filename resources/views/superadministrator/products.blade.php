@extends('layouts.app')
@section('title')
    Products
@endsection
@section('styles')
    <style>
        .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
            padding: 3px 7px;
            vertical-align: middle;
        }
    </style>
@endsection
@section('content')
    @can('create_product')
        <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#addRole" aria-expanded="false" aria-controls="addRole">
                        Add Product
                    </button>
                    <div class="collapse" id="addRole">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <div class="title">Add Product</div>
                            </div>
                            <div class="card-body">
                                <div class="form">
                                    {!! Form::open(['route'=>'products.store']) !!}
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            {!! Form::label('name','Product Name:') !!}
                                            {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Product Name']) !!}
                                        </div>
                                        <div class="form-group col-md-4">
                                            {!! Form::label('code','Product Code:') !!}
                                            {!! Form::text('code',null,['class'=>'form-control','placeholder'=>'Product Code']) !!}
                                        </div>
                                        <div class="form-group col-md-4">
                                            {!! Form::label('rate','Rate:') !!}
                                            {!! Form::number('rate',null,['class'=>'form-control','placeholder'=>'Rate']) !!}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            {!! Form::label('min_amount','Min Amount:') !!}
                                            {!! Form::number('min_amount',null,['class'=>'form-control','placeholder'=>'Min Amount']) !!}
                                        </div>
                                        <div class="form-group col-md-6">
                                            {!! Form::label('max_amount','Max Amount:') !!}
                                            {!! Form::number('max_amount',null,['class'=>'form-control','placeholder'=>'Max Amount']) !!}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            {!! Form::label('min_duration','Min Duration:') !!}
                                            {!! Form::number('min_duration',null,['class'=>'form-control','placeholder'=>'Min Duration']) !!}
                                        </div>
                                        <div class="form-group col-md-6">
                                            {!! Form::label('max_duration','Max Duration:') !!}
                                            {!! Form::number('max_duration',null,['class'=>'form-control','placeholder'=>'Max Duration']) !!}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            {!! Form::label('security','Security') !!}
                                            {!! Form::text('security',null,['class'=>'form-control','placeholder'=>'Security']) !!}
                                        </div>
                                    </div>
                                    {!! Form::submit('Add',['class'=>'btn btn-primary']) !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endcan
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <div class="card-title">Products</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-shopping">
                       {{$dataTable->table()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@can('update_product')
    @include('modals.edit_product')
@endcan
@section('scripts')
    {{$dataTable->scripts()}}
@endsection
