
$(document).ready(function () {
    displayRequests();

    $("body").on("click","*[id*='btn-']",  function (){
        let variable = this.id;
        alert(variable);
        if (variable.includes("accept")){
            let id = variable.slice(11);
            alert(id);
            acceptRequest(id);
        }
        else if (variable.includes("deny")){
            let id = variable.slice(9);
            alert(id);
            denyRequest(id);
        }

    })



});

function displayRequests() {
    $.ajax({
        type: "POST",
        url: "http://localhost:8000/api/admin/displayrequest",
        success: function (output) {
            let p = document.createElement('div');
            p.innerHTML = output;
            document.getElementById("requests-body").appendChild(p);
        }
    })
}

function acceptRequest(wishlistID) {
    $choice = confirm("Do you really want to ACCEPT this request");
    if ($choice) {
        $.ajax({
            type: "POST",
            url: "../backend_instantiate/int_wishlistrequests.php",
            data: {accept: "true", wishlistID: wishlistID},
            success: function (output) {

            }
        })
    }
}

function denyRequest(wishistID) {
    $choice = confirm("Do you really, REALLY want to DENY this request");
    if ($choice){

        $.ajax({
            type: "POST",
            url: "../backend_instantiate/int_wishlistrequests.php",
            data:{accept: "", wishistID: wishistID},
            success: function (output) {
                $refresh = confirm("Do you want to refresh the page?");
                if ($refresh){
                    location.reload();
                }
            }
        })
    }

}

