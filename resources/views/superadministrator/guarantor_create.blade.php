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
                        <div class="title">Add Guarantor</div>
                    </div>
                    <div class="card-body">
                        <div class="form">
                            {!! Form::open(['route'=>'guarantor.store']) !!}
                            <input type="text" name="application_id" value="{{$application_id}}" hidden>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Full Name']) !!}
                                </div>
                                <div class="form-group col-md-3">
                                    {!! Form::select('identification_document',['MILITARY_ID'=>'Military ID','NATIONAL_ID'=>'National ID','PASSPORT'=>'Passport'],null,['class'=>'form-control','placeholder'=>'Select Document Type']) !!}
                                </div>
                                <div class="form-group col-md-3">
                                    {!! Form::text('identification_number',null,['class'=>'form-control','placeholder'=>'Identification Number']) !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    {!! Form::number('contact',null,['class'=>'form-control','placeholder'=>'Contact']) !!}
                                </div>
                            </div>
                            {!! Form::submit('Finish',['class'=>'btn btn-primary']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
