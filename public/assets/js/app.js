let origin=window.location.origin+'/';
let paths={
    client_info:origin+'clientinfo',
    product_info:origin+'productinfo',
    loan_application:origin+'loan-applications'
}

$(document).ready(function(){
    $('#client_name').select2();
    $('#product_name').select2();
    $('#loan_officer').select2();

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
    let officer=$('#loan_officer').val();
    let nextOfKins=[];
    let guarantors=[];
    let collaterals=[];
    let loanDetails={
        amount:$('#application_amount').val(),
        duration:$('#application_duration').val(),
        officer:officer,
        purpose:$('#application_purpose').val(),
        frequency:$('#application_repayment_frequency').val()
    }
    // get next of kins
    $('#NOK_TABLE tbody').find('tr').each(function(k,v){
        let name=null,
            email=null,
            gender=null,
            document_type=null,
            document_number=null,
            nationality=null,
            contact=null,
            relation=null,
            date_of_birth=null,
            address=null;
        $(v).find('input').each(function (i,j){
            if(j.name=='next_of_kin_name'){
                name=j.value;
            }
            if(j.name=='next_of_kin_email'){
                email=j.value;
            }
            if(j.name=='next_of_kin_document_number'){
                document_number=j.value;
            }
            if(j.name=='next_of_kin_nationality'){
                nationality=j.value;
            }
            if(j.name=='next_of_kin_contact'){
                contact=j.value;
            }
            if(j.name=='next_of_kin_relation'){
                relation=j.value;
            }
            if(j.name=='next_of_kin_date_of_birth'){
                date_of_birth=j.value;
            }
        });
        $(v).find('textarea').each(function (i,j){
            if(j.name=='next_of_kin_address'){
                address=j.value;
            }
        });
        $(v).find('select').each(function (i,j){
            if(j.name=='next_of_kin_document'){
                document_type=j.value;
            }
            if(j.name=='next_of_kin_gender'){
                gender=j.value;
            }
        });
        nextOfKins.push({
            next_of_kin_gender:gender,
            next_of_kin_document:document_type,
            next_of_kin_address:address,
            next_of_kin_date_of_birth:date_of_birth,
            next_of_kin_relation:relation,
            next_of_kin_contact:contact,
            next_of_kin_nationality:nationality,
            next_of_kin_document_number:document_number,
            next_of_kin_email:email,
            next_of_kin_name:name
        });
    });

    //get guarantors
    $('#guarantors_table tbody').find('tr').each(function(k,v){
        let name=null,
            identification_type=null,
            identification_number=null,
            contact=null;
        $(v).find('input').each(function (i,j){
            if(j.name=='guarantor_name'){
                name=j.value;
            }
            if(j.name=='guarantor_id_number'){
                identification_number=j.value;
            }
            if(j.name=='guarantor_contact'){
                contact=j.value;
            }
        });
        $(v).find('select').each(function (i,j){
            if(j.name=='guarantor_id_document'){
                identification_type=j.value;
            }
        });
        guarantors.push({
            guarantor_name:name,
            guarantor_id_number:identification_number,
            guarantor_contact:contact,
            guarantor_id_document:identification_type
        });
    });

    //get collateral
    $('#collateral_table tbody').find('tr').each(function(k,v){
        let type=null,
            details=null,
            value=null;
        $(v).find('input').each(function (i,j){
            if(j.name=='collateral_type'){
                type=j.value;
            }
            if(j.name=='collateral_value'){
                value=j.value;
            }
        });
        $(v).find('textarea').each(function (i,j){
            if(j.name=='collateral_details'){
                details=j.value;
            }
        });
        collaterals.push({
            collateral_type:type,
            collateral_value:value,
            collateral_details:details
        });
    });

    // bundle it all
    let payload={
        loan_officer:officer,
        next_of_kin:nextOfKins,
        guarantors:guarantors,
        collaterals:collaterals,
        loanDetails:loanDetails,
        product:product,
        client:client
    }

    postJson(paths.loan_application,payload,function(data){
        console.log(data)
    },function (data){
        console.log(data)
    })
}

function addNextOfKinRow(){
    let basicRow='' +
        `<tr>
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
        </tr>`;
    $('#NOK_TABLE tbody').append(basicRow);
}
function addCollateralRow(){
    let basicRow=''+
        '<tr>' +
        '    <td><input type="text" class="w-100" name="collateral_type" id="collateral_type"></td>' +
        '    <td><textarea name="collateral_details" id="collateral_details" class="w-100" rows="1"></textarea></td>' +
        '    <td><input type="text" class="w-100" name="collateral_value" id="collateral_value"></td>' +
        '</tr>';
    $('#collateral_table tbody').append(basicRow);
}
function addGuarantorRow(){
    let basicRow=''+
        ' <tr>' +
        '    <td><input type="text" class="w-100"></td>' +
        '    <td><textarea name="" id="" class="w-100" rows="1"></textarea></td>' +
        '    <td><input type="text" class="w-100"></td>' +
        '    <td><input type="text" class="w-100"></td>' +
        '</tr>';
    $('#guarantors_table tbody').append(basicRow);
}
