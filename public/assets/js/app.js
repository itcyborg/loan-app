let origin=window.location.origin+'/';
let paths={
    client_info:origin+'clientinfo',
    product_info:origin+'productinfo'
}

$(document).ready(function(){
    $('#client_name').select2();
    $('#product_name').select2();

    $('#client_name').on('select2:select',function (event){
        let id=$(this).find(':selected')[0].getAttribute('value');
        getClientInfo(id);
    });
    $('#product_name').on('select2:select',function (event){
        let id=$(this).find(':selected')[0].getAttribute('value');
        let code= $(this).find(':selected')[0].getAttribute('data-content');
        getProductInfo(id);
    });

    $('#loan_application_form').on('submit',function(e){
        e.preventDefault();
        submitApplication();
    });
});

function getClientInfo(id){
    postJson(paths.client_info,{id:id},function(data){
        updateClientInfo(JSON.parse(data));
    },function(data){
        alert('Error: Cannot fetch additional client data');
    })
}

function getProductInfo(id){
    return postJson(paths.product_info,{id:id},function(data){
        updateProductInfo(JSON.parse(data))
    },function(data){
        alert('Error: Cannot fetch additional product data');
    })
}

function updateClientInfo(clientData){
    $('#client_email').val(clientData.email).attr('readonly',true);
    $('#client_gender').val(clientData.gender).attr('readonly',true);
    $('#client_date_of_birth').val(moment(clientData.date_of_birth).format('yyyy-MM-DD')).attr('readonly',true);
    $('#client_id_number').val(clientData.identification_number).attr('readonly',true);
    $('#client_id_document').val(clientData.identification_document).attr('readonly',true);
    $('#client_nationality').val(clientData.nationality).attr('readonly',true);
    $('#client_contacts').val(clientData.primary_contact +' ,'+clientData.alternative_contact).attr('readonly',true);
}

function updateProductInfo(productData){
    $('#product_code').val(productData.code).attr('readonly',true);
    $('#product_rate').val(productData.rate).attr('readonly',true);
}

function submitApplication(){
    let client=$('#client_name').find(':selected')[0].getAttribute('value');
    let product=$('#product_name').find(':selected')[0].getAttribute('value');
    let nextOfKins=[];
    let guarantors=[];
    let collaterals=[];
    let loanDetails={
        amount:$('#application_amount').val(),
        duration:$('#application_duration').val()
    }
}

function addNextOfKinRow(){
}
function addCollateralRow(){
}
function addGuarantorRow(){
}

let rowAdd={
    nextOfKin:addNextOfKinRow(),
    guarantor:addGuarantorRow(),
    collateral:addCollateralRow()
}
