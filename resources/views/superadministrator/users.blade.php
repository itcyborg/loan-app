@extends('layouts.app')
@section('title')
    Users
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
    @can('create_user')
        <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#addUser" aria-expanded="false" aria-controls="addUser">
                        Add User
                    </button>
                    <div class="collapse" id="addUser">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <div class="title">Add User</div>
                            </div>
                            <div class="card-body">
                                <div class="form">
                                    {!! Form::open(['route'=>'users.store']) !!}
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'User Name']) !!}
                                        </div>
                                        <div class="form-group col-md-4">
                                            {!! Form::email('email',null,['class'=>'form-control','placeholder'=>'Email']) !!}
                                        </div>
                                        <div class="form-group col-md-4">
                                            {!! Form::select('role',$roles->pluck('name','name'),null,['class'=>'form-control','placeholder'=>'Role']) !!}
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
                    <div class="card-title">Users</div>
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
@endsection
@include('modals.edit_user')
