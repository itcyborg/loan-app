@extends('layouts.app')
@section('title')
    New Loan Application
@endsection
@section('content')
    <div class="row w-100">
        <div class="card">
            <div class="card-header bg-light">
                <h4 class="card-title">Loan Applications</h4>
            </div>
        </div>
        <div class="card">
            <div class="card-header w-100">
                <div class="row w-100">
                    <a href="" class="btn btn-outline-primary m-3"><i class="fa fa-caret-left"></i> Applications</a>
                </div>
            </div>
            <div class="card-body">
                <form action="#" method="post" id="loan_application_form">
                    {{-- Applicant's details--}}
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="title">Client Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="client_name">Client Name</label>
                                        <select name="client_name" id="client_name" class="form-control">
                                            <option value="">Select Client</option>
                                            @foreach($clients as $client)
                                                <option value="{{$client->id}}" data-content="{{$client->identification_number}}">{{$client->name}} ({{$client->identification_number}})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="client_name">Date of Birth</label>
                                        <input type="date" name="client_date_of_birth" id="client_date_of_birth" class="form-control" placeholder="Date of Birth">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="client_contacts">Contact</label>
                                        <input type="text" name="client_contacts" id="client_contacts" class="form-control" placeholder="Contacts">
                                    </div>
                                </div>
                            </div>
                            <div class="row w-100 mt-1">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="client_id_number">Identification Document</label>
                                        <input type="text" class="form-control" name="client_id_document" id="client_id_document" placeholder="Identification Document">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="client_id_number">ID Number</label>
                                        <input type="text" class="form-control" name="client_id_number" id="client_id_number" placeholder="ID Number">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="client_nationality">Client Nationality</label>
                                        <input type="text" class="form-control" name="client_nationality" id="client_nationality" placeholder="Nationality">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="client_nationality">Gender</label>
                                        <input type="text" class="form-control" name="client_gender" id="client_gender" placeholder="Gender">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="client_email">Email</label>
                                        <input type="email" class="form-control" name="client_email" id="client_email" placeholder="Email">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Loan Details--}}
                    <div class="card">
                        <div class="card-header card-header-primary">
                            Loan Details
                        </div>
                        <div class="card-body">
                            <div class="card">
                                <div class="card-header card-header-info">Product Details</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="product_name">Product Name</label>
                                                <select name="product_name" id="product_name" class="form-control">
                                                    <option value="">Select Product</option>
                                                    @foreach($products as $product)
                                                        <option value="{{$product->id}}" data-content="{{$product->code}}">{{$product->name}} ({{$product->code}})</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="product_code">Product Code</label>
                                                <input type="text" name="product_code" id="product_code" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="product_rate">Product Rate (%)</label>
                                                <input type="text" name="product_rate" id="product_rate" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header card-header-info">Loan Details</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="application_amount">Application Amount</label>
                                                <input type="text" name="application_amount" id="application_amount" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="application_duration">Duration in Months</label>
                                                <input type="number" id="application_duration" name="application_duration" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="loan_officer">Loan Officer</label>
                                                <select name="loan_officer" id="loan_officer" class="form-control">
                                                    <option value="">Select Loan Officer</option>
                                                    @foreach($officers as $officer)
                                                        <option value="{{$officer->id}}">{{$officer->name}} ({{$officer->email}})</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="application_repayment_frequency">Repayment Frequency</label>
                                                <select name="application_repayment_frequency" id="application_repayment_frequency" class="form-control">
                                                    <option value="">Select Repayment Frequency</option>
                                                    <option value="daily">Daily</option>
                                                    <option value="weekly">Weekly</option>
                                                    <option value="monthly">Monthly</option>
                                                    <option value="yearly">Yearly</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="form-group">
                                            <label for="application_purpose">Purpose</label>
                                            <textarea name="application_purpose" id="application_purpose" cols="30" rows="3" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header card-header-info">Charges</div>
                                <div class="card-body"></div>
                            </div>
                        </div>
                    </div>
                    {{-- Next of Kin --}}
                    <div class="card">
                        <div class="card-header card-header-primary">Next of Kin</div>
                        <div class="card-body">
                            <div class="table-responsive w-100">
                                <table class="table table-sm table-striped" ID="NOK_TABLE">
                                    <thead>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>ID Document</th>
                                        <th>ID Number</th>
                                        <th>Nationality</th>
                                        <th>Contact</th>
                                        <th>Relation</th>
                                        <th>D.O.B</th>
                                        <th>Address</th>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><input type="text" class="form-control-sm" name="next_of_kin_name" id="next_of_kin_name"></td>
                                        <td><input type="email" name="next_of_kin_email" id="next_of_kin_email" class="form-control-sm"></td>
                                        <td class="col-2">
                                            <select name="next_of_kin_gender" id="next_of_kin_gender" class="form-control">
                                                <option value="">Select Gender</option>
                                                <option value="MALE">MALE</option>
                                                <option value="FEMALE">FEMALE</option>
                                            </select>
                                        </td>
                                        <td class="col-2">
                                            <select name="next_of_kin_document" id="next_of_kin_document" class="form-control">
                                                <option value="">Select Identification Document</option>
                                                <option value="NATIONAL_ID">NATIONAL ID</option>
                                                <option value="PASSPORT">PASSPORT</option>
                                                <option value="MILITARY_ID">MILITARY ID</option>
                                            </select>
                                        </td>
                                        <td><input type="text" class="form-control-sm" name="next_of_kin_document_number" id="next_of_kin_document_number"></td>
                                        <td><input type="text" class="form-control-sm" name="next_of_kin_nationality" id="next_of_kin_nationality"></td>
                                        <td><input type="text" class="form-control-sm" name="next_of_kin_contact" id="next_of_kin_contact"></td>
                                        <td><input type="text" class="form-control-sm" name="next_of_kin_relation" id="next_of_kin_relation"></td>
                                        <td><input type="date" name="next_of_kin_date_of_birth" id="next_of_kin_date_of_birth" class="form-control-sm"></td>
                                        <td><textarea name="next_of_kin_address" id="next_of_kin_address" cols="30" rows="1"></textarea></td>
                                        <td><a href="#" class="fa fa-trash text-danger"></a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="w-100 p-3 float-right">
                                <button class="btn btn-success float-right" type="button" onclick="addNextOfKinRow()">Add</button>
                            </div>
                        </div>
                    </div>
                    {{-- Collateral Details --}}
                    <div class="card">
                        <div class="card-header card-header-primary">Collaterals</div>
                        <div class="card-body">
                            <div class="table-responsive w-100">
                                <table class="table table-sm table-striped" id="collateral_table">
                                    <thead>
                                    <th>Type</th>
                                    <th>Details</th>
                                    <th>Value</th>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><input type="text" class="w-100" name="collateral_type" id="collateral_type"></td>
                                        <td><textarea name="collateral_details" id="collateral_details" class="w-100" rows="1"></textarea></td>
                                        <td><input type="text" class="w-100" name="collateral_value" id="collateral_value"></td>
                                        <td><a href="#" class="fa fa-trash text-danger"></a></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="w-100 p-3 float-right">
                                    <button class="btn btn-success float-right" onclick="addCollateralRow()" type="button">Add</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Guarantors Details --}}
                    <div class="card">
                        <div class="card-header card-header-primary">Guarantors</div>
                        <div class="card-body">
                            <div class="table-responsive w-100">
                                <table class="table table-sm table-striped" id="guarantors_table">
                                    <thead>
                                    <th>Name</th>
                                    <th>Identification Document</th>
                                    <th>Identification Number</th>
                                    <th>Contact</th>
                                    <th>Location</th>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><input type="text" class="w-100" name="guarantor_name" id="guarantor_name"></td>
                                        <td>
                                            <select name="guarantor_id_document" id="guarantor_id_document" class="w-100 form-control">
                                                <option value="">Select Identification Document</option>
                                                <option value="NATIONAL_ID">NATIONAL ID</option>
                                                <option value="PASSPORT">PASSPORT</option>
                                                <option value="MILITARY_ID">MILITARY ID</option>
                                            </select>
                                        </td>
                                        <td><input type="text" class="w-100" id="guarantor_id_number" name="guarantor_id_number"></td>
                                        <td><input type="text" class="w-100" name="guarantor_contact" id="guarantor_contact"></td>
                                        <td><input type="text" class="w-100" name="guarantor_location" id="guarantor_location"></td>
                                        <td><a href="#" class="fa fa-trash text-danger"></a></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="w-100 p-3 float-right col-12">
                                    <button class="btn btn-success float-right" type="button" onclick="addGuarantorRow()">Add</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4 float-right p-4">
                        <button class="btn btn-primary float-right">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <script src="{{asset('assets_/js/app.js')}}"></script>
@endsection
