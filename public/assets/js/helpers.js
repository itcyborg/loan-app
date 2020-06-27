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

function onError(error) {
    console.log("Error "+error.responseText);
}

function onSuccess(msg) {
    console.log("Success "+ msg.responseText);
}

function loadLoanApplications(url){
    console.log(RestCalls(url,onError,onSuccess));
}
