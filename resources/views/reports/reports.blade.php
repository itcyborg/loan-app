@extends('layouts.app')
@section('title')
    Reports
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.23/b-1.6.5/b-html5-1.6.5/b-print-1.6.5/r-2.2.6/sb-1.0.1/sp-1.2.2/datatables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/rowgroup/1.1.2/css/rowGroup.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
    <style>
        tr.odd td:first-child,
        tr.even td:first-child {
            padding-left: 4em;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <div class="card-title">Reports</div>
                </div>
                <div class="card-body">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a href="#pills-all" id="pills-all-tab" data-toggle="pill" role="tab"  class="nav-link active" aria-controls="pills-all" aria-selected="true">
                                All Reports
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Principal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Interest</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Disbursements</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-income-tab" data-toggle="pill" href="#pills-income" role="tab" aria-controls="pills-income" aria-selected="false">Income</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-expense-tab" data-toggle="pill" href="#pills-expense" role="tab" aria-controls="pills-expense" aria-selected="false">Expense</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-charges-tab" data-toggle="pill" href="#pills-charges" role="tab" aria-controls="pills-charges" aria-selected="false">Charges</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab">
                            <div class="row mb-3 pl-2 pr-2">
                                <div class="card m-2">
                                    <div class="card-body bg-rose">
                                        <div class="row">
                                            <h3>Filter</h3>
                                        </div>
                                        <div class="row">
                                            <div class="col-3">
                                                <label for="product_name">Product</label>
                                                <select name="product_name" id="product_name" class="form-control">
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <label for="agent">Agent</label>
                                                <select name="agent" id="agent" class="form-control"></select>
                                            </div>
                                            <div class="col-3">
                                                <label for="loan_officer">Loan Officer</label>
                                                <select name="loan_officer" id="loan_officer" class="form-control"></select>
                                            </div>
                                            <div class="col-3">
                                                <label for="status">Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="">ALL</option>
                                                    <option value="PENDING">PENDING</option>
                                                    <option value="DISBURSED">DISBURSED</option>
                                                    <option value="APPROVED">APPROVED</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row p-5">
                                <div class="table-responsive w-100 p-5">
                                    <table class="table table-striped w-100" id="tbl_reports_all" style="width:100%">
                                        <thead class="thead-dark">
                                            <th>#</th>
                                            <th>Product</th>
                                            <th>Agent</th>
                                            <th>Loan Officer</th>
                                            <th>Application ID</th>
                                            <th>Amount Applied</th>
                                            <th>Amount Approved</th>
                                            <th>Interest</th>
                                            <th>Status</th>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="row">
                                <div class="table-responsive w-100 p-5">
                                    <table class="table table-responsive" id="tbl_principal">
                                        <thead class="thead-dark">
                                            <th>#</th>
                                            <th>Product</th>
                                            <th>Amount Applied</th>
                                            <th>Amount Approved</th>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="row">
                                <div class="table-responsive w-100 p-5">
                                    <table class="table table-responsive w-100" id="tbl_interest">
                                        <thead class="thead-dark">
                                        <th>#</th>
                                        <th>Product</th>
                                        <th>Total Interest</th>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div class="row">
                                <div class="table-responsive w-100 p-5">
                                    <table class="table table-responsive w-100 table-striped" id="tbl_disbursement">
                                        <thead class="thead-dark">
                                            <th>#</th>
                                            <th>Product</th>
                                            <th>Amount Applied</th>
                                            <th>Amount Approved</th>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-income" role="tabpanel" aria-labelledby="pills-income-tab">
                            <div class="row">
                                <div class="table-responsive w-100 p-5">
                                    <table class="table w-100 table-striped" id="tbl_income">
                                        <thead class="thead-dark">
                                            <th>#</th>
                                            <th>Agent Name</th>
                                            <th>Type</th>
                                            <th>Amount</th>
                                            <th>Comment</th>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-expense" role="tabpanel" aria-labelledby="pills-expense-tab">
                            <div class="row">
                                <div class="table-responsive w-100 p-5">
                                    <table class="table table-responsible w-100 table-striped" id="tbl_expense">
                                        <thead class="thead-dark">
                                            <th>#</th>
                                            <th>Agent Name</th>
                                            <th>Type</th>
                                            <th>Amount</th>
                                            <th>Comment</th>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-charges" role="tabpanel" aria-labelledby="pills-charges-tab">
                            <div class="row">
                                <div class="alert alert alert-info w-100 m-5">
                                    This data is refreshed every 6 hrs.
                                </div>
                                <div class="table-responsive w-100 p-5">
                                    <table class="table table-responsible w-100 table-striped" id="tbl_charges">
                                        <thead class="thead-dark">
                                        <th>#</th>
                                        <th>Product Id</th>
                                        <th>Charge Name</th>
                                        <th>Amount</th>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.23/b-1.6.5/b-html5-1.6.5/b-print-1.6.5/r-2.2.6/sb-1.0.1/sp-1.2.2/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/rowgroup/1.1.2/js/dataTables.rowGroup.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>

<script>
        $(document).ready(function(){
            setTimeout(function(){
                loadReports();
                loadAgentReport();
            },100);
            $('#status,#product_name,#agent,#loan_officer').on('change',function(){
                reportsDatatable.draw();
            });
        });
        $.fn.dataTable.ext.search.push(
            function( settings, data, dataIndex ) {
                if (settings.nTable.id != "tbl_reports_all") return true;
                if($('#status').val()==""){
                    return true;
                }
                status=$('#status').val();
                d=data[8];
                if(status==null){
                    return true;
                }
                if(status.indexOf(d) !== -1){
                    return true;
                }
                return false;
            }
        );
        $.fn.dataTable.ext.search.push(
            function( settings, data, dataIndex ) {
                if (settings.nTable.id != "tbl_reports_all") return true;
                if($('#product_name').val()==""){
                    return true;
                }
                product=$('#product_name').val();
                d=data[1];
                if(product==null){
                    return true;
                }
                if(product.indexOf(d) !== -1){
                    return true;
                }
                return false;
            }
        );
        $.fn.dataTable.ext.search.push(
            function( settings, data, dataIndex ) {
                if (settings.nTable.id != "tbl_reports_all") return true;
                if($('#agent').val()==""){
                    return true;
                }
                agent=$('#agent').val();
                d=data[2];
                if(agent==null){
                    return true;
                }
                if(agent.indexOf(d) !== -1){
                    return true;
                }
                return false;
            }
        );
        $.fn.dataTable.ext.search.push(
            function( settings, data, dataIndex ) {
                if (settings.nTable.id != "tbl_reports_all") return true;
                if($('#loan_officer').val()==""){
                    return true;
                }
                loan_officer=$('#loan_officer').val();
                d=data[3];
                if(loan_officer==null){
                    return true;
                }
                if(loan_officer.indexOf(d) !== -1){
                    return true;
                }
                return false;
            }
        );
    </script>
@endsection
