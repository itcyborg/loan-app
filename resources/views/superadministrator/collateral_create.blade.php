@extends('layouts.app')
@section('title')
    Add collateral
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div id="addRole">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <div class="title">Add Collateral</div>
                    </div>
                    <div class="card-body">
                        <div class="form">
                            {!! Form::open(['route'=>'collateral.store']) !!}
                            <input type="text" name="application_id" value="{{$application_id}}" hidden>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    {!! Form::text('type',null,['class'=>'form-control','placeholder'=>'Type']) !!}
                                </div>
                                <div class="form-group col-md-6">
                                    {!! Form::number('value',null,['class'=>'form-control','placeholder'=>'Value']) !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    {!! Form::textarea('details',null,['class'=>'form-control','placeholder'=>'Details']) !!}
                                </div>
                            </div>
                            {!! Form::submit('Next',['class'=>'btn btn-primary']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
