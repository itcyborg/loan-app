@extends('layouts.app')
@section('title')
    Repayments
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#addRole" aria-expanded="false" aria-controls="addRole">
                        Add Repayment
                    </button>
                    <div class="collapse p-1" id="addRole">
                        <div class="form p-3 ">
                            {!! Form::open(['route'=>'repayment.store']) !!}
                            <div class="row">
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    {!! Form::select('client',$clients->pluck('name','id'),null,['class'=>'form-control','placeholder'=>'Client Name','id'=>'client']) !!}
                                </div>
                                <div class="form-group col-md-6">
                                    {!! Form::select('application',[],null,['class'=>'form-control','placeholder'=>'Select Application','id'=>'application']) !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    {!! Form::number('amount',null,['class'=>'form-control','placeholder'=>'Amount','id'=>'amount']) !!}
                                </div>
                            </div>
                            {!! Form::submit('Add Payment',['class'=>'btn btn-primary']) !!}
                            {!! Form::close() !!}
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
                    <div class="card-title">Repayments</div>
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
    <script src="{{asset('assets/js/app.js')}}"></script>
    {{$dataTable->scripts()}}
@endsection
