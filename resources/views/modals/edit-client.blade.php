<div class="modal fade edit_client" tabindex="-1" role="dialog" aria-labelledby="EditClient" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="col-md-12 p-3">
                <div class="card">
                    <div class="card-header">
                        <h3>Edit Client</h3>
                    </div>
                    <div class="card-body">
                    <div class="form">
                        <form @submit.prevent="updateClient">
                        <div class="row">
                            <input type="text" class="hidden" hidden v-model="id">
                            <div class="form-group col-md-4">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" v-model="client.name">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="email">Email</label>
                                <input type="email" v-model="client.email" class="form-control" name="email" id="email">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="gender">Gender</label>
                                {!! Form::select('gender',['MALE'=>'Male','FEMALE'=>'Female'],null,['class'=>'form-control','placeholder'=>'Select Gender','v-model'=>'client.gender']) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                {!! Form::select('identification_document',['MILITARY_ID'=>'Military ID','NATIONAL_ID'=>'National ID','PASSPORT'=>'Passport'],null,['class'=>'form-control','placeholder'=>'Select Document Type','v-model'=>'client.identification_document']) !!}
                            </div>
                            <div class="form-group col-md-6">
                                {!! Form::text('identification_number',null,['class'=>'form-control','placeholder'=>'Identification Number','v-model'=>'client.identification_number']) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                {!! Form::text('nationality',null,['class'=>'form-control','placeholder'=>'Nationality','v-model'=>'client.nationality']) !!}
                            </div>
                            <div class="form-group col-md-6">
                                {!! Form::date('date_of_birth',\Carbon\Carbon::now(),['class'=>'form-control','placeholder'=>'Date of birth','v-model'=>'client.date_of_birth']) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                {!! Form::number('primary_contact',null,['class'=>'form-control','placeholder'=>'Primary Contact','v-model'=>'client.primary_contact']) !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::number('alternative_contact',null,['class'=>'form-control','placeholder'=>'Alternative Contact','v-model'=>'client.alternative_contact']) !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::textarea('address',null,['class'=>'form-control border','placeholder'=>'Physical Address','v-model'=>'client.address','rows'=>1]) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                {!! Form::label('latitude','Latitude') !!}
                                {!! Form::text('latitude',null,['class'=>'form-control','v-model'=>'client.latitude']) !!}
                            </div>
                            <div class="col-6">
                                {!! Form::label('longitude','Longitude') !!}
                                {!! Form::text('longitude',null,['class'=>'form-control','v-model'=>'client.longitude']) !!}
                            </div>
                        </div>
                        {!! Form::submit('Update',['class'=>'btn btn-primary']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

