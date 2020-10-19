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
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="application_amount">Application Amount</label>
                                                <input type="text" name="application_amount" id="application_amount" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="application_duration">Duration in Months</label>
                                                <input type="number" id="application_duration" name="application_duration" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="loan_officer">Loan Officer</label>
                                                <select name="loan_officer" id="loan_officer" class="form-control">
                                                    <option value="">Select Loan Officer</option>
                                                </select>
                                            </div>
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
                                <table class="table table-sm table-striped">
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
                                            <td><input type="text" class="form-control-sm"></td>
                                            <td><input type="email" name="next_of_kin_email" id="next_of_kin_email" class="form-control-sm"></td>
                                            <td class="col-2">
                                                <select name="next_of_kin_gender" id="next_of_kin_gender" class="form-control">
                                                    <option value="">Select Gender</option>
                                                </select>
                                            </td>
                                            <td class="col-2">
                                                <select name="next_of_kin_document" id="next_of_kin_document" class="form-control">
                                                    <option value="">Select Identification Document</option>
                                                </select>
                                            </td>
                                            <td><input type="text" class="form-control-sm"></td>
                                            <td><input type="text" class="form-control-sm"></td>
                                            <td><input type="text" class="form-control-sm"></td>
                                            <td><input type="text" class="form-control-sm"></td>
                                            <td><input type="date" name="" id="" class="form-control-sm"></td>
                                            <td><textarea name="" id="" cols="30" rows="1"></textarea></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="w-100 p-3 float-right">
                                <button class="btn btn-success float-right">Add</button>
                            </div>
                        </div>
                    </div>
                    {{-- Collateral Details --}}
                    <div class="card">
                        <div class="card-header card-header-primary">Collaterals</div>
                        <div class="card-body">
                            <div class="table-responsive w-100">
                                <table class="table table-sm table-striped">
                                    <thead>
                                    <th>Type</th>
                                    <th>Details</th>
                                    <th>Value</th>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><input type="text" class="w-100"></td>
                                        <td><textarea name="" id="" class="w-100" rows="1"></textarea></td>
                                        <td><input type="text" class="w-100"></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="w-100 p-3 float-right">
                                    <button class="btn btn-success float-right">Add</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Guarantors Details --}}
                    <div class="card">
                        <div class="card-header card-header-primary">Guarantors</div>
                        <div class="card-body">
                            <div class="table-responsive w-100">
                                <table class="table table-sm table-striped">
                                    <thead>
                                    <th>Name</th>
                                    <th>Identification Document</th>
                                    <th>Identification Number</th>
                                    <th>Contact</th>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><input type="text" class="w-100"></td>
                                        <td><textarea name="" id="" class="w-100" rows="1"></textarea></td>
                                        <td><input type="text" class="w-100"></td>
                                        <td><input type="text" class="w-100"></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="w-100 p-3 float-right col-12">
                                    <button class="btn btn-success float-right">Add</button>
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
    <script src="{{asset('assets/js/app.js')}}"></script>
@endsection
