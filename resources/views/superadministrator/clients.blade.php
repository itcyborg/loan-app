@extends('layouts.app')
@section('title')
    Clients
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#addRole" aria-expanded="false" aria-controls="addRole">
                        Add Client
                    </button>
                    <div class="collapse" id="addRole">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <div class="title">Add Client</div>
                            </div>
                            <div class="card-body">
                                <div class="form">
                                    {!! Form::open(['route'=>'client.store']) !!}
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Client Full Name']) !!}
                                        </div>
                                        <div class="form-group col-md-4">
                                            {!! Form::email('email',null,['class'=>'form-control','placeholder'=>'Email']) !!}
                                        </div>
                                        <div class="form-group col-md-4">
                                            {!! Form::select('gender',['MALE'=>'Male','FEMALE'=>'Female'],null,['class'=>'form-control','placeholder'=>'Select Gender']) !!}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            {!! Form::select('identification_document',['MILITARY_ID'=>'Military ID','NATIONAL_ID'=>'National ID','PASSPORT'=>'Passport'],null,['class'=>'form-control','placeholder'=>'Select Document Type']) !!}
                                        </div>
                                        <div class="form-group col-md-6">
                                            {!! Form::text('identification_number',null,['class'=>'form-control','placeholder'=>'Identification Number']) !!}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            {!! Form::text('nationality',null,['class'=>'form-control','placeholder'=>'Nationality']) !!}
                                        </div>
                                        <div class="form-group col-md-6">
                                            {!! Form::date('date_of_birth',\Carbon\Carbon::now(),['class'=>'form-control','placeholder'=>'Date of birth']) !!}
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
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <div class="card-title">Clients</div>
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
