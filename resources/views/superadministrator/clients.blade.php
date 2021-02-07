@extends('layouts.app')
@section('title')
    Clients
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
    <div class="app">
        @can('create_client')
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
                                                {!! Form::textarea('address',null,['class'=>'form-control','placeholder'=>'Physical Address']) !!}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                {!! Form::label('latitude','Latitude') !!}
                                                {!! Form::text('latitude',null,['class'=>'form-control']) !!}
                                            </div>
                                            <div class="col-6">
                                                {!! Form::label('longitude','Longitude') !!}
                                                {!! Form::text('longitude',null,['class'=>'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="row" id="map"></div>
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
        @endcan
        <div class="row">
            @can('update_client')
                @include('modals.edit-client')
            @endcan
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <div class="card-title">Clients</div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                           <table class="table table-striped table-shopping" id="clients_table">
                               <thead>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Nationality</th>
                                <th>Identification Document</th>
                                <th>Identification Number</th>
                                <th>Primary Contact</th>
                                <th>Alternative Contact</th>
                                <th>Address</th>
                                <th>Date of Birth</th>
                                <th>Created at</th>
                                <th>Action</th>
                               </thead>
                               <tbody>
                               @foreach($clients as $client)
                                   <tr>
                                       <td>{{$client->id}}</td>
                                       <td>{{$client->name}}</td>
                                       <td>{{$client->email}}</td>
                                       <td>{{$client->gender}}</td>
                                       <td>{{$client->nationality}}</td>
                                       <td>{{$client->identification_document}}</td>
                                       <td>{{$client->identification_number}}</td>
                                       <td>{{$client->primary_contact}}</td>
                                       <td>{{$client->alternative_contact}}</td>
                                       <td>{{$client->address}}</td>
                                       <td>{{Carbon\Carbon::parse($client->date_of_birth)->toDateString()}}</td>
                                       <td>{{Carbon\Carbon::parse($client->created_at)->toDateString()}}</td>
                                       <td>
                                           @can('update_client')
                                               <button class="btn btn-info btn-sm fa fa-edit" v-on:click="loadClient('{{route('client.show', $client->id)}}',{{$client->id}})" data-toggle="modal" data-target=".edit_client"></button>
                                           @endcan
                                       </td>
                                   </tr>
                               @endforeach
                               </tbody>
                           </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBuogBspOfHKhSzSldN3vYhcCcsHSoShRA&libraries=places"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        var marker=false;

        var map, infoWindow;
        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -34.397, lng: 150.644},
                zoom: 14
            });
            infoWindow = new google.maps.InfoWindow;

            // Try HTML5 geolocation.
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    infoWindow.setPosition(pos);
                    infoWindow.setContent('Location found.');
                    infoWindow.open(map);
                    map.setCenter(pos);
                    if(marker===false){
                        marker=new google.maps.Marker({
                            position:pos,
                            map:map,
                            draggable:true
                        });
                        markerLocation();
                        google.maps.event.addListener(marker,'dragend',function(event){
                            markerLocation();
                        });
                    }else{
                        marker.setPosition(pos);
                    }
                }, function() {
                    handleLocationError(true, infoWindow, map.getCenter());
                });
            } else {
                // Browser doesn't support Geolocation
                handleLocationError(false, infoWindow, map.getCenter());
            }
        }

        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(browserHasGeolocation ?
                'Error: The Geolocation service failed.' :
                'Error: Your browser doesn\'t support geolocation.');
            infoWindow.open(map);
        }

        function markerLocation(){
            var currentLocation=marker.getPosition();
            document.getElementById('latitude').value=currentLocation.lat();
            document.getElementById('longitude').value=currentLocation.lng();
        }

        $(document).ready(function() {
            // Basic
            $('#clients_table').DataTable();
            google.maps.event.addDomListener(window, 'load', initMap);

        });
    </script>
    <script>

        // vue instance
        var app = new Vue({
            el: '.app',
            data: {
                id:'',
                client:{
                    name:'',
                    email:'',
                    gender:'',
                    identification_document:'',
                    identification_number:'',
                    nationality:'',
                    date_of_birth:'',
                    primary_contact:'',
                    alternative_contact:'',
                    address:'',
                    longitude:'',
                    latitude:''
                },
                clients:null
            },
            methods:{
                updateClient:function(){
                    axios.patch('client/'+this.id,this.client).then((res)=>{
                        console.log(res)
                        alert('Client updated')
                    }).catch((reason) => {
                        alert('An error occurred')
                        console.log(reason);
                    })
                },
                loadClient:function(url,id){
                    this.id=id;
                    axios.get(url).then((res)=>{
                        console.log(res)
                        this.client=res.data;
                    })
                }
            }
        });


        // end of vue instance
    </script>
@endsection
