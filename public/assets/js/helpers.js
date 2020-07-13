let current_loan_application=null;
let current_loan_amount=null;
let edit_endpoint=null;
let is_edit=false;
let user=null;
let resetEndPoint=window.location.protocol+'//'+window.location.hostname+'/users/actions';

function RestCalls(Myurl, error, f) {
    $.ajax({
        url: Myurl,
        method: "GET",
        headers: {"Accept": "application/json;"},
        async:true,
        success: function (data) {
            f(data)
        },
        error: function (data) {
            onError(data);
        }
    })
}

function postJson(endpointUri, payload,success=null,error=null) {
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
            if(success){
                success(data)
            }else {
                onSuccess(data);
            }
        },
        error: function (data) {
            if(error){
                error(data);
            }else{
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

function loadLoanApplications(url){
    console.log(RestCalls(url,onError,loadLoanApplicationModal));
}

function loadLoanApplicationModal(loanData) {
    current_loan_application=loanData.id;
    current_loan_amount=loanData.amount_applied;
    $('.client_name').text(loanData.client.name);
    $('#loan_application_id').html(loanData.id);
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
    $('#loan_amount_applied').text(loanData.amount_applied);
    $('#loan_amount_approved').text(loanData.amount_approved);
    $('#loan_duration').text(loanData.duration);
    $('#loan_due_date').text(loanData.due_date);
    $('#loan_purpose').text(loanData.purpose);
    $('#loan_approval_date').text(loanData.approval_date);
    $('#loan_disbursement_date').text(loanData.disbursement_date);
    $('#loan_total_interest').text(loanData.total_interest);
    $('#loan_repayment_frequency').text(loanData.repayment_frequency);
    $('#loan_repayment_data').html(generateRepaymentTableData(loanData.repayments))
    $('#collaterals_data').html(generateCollateralsTableData(loanData.collaterals))
    $('#next_of_kin_data').html(generateNextOfKinTableData(loanData.nextofkins))
    $('#guarantors_data').html(generateGuarantorsTableData(loanData.guarantors))
    $('#charges_data').html(generateChargesTableData(loanData.charges))
    if(loanData.status==='PENDING'){
        $('#btn_disburse').hide();
        $('#btn_reject').show();
        $('#btn_approve').show();
    }
    if(loanData.status==='APPROVED'){
        $('#btn_approve').hide();
        $('#btn_reject').hide();
        $('#btn_disburse').show();
    }
    if(loanData.status==='REJECTED'){
        $('#btn_disburse').hide();
        $('#btn_approve').hide();
        $('#btn_reject').hide();
    }
    if(loanData.status==='DISBURSED'){
        $('#btn_disburse').hide();
        $('#btn_approve').hide();
        $('#btn_reject').hide();
    }
    $('.view_loan_application').modal('show');
}

function generateRepaymentTableData(repayment_data){
    var data=null;
    $.each(repayment_data,function(k,v){
        data+="<tr><td>"+v.id+"</td><td>"+v.amount+"</td><td>"+v.created_at+"</td></tr>"
    })
    return data;
}
function generateCollateralsTableData(collaterals_data){
    var data=null;
    $.each(collaterals_data,function(k,v){
        data+="<tr><td>"+v.id+"</td><td>"+v.type+"</td><td>"+v.details+"</td><td>"+v.value+"</td></tr>"
    })
    return data;
}
function generateNextOfKinTableData(next_of_kin_data){
    var data=null;
    $.each(next_of_kin_data,function(k,v){
        data+="<tr><td>"+v.id+"</td><td>"+v.name+"</td><td>"+v.gender+"</td><td>"+v.relation+"</td><td>"+v.primary_contact+","+v.alternative_contact+"</td><td>"+v.identification_document+"</td><td>"+v.identification_number+"</td></tr>"
    })
    return data;
}
function generateGuarantorsTableData(next_of_kin_data){
    var data=null;
    $.each(next_of_kin_data,function(k,v){
        data+="<tr><td>"+v.id+"</td><td>"+v.name+"</td><td>"+v.gender+"</td><td>"+v.primary_contact+","+v.alternative_contact+"</td><td>"+v.identification_document+"</td><td>"+v.identification_number+"</td></tr>"
    })
    return data;
}

function generateChargesTableData(charges_data){
    var data=null;
    $.each(charges_data,function(k,v){
        data+="<tr><td>"+v.id+"</td><td>"+v.name+"</td><td>"+v.amount+"</td><td>"+v.type+"</td></tr>"
    })
    return data;
}

function loanAction(endpoint,action) {
    if(current_loan_application==null){
        alert('An error occurred trying to select the current loan application.');
    }
    let payload={
        'id':current_loan_application,
        'action':action
    }
    if(action=='approve'){
        let approved_amount = prompt("Please enter approved loan amount:", current_loan_amount);
        payload={
            'id':current_loan_application,
            'action':action,
            'approved_amount':approved_amount
        }
    }
    postJson(endpoint,payload);
}

function loadUser(uri,edit=false,endpoint=null) {
    edit_endpoint=endpoint;
    is_edit=edit;
   RestCalls(uri,onError,loadUserModal);
}
function loadUserModal(data) {
    user=data.user.id;
    $('#edit').hide();
    $('#name').val(data.user.name).attr('readonly',true);
    $('#email').val(data.user.email).attr('readonly',true);
    let options='';
    $.each(data.roles,function(k,v){
        options+='<option value="'+v.id+'">'+v.name+'</option>';
    });
    $('#role').html(options).attr('readonly',true);
    console.log(data.user.roles[0].id);
    $('#role').val(data.user.roles[0].id);
    if(is_edit){
        $('#edit').show();
        $('#name,#email,#role').attr('readonly',false);
    }
    $('.view_user').modal('show');
}
function updateUser(uri){
    postJson(uri+'/'+user,{
        'name':$('#name').val(),
        'email':$('#email').val(),
        'role':$('#role').val(),
        '_method':'PUT'
    });
}

function resetPassword() {
    if(confirm('Are you sure?')){
        //reset account password
        postJson(resetEndPoint,{
            'id':user,
            'action':'reset_password'
        },function(data){
            alert(data.message)
        });
    }
}
