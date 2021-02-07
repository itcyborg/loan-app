@extends('layouts.app')
@section('title')
    User Permissions
@endsection
@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <style>
        .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
            padding: 3px 7px;
            vertical-align: middle;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div id="addRole">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <div class="title">Assign Permission to User</div>
                            </div>
                            <div class="card-body">
                                <div class="form">
                                    {!! Form::open(['url'=>url()->current()]) !!}
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="permissions">Permissions</label>
                                            {!! Form::select('permissions[]',$permissions->pluck('name','id'),$userPermissions->pluck('id'),['class'=>'form-control','multiple'=>true,'id'=>'permissions']) !!}
                                        </div>
                                    </div>
                                    {!! Form::submit('Add',['class'=>'btn btn-primary pull-right']) !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('#permissions').select2({
            placeholder:"Select Permissions"
        });
    </script>
@endsection
