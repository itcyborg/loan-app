let current_loan_application = null;
let current_loan_duration = null;
let current_loan_amount = null;
let edit_endpoint = null;
let is_edit = false;
let user = null;
let product = null;
let resetEndPoint = window.location.protocol + '//' + window.location.hostname + '/users/actions';
let reports = window.location.protocol + '//' + window.location.hostname + '/reports/data';
let agentReports = window.location.protocol + '//' + window.location.hostname + '/reports/user';
let reportsDatatable;

function RestCalls(Myurl, error, f) {
    $.ajax({
        url: Myurl,
        method: "GET",
        headers: {"Accept": "application/json;"},
        async: true,
        success: function (data) {
            f(data)
        },
        error: function (data) {
            onError(data);
        }
    })
}

function postJson(endpointUri, payload, success = null, error = null) {
    $.ajax({
        url: endpointUri,
        type: "POST",
        data: JSON.stringify(payload),
        contentType: "application/json;",
        headers: {
            "Accept": "application/json;",
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            if (success) {
                success(data)
            } else {
                onSuccess(data);
            }
        },
        error: function (data) {
            if (error) {
                error(data);
            } else {
                onError(data);
            }
        }
    });
}

function updateJson(endpointUri, payload, success = null, error = null) {
    $.ajax({
        url: endpointUri,
        type: "PUT",
        data: JSON.stringify(payload),
        contentType: "application/json;",
        headers: {
            "Accept": "application/json;",
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            if (success) {
                success(data)
            } else {
                onSuccess(data);
            }
        },
        error: function (data) {
            if (error) {
                error(data);
            } else {
                onError(data);
            }
        }
    });
}

function onError(error) {
    alert(error.responseJSON.message)
    console.log(error);
}

function onSuccess(msg) {
    alert(msg);
}

function loadLoanApplications(url) {
    RestCalls(url, onError, loadLoanApplicationModal);
}

function loadLoanApplicationModal(loanData) {
    current_loan_application = loanData.id;
    current_loan_amount = loanData.amount_applied;
    current_loan_duration = loanData.duration;
    $('.client_name').text(loanData.client.name);
    // $('#loan_application_id').html(loanData.id);
    $('#loan_application_id').text(loanData.id);
    $('#client_date_of_birth').text(loanData.client.date_of_birth);
    $('#client_nationality').text(loanData.client.nationality);
    $('#client_primary_contact').text(loanData.client.primary_contact);
    $('#client_alternative_contact').text(loanData.client.alternative_contact);
    $('#client_identification_document').text(loanData.client.identification_document);
    $('#client_identification_number').text(loanData.client.identification_number);
    $('#client_gender').text(loanData.client.gender);
    $('#product_code').text(loanData.product.code);
    $('#product_name').text(loanData.product.name);
    $('#product_rate').text(loanData.product.rate);
    $('#loan_amount_applied').text('KES. '+Number(loanData.amount_applied).toFixed(2));
    $('#loan_amount_approved').text('KES. '+Number(loanData.amount_approved).toFixed(2));
    $('#loan_duration').text(loanData.duration);
    $('#loan_due_date').text(loanData.due_date);
    $('#loan_purpose').text(loanData.purpose);
    $('#loan_approval_date').text(loanData.approval_date);
    $('#loan_disbursement_date').text(loanData.disbursement_date);
    $('#loan_total_interest').text('KES. '+Number(loanData.total_interest).toFixed(2));
    $('#loan_repayment_frequency').text(loanData.repayment_frequency);
    $('#loan_repayment_data').html(generateRepaymentTableData(loanData.repayments))
    $('#collaterals_data').html(generateCollateralsTableData(loanData.collaterals))
    $('#next_of_kin_data').html(generateNextOfKinTableData(loanData.nextofkins))
    $('#guarantors_data').html(generateGuarantorsTableData(loanData.guarantors))
    $('#charges_data').html(generateChargesTableData(loanData.charges_config))
    $('#referees_data').html(generateRefereesTableData(loanData.referees))
    $('#loan_disbursment_channel').text(loanData.channel);
    $('#loan_disbursement_account').text(loanData.account);
    $('#loan_disbursement_amount').text('KES. '+Number(loanData.disbursed_amount).toLocaleString());
    $('#repaymentCardData').hide();
    $('#repayment_alert').show();
    if (loanData.status === 'PENDING') {
        $('#btn_disburse').hide();
        $('#row_disbursement_details').hide();
        $('#btn_reject').show();
        $('#btn_approve').show();
    }
    if (loanData.status === 'APPROVED') {
        console.log(loanData);
        $('#btn_approve').hide();
        $('#btn_reject').hide();
        $('#btn_disburse').show();
        $('#row_disbursement_details').show();
    }
    if (loanData.status === 'REJECTED') {
        $('#row_disbursement_details').hide();
        $('#btn_disburse').hide();
        $('#btn_approve').hide();
        $('#btn_reject').hide();
    }
    if (loanData.status === 'DISBURSED') {
        $('#row_disbursement_details').hide();
        $('#btn_disburse').hide();
        $('#btn_approve').hide();
        $('#btn_reject').hide();
        $('#repaymentCardData').show();
        $('#repayment_alert').hide();
    }
    $('.view_loan_application').modal('show');
}

function generateRepaymentTableData(repayment_data) {
    var data = null;
    $.each(repayment_data, function (k, v) {
        let default_amount = 0;
        if (v.amount_default < 0) {
            default_amount = v.amount_default * (-1) + ' (Overpayment)';
        } else {
            default_amount = v.amount_default;
        }
        data += "<tr><td>" + v.id + "</td><td>" + v.due_date + "</td><td>" + v.amount + "</td><td>" + v.amount_paid + "</td><td>" + default_amount + "</td><td>" + v.penalty + "</td></tr>"
    })
    return data;
}

function generateCollateralsTableData(collaterals_data) {
    var data = null;
    $.each(collaterals_data, function (k, v) {
        data += "<tr><td>" + v.id + "</td><td>" + v.type + "</td><td>" + v.details + "</td><td>" + v.value + "</td></tr>"
    })
    return data;
}

function generateNextOfKinTableData(next_of_kin_data) {
    var data = null;
    $.each(next_of_kin_data, function (k, v) {
        data += "<tr><td>" + v.id + "</td><td>" + v.name + "</td><td>" + v.gender + "</td><td>" + v.relation + "</td><td>" + v.primary_contact + "," + v.alternative_contact + "</td><td>" + v.identification_document + "</td><td>" + v.identification_number + "</td></tr>"
    })
    return data;
}

function generateGuarantorsTableData(next_of_kin_data) {
    var data = null;
    $.each(next_of_kin_data, function (k, v) {
        data += "<tr><td>" + v.id + "</td><td>" + v.name + "</td><td>" + v.contact + "</td><td>" + v.identification_document + "</td><td>" + v.identification_number + "</td></tr>"
    })
    return data;
}

function generateRefereesTableData(referees_data) {
    var data = null;
    $.each(referees_data, function (k, v) {
        data += "<tr><td>" + v.id + "</td><td>" + v.name + "</td><td>" + v.nationality + "</td><td>" + v.contact + "</td><td>" + v.alternate_contact + "</td><td>" + v.location + "</td></tr>";
    });
    return data;
}

function generateChargesTableData(charges_data) {
    var data = null;
    $.each(charges_data, function (k, v) {
        data += "<tr><td>" + v.id + "</td><td>" + v.name + "</td><td>" + v.amount + "</td><td>" + v.type + "</td></tr>"
    })
    return data;
}

function loanAction(endpoint, action) {
    if (current_loan_application == null) {
        alert('An error occurred trying to select the current loan application.');
    }
    let payload = {
        'id': current_loan_application,
        'action': action
    }
    if (action == 'approve') {
        let approved_amount = prompt("Please enter approved loan amount:", current_loan_amount);
        let approved_duration = current_loan_duration;
        if (approved_amount > 0) {
            approved_duration = prompt("Please enter duration:", current_loan_duration);
        } else {
            return alert('Approval cancelled');
        }
        if (approved_duration < 1) {
            return alert('Duration has to be 1 or greater than 1');
        }
        payload = {
            'id': current_loan_application,
            'action': action,
            'approved_amount': approved_amount,
            'duration': approved_duration
        }

        postJson(endpoint, payload, function(){
            Swal.fire({
                title: "Disbursement Successful",
                icon:"success"
            })
        });
    }
    if (action == 'disburse') {
        let channel = '';
        let acc_no = '';
        const {value: formValues} = Swal.fire({
            title: 'Add Disbursement Information',
            html:
                '<select name="disbursement_channel" id="disbursement_channel" class="form-control swal2-input">' +
                '    <option value="">Select Disbursement Channel</option>' +
                '    <option value="mobile">Mobile</option>' +
                '    <option value="cheque">Cheque</option>' +
                '    <option value="bank">Bank</option>' +
                '    <option value="cash">Cash</option>' +
                '    <option value="rtgs">RTGS</option>' +
                '</select>' +
                '<input type="text" class="form-control swal2-input" name="acc_details" id="acc_details" placeholder="Account Details">',
            focusConfirm: false,
            preConfirm: () => {
                channel = document.getElementById('disbursement_channel').value;
                acc_no = document.getElementById('acc_details').value;

                if (channel !== '' && acc_no !== '') {
                    payload = {
                        id: current_loan_application,
                        action: action,
                        channel: channel,
                        account: acc_no
                    }
                    postJson(endpoint, payload, function(){
                        Swal.fire({
                            title: "Disbursement Successful",
                            icon:"success"
                        })
                    });
                } else {
                    return Swal.fire({
                        title: "An error occurred. Please check the disbursement details and try again.",
                        icon:"error"
                    });
                }
            }
        })
    }
}

function loadUser(uri, edit = false, endpoint = null) {
    edit_endpoint = endpoint;
    is_edit = edit;
    RestCalls(uri, onError, loadUserModal);
}

function loadUserModal(data) {
    user = data.user.id;
    $('#edit').hide();
    $('#name').val(data.user.name).attr('readonly', true);
    $('#email').val(data.user.email).attr('readonly', true);
    let options = '';
    $.each(data.roles, function (k, v) {
        options += '<option value="' + v.id + '">' + v.name + '</option>';
    });
    $('#role').html(options).attr('readonly', true);
    $('#role').val(data.user.roles[0].id);
    if (is_edit) {
        $('#edit').show();
        $('#name,#email,#role').attr('readonly', false);
    }
    $('.view_user').modal('show');
}

function updateUser(uri) {
    postJson(uri + '/' + user, {
        'name': $('#name').val(),
        'email': $('#email').val(),
        'role': $('#role').val(),
        '_method': 'PUT'
    });
}

function loadProduct(uri, edit = false, endpoint = null) {
    edit_endpoint = endpoint;
    is_edit = edit;
    RestCalls(uri, onError, loadProductModal);
}

function loadProductModal(data) {
    product = data.id;
    $('#edit').hide();
    $('.view_product #name').val(data.name).attr('readonly', true);
    $('.view_product #code').val(data.code).attr('readonly', true);
    $('.view_product #min_amount').val(data.min_amount).attr('readonly', true);
    $('.view_product #max_amount').val(data.max_amount).attr('readonly', true);
    $('.view_product #min_duration').val(data.min_duration).attr('readonly', true);
    $('.view_product #max_duration').val(data.max_duration).attr('readonly', true);
    $('.view_product #security').val(data.security).attr('readonly', true);
    $('.view_product #status').val(data.status).attr('readonly', true);
    $('.view_product #rate').val(data.rate).attr('readonly', true);
    if (data.status == 'ACTIVE') {
        $('#deactivate').show();
        $('#activate').hide();
    } else {
        $('#deactivate').hide();
        $('#activate').show();
    }
    if (is_edit) {
        $('#edit').show();
        $('.view_product #name,.view_product #code,.view_product #min_duration,.view_product #min_amount,.view_product #max_duration,.view_product #max_amount,.view_product #status,.view_product #rate,.view_product #security').attr('readonly', false);
    }
    $('.view_product').modal('show');
}

function updateProduct(endpoint) {
    let payload = {
        'id': product,
        'name': $('.view_product #name').val(),
        'code': $('.view_product #code').val(),
        'min_amount': $('.view_product #min_amount').val(),
        'max_amount': $('.view_product #max_amount').val(),
        'min_duration': $('.view_product #min_duration').val(),
        'max_duration': $('.view_product #max_duration').val(),
        'security': $('.view_product #security').val(),
        'rate': $('.view_product #rate').val()
    }
    updateJson(endpoint + '/' + payload.id, payload, function (data) {
        alert(data)
        console.log(data)
    }, onError)
}

function activateProduct(endpoint, action) {
    postJson(endpoint, {'id': product, 'action': action}, onSuccess, onError);
}

function resetPassword() {
    if (confirm('Are you sure?')) {
        //reset account password
        postJson(resetEndPoint, {
            'id': user,
            'action': 'reset_password'
        }, function (data) {
            alert(data.message)
        });
    }
}

function loadReports() {
    RestCalls(reports, function (data) {
    }, function (data) {
        let disbursement = data.disbursement;
        let interest = data.interest;
        let principals = data.principals;
        let expenses = data.expense;
        let incomes = data.income;
        let charges = data.charges;
        let repayments = data.repayments;

        let dis_rows = '';
        let chg_rows = '';
        let principals_rows = '';
        let interest_rows = '';
        let expense_rows = '';
        let income_rows = '';
        let repayment_rows = '';
        $.each(charges, function (k, v) {
            chg_rows += '' +
                '<tr>' +
                '<td>' + (++k) + '</td>' +
                '<td>' + v.product.name + '</td>' +
                '<td>' + v.charge_name + '</td>' +
                '<td>' + v.amount + '</td>' +
                '</tr>';
        });
        $.each(disbursement, function (k, v) {
            dis_rows += '' +
                '<tr>' +
                '<td>' + (++k) + '</td>' +
                '<td>' + v.product.name + '</td>' +
                '<td>' + v.amount_applied_sum + '</td>' +
                '<td>' + v.amount_approved_sum + '</td>' +
                '</tr>';
        });
        $('#tbl_disbursement tbody').html(dis_rows);
        $.each(interest, function (k, v) {
            interest_rows += '' +
                '<tr>' +
                '<td>' + (++k) + '</td>' +
                '<td>' + v.product.name + '</td>' +
                '<td>' + v.total_interest + '</td>' +
                '</tr>';
        });
        $('#tbl_interest tbody').html(interest_rows);
        $.each(principals, function (k, v) {
            principals_rows += '' +
                '<tr>' +
                '<td>' + (++k) + '</td>' +
                '<td>' + v.product.name + '</td>' +
                '<td>' + v.amount_applied_sum + '</td>' +
                '<td>' + v.amount_approved_sum + '</td>' +
                '</tr>';
        });
        $.each(incomes, function (k, v) {
            income_rows += '' +
                '<tr>' +
                '<td>' + (++k) + '</td>' +
                '<td>' + v.user.name + '</td>' +
                '<td>' + v.type + '</td>' +
                '<td>' + v.amount + '</td>' +
                '<td>' + v.comment + '</td>' +
                '</tr>';
        })
        $('#tbl_income tbody').html(income_rows);
        $.each(expenses, function (k, v) {
            expense_rows += '' +
                '<tr>' +
                '<td>' + (++k) + '</td>' +
                '<td>' + v.user.name + '</td>' +
                '<td>' + v.type + '</td>' +
                '<td>' + v.amount + '</td>' +
                '<td>' + v.comment + '</td>' +
                '</tr>';
        })
        $.each(repayments, function (k, v) {
            repayment_rows += '' +
                '<tr>' +
                '<td>' + (++k) + '</td>' +
                '<td>' + v.product.name + '</td>' +
                '<td>' + v.client.name + '</td>' +
                '<td>' + v.amount_default + '</td>' +
                '<td>' + parseInt(v.penalty) + '</td>' +
                '<td>' + v.amount_paid + '</td>' +
                '</tr>';
        });
        $('#tbl_expense tbody').html(expense_rows);
        $('#tbl_charges tbody').html(chg_rows);
        $('#tbl_principal tbody').html(principals_rows);
        $('#tbl_repayments tbody').html(repayment_rows);
        $('#tbl_income,#tbl_expense').DataTable(
            {
                responsive: true,
                width: '100%',
                dom: 'Bfrtip',
                buttons: false,
                rowGroup: {
                    startRender: null,
                    endRender: function (rows, group) {
                        var amountSum = rows
                            .data()
                            .pluck(3)
                            .reduce(function (a, b) {
                                return a + b.replace(/[^\d]/g, '') * 1;
                            }, 0);
                        amountSum = $.fn.dataTable.render.number(',', '.', 0, 'KES. ').display(amountSum);

                        return $('<tr/>')
                            .append('<td class="bg-light" colspan="3"><b>Sum for ' + group + '<b/></td>')
                            .append('<td class="bg-light" ><b>' + amountSum + '</b></td>')
                            .append('<td class="bg-light" />');
                    },
                    dataSrc: [1, 2]
                }
            }
        );
        $('#tbl_charges').DataTable(
            {
                responsive: true,
                width: '100%',
                dom: 'Bfrtip',
                buttons: true,
                rowGroup: {
                    startRender: null,
                    endRender: function (rows, group) {
                        var amountSum = rows
                            .data()
                            .pluck(3)
                            .reduce(function (a, b) {
                                return a + b.replace(/[^\d]/g, '') * 1;
                            }, 0);
                        amountSum = $.fn.dataTable.render.number(',', '.', 0, 'KES. ').display(amountSum);

                        return $('<tr/>')
                            .append('<td class="bg-light" colspan="3"><b>Sum for ' + group + '<b/></td>')
                            .append('<td class="bg-light" ><b>' + amountSum + '</b></td>')
                            .append('<td class="bg-light" />');
                    },
                    dataSrc: [1, 2]
                }
            }
        );
        $('#tbl_repayments').DataTable(
            {
                responsive: true,
                width: '100%',
                dom: 'Bfrtip',
                buttons: true,
                rowGroup: {
                    startRender: null,
                    endRender: function (rows, group) {
                        var amountSum = rows
                            .data()
                            .pluck(3)
                            .reduce(function (a, b) {
                                return a + b.replace(/[^\d]/g, '') * 1;
                            }, 0);
                        amountSum = $.fn.dataTable.render.number(',', '.', 2, 'KES. ').display(amountSum);
                        var penaltySum = rows
                            .data()
                            .pluck(4)
                            .reduce(function (a, b) {
                                return a + b.replace(/[^\d]/g, '') * 1;
                            }, 0);
                        penaltySum = $.fn.dataTable.render.number(',', '.', 2, 'KES. ').display(penaltySum);
                        var paidSum = rows
                            .data()
                            .pluck(5)
                            .reduce(function (a, b) {
                                return a + b.replace(/[^\d]/g, '') * 1;
                            }, 0);
                        paidSum = $.fn.dataTable.render.number(',', '.', 0, 'KES. ').display(paidSum);

                        return $('<tr/>')
                            .append('<td class="bg-light" colspan="3"><b>Sum for ' + group + '<b/></td>')
                            .append('<td class="bg-light" ><b>' + amountSum + '</b></td>')
                            .append('<td class="bg-light" ><b>' + penaltySum + '</b></td>')
                            .append('<td class="bg-light" ><b>' + paidSum + '</b></td>')
                            .append('<td class="bg-light" />');
                    },
                    dataSrc: [1, 2]
                }
            }
        );
    });
}

function loadAgentReport() {
    RestCalls(agentReports, function (data) {
    }, function (data) {
        data = JSON.parse(data);
        let loan_officers = data.loan_officers;
        let products = data.products;
        let agents = data.agents;
        let rows = '';
        data = data.reports;
        $.each(data, function (key, datum) {
            let officer = datum.officer;
            if (typeof datum.officer == 'object' && datum.officer !== null) {
                officer = datum.officer.name;
            }
            rows += '<tr>' +
                '<td>' + (++key) + '</td>' +
                '<td>' + datum.product.name + '</td>' +
                '<td>' + datum.user.name + '</td>' +
                '<td>' + officer + '</td>' +
                '<td>' + datum.id + '</td>' +
                '<td>' + datum.amount_applied + '</td>' +
                '<td>' + datum.amount_approved + '</td>' +
                '<td>' + datum.total_interest + '</td>' +
                '<td>' + datum.status + '</td>' +
                '</tr>';
        });
        $('#tbl_reports_all tbody').html(rows);
        reportsDatatable = $('#tbl_reports_all').DataTable({
            responsive: true,
            width: '100%',
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'pdf', 'print'
            ]
        });
        let products_row = '<option value="">All</option>';
        let agents_row = '<option value="">All</option>';
        let loan_officers_row = '<option value="">All</option>';
        $.each(products, function (k, v) {
            products_row += '<option value="' + v.name + '">' + v.name + '</option>';
        });
        $.each(agents, function (k, v) {
            agents_row += '<option value="' + v.name + '">' + v.name + '</option>';
        });
        $.each(loan_officers, function (k, v) {
            loan_officers_row += '<option value="' + v.name + '">' + v.name + '</option>';
        });
        $('#product_name').html(products_row);
        $('#agent').html(agents_row);
        $('#loan_officer').html(loan_officers_row);
    });
}

function printElement(elem) {
    var domClone = elem.cloneNode(true);

    var $printSection = document.getElementById("printSection");

    if (!$printSection) {
        var $printSection = document.createElement("div");
        $printSection.id = "printSection";
        document.body.appendChild($printSection);
    }

    $printSection.innerHTML = "";

    $printSection.appendChild(domClone);
}
