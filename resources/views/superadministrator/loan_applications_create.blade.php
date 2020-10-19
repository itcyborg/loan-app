@extends('layouts.app')
@section('title')
    New Loan Application
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div id="addRole">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <div class="title">New Loan Application</div>
                    </div>
                    <div class="card-body">
                        <div class="form">
                            {!! Form::open(['route'=>'loan-applications.store']) !!}
                            <div class="row">
                                <div class="form-group col-md-6">
                                    {!! Form::select('client_id',$clients->pluck('name','id'),null,['class'=>'form-control','placeholder'=>'Select Client']) !!}
                                </div>
                                <div class="form-group col-md-6">
                                    {!! Form::select('product_id',$products->pluck('code','id'),null,['class'=>'form-control','placeholder'=>'Select Product']) !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    {!! Form::number('amount_applied',null,['class'=>'form-control','placeholder'=>'Amount']) !!}
                                </div>
                                <div class="form-group col-md-6">
                                    {!! Form::number('duration',null,['class'=>'form-control','placeholder'=>'Duration (months)']) !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    {!! Form::text('purpose',null,['class'=>'form-control','placeholder'=>'Purpose']) !!}
                                </div>
                                <div class="form-group col-md-6">
                                    {!! Form::select('repayment_frequency',['DAILY'=>'Daily','WEEKLY'=>'Weekly','MONTHLY'=>'Monthly'],null,['class'=>'form-control','placeholder'=>'Repayment Frequency']) !!}
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
