@extends('layouts.app')
@section('title')
    Next of Kin
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div id="addRole">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <div class="title">Add Next of Kin</div>
                    </div>
                    <div class="card-body">
                        <div class="form">
                            {!! Form::open(['route'=>'next-of-kin.store']) !!}
                            <input type="text" name="loan_applications_id" value="{{$application_id}}" hidden>
                            <input type="text" name="client_id" value="{{$client_id}}" hidden>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Full Name']) !!}
                                </div>
                                <div class="form-group col-md-4">
                                    {!! Form::email('email',null,['class'=>'form-control','placeholder'=>'Email']) !!}
                                </div>
                                <div class="form-group col-md-4">
                                    {!! Form::select('gender',['MALE'=>'Male','FEMALE'=>'Female'],null,['class'=>'form-control','placeholder'=>'Gender']) !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    {!! Form::select('identification_document',['MILITARY_ID'=>'Military ID','NATIONAL_ID'=>'National ID','PASSPORT'=>'Passport'],null,['class'=>'form-control','placeholder'=>'Select Document Type']) !!}
                                </div>
                                <div class="form-group col-md-4">
                                    {!! Form::text('identification_number',null,['class'=>'form-control','placeholder'=>'Identification Number']) !!}
                                </div>
                                <div class="form-group col-md-4">
                                    {!! Form::text('nationality',null,['class'=>'form-control','placeholder'=>'Nationality']) !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    {!! Form::text('relation',null,['class'=>'form-control','placeholder'=>'Relation']) !!}
                                </div>
                                <div class="form-group col-md-6">
                                    {!! Form::date('date_of_birth',null,['class'=>'form-control','placeholder'=>'Date of Birth']) !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    {!! Form::number('primary_contact',null,['class'=>'form-control','placeholder'=>'Primary Contact']) !!}
                                </div>
                                <div class="col-md-4">
                                    {!! Form::number('alternative_contact',null,['class'=>'form-control','placeholder'=>'Alternative Contact']) !!}
                                </div>
                                <div class="col-md-4">
                                    {!! Form::textarea('address',null,['class'=>'form-control','placeholder'=>'Address']) !!}
                                </div>
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
