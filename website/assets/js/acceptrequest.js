
$(document).ready(function () {
    displayRequests();

    $("body").on("click","*[id*='btn-']",  function (){
        let variable = this.id;
        alert(variable);
        if (variable.includes("accept")){
            let id = variable.slice(11);
            alert(id);

//            acceptRequest(id);
        }
        else if (variable.includes("deny")){
            let id = variable.slice(9);
            alert(id);
            //denyRequest(id);
        }

    })



});

function displayRequests() {
    $.ajax({
        type: "POST",
        url: "http://localhost:8000/api/booking/acceptrequest",
        success: function (output) {
          let p = document.createElement('div');
          p.innerHTML = output;
          document.getElementById("requests-body").appendChild(p);
        }
    })
}

function acceptRequest(wishlistID) {

}

function denyRequest(wishistID) {

}

