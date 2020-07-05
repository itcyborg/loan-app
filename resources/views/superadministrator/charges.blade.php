@extends('layouts.app')
@section('title')
    Charges
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#addRole" aria-expanded="false" aria-controls="addRole">
                        Add Charge
                    </button>
                    <div class="collapse" id="addRole">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <div class="title">Add Charge</div>
                            </div>
                            <div class="card-body">
                                <div class="form">
                                    {!! Form::open(['route'=>'charges.store']) !!}
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            {!! Form::select('product_id',$products->pluck('name','id'),null,['class'=>'form-control','placeholder'=>'Select Product']) !!}
                                        </div>
                                        <div class="form-group col-md-6">
                                            {!! Form::select('type',['FIXED'=>'Fixed','PERCENTAGE'=>'Percent'],null,['class'=>'form-control','placeholder'=>'Select Type']) !!}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Charge Name']) !!}
                                        </div>
                                        <div class="form-group col-md-6">
                                            {!! Form::text('amount',null,['class'=>'form-control','placeholder'=>'Amount']) !!}
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
                    <div class="card-title">Charges</div>
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
