<div class="modal fade view_loan_application" tabindex="-1" role="dialog" aria-labelledby="ViewLoanApplication" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Loan Application</h4>
                        <p class="category">
                            <div class="client_name"></div>
                            <div class="pull-right">
                                Loan Application:  #<span id="loan_application_id"></span>
                            </div>
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header card-header-info">
                                <h5 class="card-title">Personal Details</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Name</label><br>
                                        <span class="client_name"></span>
                                    </div>
                                    <div class="col-4">
                                        <label>Date of Birth</label><br>
                                        <span id="client_date_of_birth"></span>
                                    </div>
                                    <div class="col-4">
                                        <label>Contacts</label><br>
                                        <span id="client_primary_contact"></span>,
                                        <span id="client_alternative_contact"></span>
                                    </div>
                                </div>
                                <div class="row mt-2 pt-2">
                                    <div class="col-3">
                                        <label>Identification Document</label><br>
                                        <span id="client_identification_document"></span>
                                    </div>
                                    <div class="col-3">
                                        <label>Identification Number</label><br>
                                        <span id="client_identification_number"></span>
                                    </div>
                                    <div class="col-3">
                                        <label>Nationality</label><br>
                                        <span id="client_nationality"></span>
                                    </div>
                                    <div class="col-3">
                                        <label>Gender</label><br>
                                        <span id="client_gender"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header card-header-info">
                                <h5 class="card-title">Loan Details</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Product Name</label><br>
                                        <span id="product_name"></span>
                                    </div>
                                    <div class="col-4">
                                        <label>Product Code</label><br>
                                        <span id="product_code"></span>
                                    </div>
                                    <div class="col-4">
                                        <label>Rate %</label><br>
                                        <span id="product_rate"></span>
                                    </div>
                                </div>
                                <div class="row mt-2 pt-2">
                                    <div class="col-3">
                                        <label>Amount Applied</label><br>
                                        <span id="loan_amount_applied"></span>
                                    </div>
                                    <div class="col-3">
                                        <label>Amount Approved</label><br>
                                        <span id="loan_amount_approved"></span>
                                    </div>
                                    <div class="col-3">
                                        <label>Duration (Months)</label><br>
                                        <span id="loan_duration"></span>
                                    </div>
                                    <div class="col-3">
                                        <label>Total Interest</label><br>
                                        <span id="loan_total_interest"></span>
                                    </div>
                                </div>
                                <div class="row mt-2 pt-2">
                                    <div class="col-3">
                                        <label>Purpose</label><br>
                                        <span id="loan_purpose"></span>
                                    </div>
                                    <div class="col-3">
                                        <label>Approved On</label><br>
                                        <span id="loan_approval_date"></span>
                                    </div>
                                    <div class="col-3">
                                        <label>Disbursed On</label><br>
                                        <span id="loan_disbursement_date"></span>
                                    </div>
                                    <div class="col-3">
                                        <label>Due Date</label><br>
                                        <span id="loan_due_date"></span>
                                    </div>
                                </div>
                                <div class="row mt-2 pt-2">
                                    <h5>Charges</h5>
                                    <table class="table table-striped table primary">
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
                        <div class="card">
                            <div class="card-header card-header-info">
                                <h5 class="card-title">Repayment Details</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Repayment Frequency</label><br>
                                        <span id="loan_repayment_frequency"></span>
                                    </div>
                                </div>
                                <div class="row mt-2 pt-2">
                                    <div class="col-md-12 table-responsive table-condesed">
                                        <table class="table table-striped table-primary">
                                            <thead>
                                                <th>#</th>
                                                <th>Amount</th>
                                                <th>Date</th>
                                            </thead>
                                            <tbody id="loan_repayment_data">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header card-header-info">
                                <h5 class="card-title">Next of Kin Details</h5>
                            </div>
                            <div class="card-body">
                                <div class="table table-responsive table-condensed">
                                    <table class="table table-striped table-secondary">
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
                        <div class="card">
                            <div class="card-header card-header-info">
                                <h5 class="card-title">Collaterals Details</h5>
                            </div>
                            <div class="card-body">
                                <div class="table table-responsive table-condensed">
                                    <table class="table table-striped table-secondary">
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
                        <div class="card">
                            <div class="card-header card-header-info">
                                <h5 class="card-title">Guarantors Details</h5>
                            </div>
                            <div class="card-body">
                                <div class="table table-responsive table-condensed">
                                    <table class="table table-striped table-secondary">
                                        <thead>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Gender</th>
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
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-success" id="btn_approve"><i class="fa fa-check"></i> Approve </button>
                <button class="btn btn-primary" id="btn_disburse"><i class="fa fa-check"></i> Disburse </button>
                <button class=" btn btn-danger" id="btn_reject"><i class="flaticon-cancel"></i> Reject </button>
            </div>
        </div>
    </div>
</div>

