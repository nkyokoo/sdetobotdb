
$(document).ready(function () {
    //Display requests
    displayRequests();

    $("body").on("click", "*[id*='btn-']", function (){
        let variable = this.id;

        //Check if the ID on button contain the string accept
        if (variable.includes("accept")){
            let id = variable.slice(11);
            acceptRequest(id);
        }
        //Check if the ID on button contain the string deny
        else if (variable.includes("deny")){
            let id = variable.slice(9);
            denyRequest(id);
        }
    });


});

function displayRequests() {

    ///api/admin/displayrequest
    $.ajax({
        type: "GET",
        url: "../backend_instantiate/int_displaywishlistrequests.php",
        success: function (output) {

            output = JSON.parse(output);

            let prevID = 0;

            for (obj of output){
                //If the product is on the same wishlist as last product
                if (obj.id === prevID){
                    let product = "<li  class='list-group-item d-flex justify-content-between align-items-center'>"+obj.product_name+"" +
                        "  <span style='margin-left: .9rem' class='badge badge-primary badge-pill'>"+obj.quantity+"</span>" +
                        "</li>";
                    $('#'+obj.id+'').append(product);


                }
                //Create new Wishlist and insert product
                else {
                    const div = document.createElement("div");
                    let html = "<div id='container_"+obj.id+"' class='row'> <div class='col'>" +
                        "   <div class='card' style=' margin-left: 1rem; width: 25rem'>" +
                        "   <div class='card-body'>" +
                        "   <h5 class='card-title'>"+obj.name+"</h5>" +
                        "<h6>Reserved dato: "+obj.rerserved_date.substring(0,10)+"</h6>"+
                        "<h6>Start dato: "+obj.start_date.substring(0,10)+"</h6>"+
                        "<h6>Slut dato: "+obj.end_date.substring(0,10)+"</h6>"+
                        "<div><ul class='list-group' id='"+obj.id+"'></ul></div>"+
                        "<button class='btn btn-primary' id='btn-accept-"+obj.id+"'><i class='material-icons'>done</i></button> <button class='btn btn-danger' id='btn-deny-"+obj.id+"'><i class='material-icons'>cancel</i></button>" +
                        "   </div>" +
                        "   </div>" +
                        "   </div>";
                    div.innerHTML = html;
                    let product = "<li  class='list-group-item d-flex justify-content-between align-items-center'>"+obj.product_name+"" +
                        "  <span style='margin-left: .9rem' class='badge badge-primary badge-pill'>"+obj.quantity+"</span>" +
                        "</li>";
                    document.getElementById("request_body").appendChild(div);
                    $('#'+obj.id+'').append(product);
                }
                //Update Wishlist ID
            prevID = obj.id;
            }
        }
    })
}

//Accepte Requst
function acceptRequest(wishlistID) {
    let choice = confirm("Do you really want to ACCEPT this request");
    if (choice) {
        $.ajax({
            type: "POST",
            url: "../backend_instantiate/int_wishlistrequests.php",
            data: {accept: 1, wishlistID: wishlistID},
            success: function () {
                $('#container_'+wishlistID).hide();
            }
        })
    }
}

//Deny Request
function denyRequest(wishlistID) {
    let choice = confirm("Do you really, REALLY want to DENY this request");
    if (choice){
        $.ajax({
            type: "POST",
            url: "../backend_instantiate/int_wishlistrequests.php",
            data: {accept: 0, wishlistID: wishlistID},
            success: function () {
                $('#container_'+wishlistID).hide();

            }
        })
    }

}

