@extends('layouts.app')
@section('title')
    Payments
@endsection
@section('content')
    <div class="row" id="payment">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <div class="title">Add Payment</div>
                            </div>
                            <div class="card-body">
                                <div class="form">
                                    <form @submit.prevent="savePayment">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="client">Client Name</label>
                                            <select name="client" id="client" v-model="form.client_id" class="form-control" @change="getApplications" placeholder="Select Client">
                                                <option value="">Select Client</option>
                                                <option v-for="client in clients" v-bind:value="client.id">@{{client.name}} (@{{client.identification_number}})</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="application">Applications</label>
                                            <select name="applications" id="application" v-model="form.application_id" class="form-control" placeholder="Select Application">
                                                <option value="">Select Application</option>
                                                <option v-for="application in applications" v-bind:value="application.id">@{{application.id}} (@{{application.amount_approved}})</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="amount">Amount</label>
                                            <input type="number" name="amount" id="amount" class="form-control" v-model="form.amount" placeholder="Amount">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                        </div>
                                        <div class="form-group col-md-6">
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
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        let app=new Vue({
            el:"#payment",
            data:{
                form: {
                    client_id: null,
                    application_id: null,
                    amount: 0
                },
                clients: [],
                applications: []
            },
            mounted(){
                this.getClients()
            },
            methods:{
                getClients:function (){
                    let loader=document.getElementById('loader')
                    loader.classList.add("is-active")
                    axios.get('/clients').then((res)=>{
                        this.clients=res.data;
                        loader.classList.remove("is-active")
                    }).catch((error)=>{
                        loader.classList.remove("is-active")
                        console.log(error)
                    })
                },
                getApplications:function(){
                    let loader=document.getElementById('loader')
                    loader.classList.add("is-active")
                    axios.post('/applications',{client_id:this.form.client_id}).then((res)=>{
                        this.applications=res.data;
                        loader.classList.remove("is-active")
                    }).catch((error)=>{
                        loader.classList.remove("is-active")
                        alert(error.data)
                    });
                },
                savePayment:function(){
                    let loader=document.getElementById('loader')
                    loader.classList.add("is-active")
                    axios.post('/payment',this.form).then((res)=>{
                        loader.classList.remove("is-active")
                        alert(res.data)
                    }).catch((error)=>{
                        loader.classList.remove("is-active")
                        alert(error.data)
                    });
                }
            }
        });
    </script>
@endsection
