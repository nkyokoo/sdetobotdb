//Always running when DOM is ready

$(document).ready(function() {
    displaycart();

    $("body").on("click", "*[id*='button-']", function () {
        event.preventDefault();
        let btn = this.id;
        //Trigger instances if it contain this name.
        if (btn.includes("button-remove")){
            let variable = this.id;
            let key = variable.slice(13);
            // Run Function
            removeProduct(key);
        }

        //Trigger clearbutton if it's clicked on
        if (btn.includes("button-clear")){

            //Run function
            clearCart();
        }
        //trigger onChange attribute on <input> tag

        if (btn.includes("button-booking")){
            booking();
        }
    });

    $("body").on("click", "*[id*='product-quantity-']",function () {
        let variable = this.id;
        let key = variable.slice(17);
        //get quantity of <input> tag
        let quantity = document.getElementById(variable);
        quantity = quantity.value;
        //Run Function
        onChangeQuantity(quantity, key);
    });

});

 //JS Functions
function onChangeQuantity(qts,pid) {
    //$qts = quantity || $pid = product id
    try {
        //if the quantity you want to change is over -1
        if (qts >= 0) {
            if (qts % 1 === 0){

                $.ajax({
                    type: 'POST',
                    url: '../backend_instantiate/int_eventsforcarts.php',
                    data: {onChangeQuantity: qts, PID: pid},
                    success: function (output) {
                        if (output === "total0"){
                            $('#row-'+pid).html('');

                        }
                        else {

                            if (output){
                                alert(output);
                                location.reload();

                            }
                        }

                    }
                })
            }else {
                alert("No Doubles!");
                location.reload();
            }

        } else {
            alert("We don't take Negative numbers or Characters!");
            location.reload();
        }
    } catch (e) {
    }

}

function removeProduct(pid) {
    $.ajax({
        type: 'POST',
        url: '../backend_instantiate/int_eventsforcarts.php',
        data: {remove: "remove", PID: pid},
        success: function () {
            //reload page if successful
           //

                    $('#row-'+pid).html('');
                    /*
                    let e = document.createElement("div");
                    e.innerHTML = output;
                    document.getElementById("display").appendChild(e);*/


        }
    })
}

function clearCart() {
    var d = new Date();
    //The input from Confirm is saved in a variable.
    $choice = confirm("Do you really want to Clear the Cart ?");
    //If confirm input variable is true
    if ($choice === true){
        $.ajax({
            type: 'POST',
            url: '../backend_instantiate/int_eventsforcarts.php',
            data: {clear: "clear"},
            success: function () {
                location.reload();
            }
        })
    }

}

function booking() {
    $choice = confirm("Are You Ready To Book The following Products?");
    if ($choice === true){
        $.ajax({
            type:'POST',
            url:'../backend_instantiate/int_cartsend.php',
            success:function (output) {
                //Clear cart after sending to wishlist
                if (!output){
                    alert("Your wishlist has been made");

                    $.ajax({
                        type: 'POST',
                        url: '../backend_instantiate/int_eventsforcarts.php',
                        data: {clear: "clear"}
                    });
                }else {alert(output);}
                location.reload();

            }


        })
    }
}
function displaycart() {

    $.ajax({
        type: 'POST',
        url: '../backend_instantiate/int_eventsforcarts.php',
        data:{display: "true"},
        success: function (output) {
            let e = document.createElement("div");
            e.innerHTML = output;
            document.getElementById("display").appendChild(e);
        }
    })

}
