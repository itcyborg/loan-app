@extends('layouts.app')
@section('title')
    Charges
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
    <div id="charge">
        @can('create_charge')
            <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#addChargeV" aria-expanded="false" aria-controls="addRole">
                            Add Charge
                        </button>
                        <div class="collapse" id="addChargeV">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <div class="title">Add Charge</div>
                                </div>
                                <div class="card-body">
                                    <div class="form">
                                        {!! Form::open(['route'=>'charges.store','id'=>'chargeFrm']) !!}
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="product_id">Product</label>
                                                {!! Form::select('product_id',$products->pluck('name','id'),null,['class'=>'form-control','placeholder'=>'Select Product','id'=>'product_id']) !!}
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="type">Type</label>
                                                {!! Form::select('type',['FIXED'=>'Fixed','PERCENTAGE'=>'Percent'],null,['class'=>'form-control','placeholder'=>'Select Type','id'=>'type']) !!}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="name">Name</label>
                                                {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Charge Name','id'=>'name']) !!}
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="amount">Amount/ %</label>
                                                {!! Form::text('amount',null,['class'=>'form-control','placeholder'=>'Amount','id'=>'amount']) !!}
                                            </div>
                                        </div>
                                        {!! Form::submit('Add',['class'=>'btn btn-primary','id'=>'submit']) !!}
                                        <button class="btn btn-primary" type="button" id="update" onclick="updateCharge()">Update</button>
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
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#update').hide();
            $('#chargeFrm').on('submit',function(e){
                e.preventDefault();
            });
        });
        let ids=null;
        let loader=document.getElementById('loader')
        let mode=null;

        function viewCharge(id){
            loader.classList.add("is-active")
            ids=id;
            axios.get('/charges/'+id).then((res)=>{
                loader.classList.remove("is-active")
                $('#product_id').val(res.data.product_id).prop('readonly',true);
                $('#type').val(res.data.type).prop('readonly',true);
                $('#name').val(res.data.name).prop('readonly',true);
                $('#amount').val(res.data.amount).prop('readonly',true);
            })
            $('#submit').hide()
            $('#update').hide();
            $('#addChargeV').addClass('show')
        }

        function editCharge(id){
            ids=id;
            loader.classList.add("is-active")
            axios.get('/charges/'+id).then((res)=>{
                loader.classList.remove("is-active")
                $('#product_id').val(res.data.product_id).prop('readonly',false);
                $('#type').val(res.data.type).prop('readonly',false);
                $('#name').val(res.data.name).prop('readonly',false);
                $('#amount').val(res.data.amount).prop('readonly',false);
            })
            $('#submit').hide()
            $('#update').show();
            $('#addChargeV').addClass('show')
        }

        function updateCharge(){
            loader.classList.add("is-active")
            axios.put('/charges/'+ids,{
                product_id:$('#product_id').val(),
                type:$('#type').val(),
                name:$('#name').val(),
                amount:$('#amount').val()
            }).then((res)=>{
                loader.classList.remove("is-active")
                alert('Charge updated successfully');
                window.location.reload();
            }).catch((error)=>{
                loader.classList.remove("is-active")
                alert('An error occurred');
            })
        }
    </script>
    {{$dataTable->scripts()}}
@endsection
