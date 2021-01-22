<div class="modal fade view_loan_application" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="col-12 ml-4 w-100">
                <button class="btn btn-outline-primary" onclick="PrintElements.print(document.getElementsByClassName('printable'))"><i class="fa fa-print"></i> Print</button>
            </div>
            <div class="container-fluid p-3 printable" id="printable">
                {{-- Client Details--}}
                <div class="row m-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title font-weight-bold">Personal Information</div>
                            <div class="card-text">
                                <div class="row p-2">
                                    <table class="table table-borderless table-full-width">
                                        <tbody>
                                        <tr>
                                            <td class="font-weight-bold">Name</td>
                                            <td class="client_name"></td>
                                            <td class="font-weight-bold">ID Document Type</td>
                                            <td id="client_identification_document"></td>
                                            <td class="font-weight-bold">ID Number</td>
                                            <td id="client_identification_number"></td>
                                            <td class="font-weight-bold">Nationality</td>
                                            <td id="client_nationality"></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Date of Birth</td>
                                            <td id="client_date_of_birth"></td>
                                            <td class="font-weight-bold">Gender</td>
                                            <td id="client_gender"></td>
                                            <td class="font-weight-bold"></td>
                                            <td></td>
                                            <td class="font-weight-bold"></td>
                                            <td></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Loan Details -->
                <div class="row m-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title font-weight-bold">Loan Details</div>
                            <div class="card-text">
                                <table class="table table-borderless table-full-width">
                                    <tbody>
                                    <tr>
                                        <td class="font-weight-bold">Product Name</td>
                                        <td id="product_name"></td>
                                        <td class="font-weight-bold">Product Code</td>
                                        <td id="product_code"></td>
                                        <td class="font-weight-bold">Rate</td>
                                        <td id="product_rate"></td>
                                        <td class="font-weight-bold">Amount Applied</td>
                                        <td id="loan_amount_applied"></td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Amount Approved</td>
                                        <td id="loan_amount_approved"></td>
                                        <td class="font-weight-bold">Duration</td>
                                        <td id="loan_duration"></td>
                                        <td class="font-weight-bold">Total Interest</td>
                                        <td id="loan_total_interest"></td>
                                        <td class="font-weight-bold">Purpose</td>
                                        <td id="loan_purpose"></td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Approved Date</td>
                                        <td id="loan_approval_date"></td>
                                        <td class="font-weight-bold">Approved By</td>
                                        <td id="loan_approved_by"></td>
                                        <td class="font-weight-bold">Disbursement Date</td>
                                        <td id="loan_disbursement_date"></td>
                                        <td class="font-weight-bold">Due Date</td>
                                        <td id="loan_due_date"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charges -->
                <div class="row m-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title font-weight-bold">Charges</div>
                            <div class="card-text">
                                <table class="table table-borderless table-full-width">
                                    <thead>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Type</th>
                                    </thead>
                                    <tbody id="charges_data">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Next of Kin -->
                <div class="row m-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title font-weight-bold">Next of Kin</div>
                            <div class="card-text">
                                <table class="table table-borderless table-full-width">
                                    <thead>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Relation</th>
                                    <th>Contact</th>
                                    <th>Identification Document</th>
                                    <th>Identification Number</th>
                                    </thead>
                                    <tbody id="next_of_kin_data">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Guarantors -->
                <div class="row m-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title font-weight-bold">Guarantors</div>
                            <div class="card-text">
                                <table class="table table-borderless table-full-width">
                                    <thead>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Contact</th>
                                    <th>Identification Document</th>
                                    <th>Identification Number</th>
                                    </thead>
                                    <tbody id="guarantors_data">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Referees -->
                <div class="row m-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title font-weight-bold">Referees Details</div>
                            <div class="card-text">
                                <table class="table table-borderless table-full-width">
                                    <thead>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Nationality</th>
                                    <th>Contact</th>
                                    <th>Alternate Contact</th>
                                    <th>Location</th>
                                    </thead>
                                    <tbody id="referees_data">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Collaterals -->
                <div class="row m-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title font-weight-bold">Collateral</div>
                            <div class="card-text">
                                <table class="table table-borderless table-full-width">
                                    <thead>
                                    <th>#</th>
                                    <th>Type</th>
                                    <th>Details</th>
                                    <th>Value</th>
                                    </thead>
                                    <tbody id="collaterals_data">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                @role('superadministrator')
                <button class="btn btn-success" id="btn_approve"
                        onclick='loanAction("{{route('loan-applications.action')}}","approve")'>
                    <i class="fa fa-check"></i> Approve
                </button>
                <button class="btn btn-success" id="btn_disburse"
                        onclick='loanAction("{{route('loan-applications.action')}}","disburse")'>
                    <i class="fa fa-check"></i> Disburse
                </button>
                <button class="btn btn-danger" id="btn_reject"
                        onclick='loanAction("{{route('loan-applications.action')}}","reject")'>
                    <i class="flaticon-cancel"></i> Reject
                </button>
                @endrole
            </div>
        </div>
    </div>
</div>
