
$(document).ready(function () {
    displayRequests();
});

function displayRequests() {
    $.ajax({
        type: "POST",
        url: "/api/api_acceptrequest.php",
        success: function (output) {
            alert("output "+output);
          let p = document.createElement('div');
          p.innerHTML = output;
          document.getElementById("requests-body").appendChild(p);
        }
    })

}
