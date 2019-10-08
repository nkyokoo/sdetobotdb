$(document).ready(function() {


    displaycart();
    let body = $("body");
    body.on("click", "*[id*='button-']", function () {
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
            document.getElementById(btn).setAttribute("disabled","disabled");
            booking();
        }
    });

    $('#display').delegate("*[id*='product-quantity-']", "blur",function () {
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
                        //if total is under 0
                        if (output === "total0"){
                            $('#product-quantity-'+pid).val(1);

                        }
                        else {

                            if (output){
                                let options = {
                                    content: output, // text of the snackbar
                                    style: "toast", // add a custom class to your snackbar
                                    timeout: 3000, // time in milliseconds after the snackbar autohides, 0 is disabled
                                    htmlAllowed: true, // allows HTML as content value
                                    onClose: function () {

                                    } // callback called when the snackbar gets closed.
                                }
                                $.snackbar(options);
                                location.reload();

                            }
                        }

                    }
                })
            }else {
                let options = {
                    content: "No doubles!", // text of the snackbar
                    style: "toast", // add a custom class to your snackbar
                    timeout: 1000, // time in milliseconds after the snackbar autohides, 0 is disabled
                    htmlAllowed: true, // allows HTML as content value
                    onClose: function () {
                        location.reload();

                    } // callback called when the snackbar gets closed.
                }
                $.snackbar(options);
            }

        } else {
            let options = {
                content: "We don't take negative numbers or characters", // text of the snackbar
                style: "toast", // add a custom class to your snackbar
                timeout: 1000, // time in milliseconds after the snackbar autohides, 0 is disabled
                htmlAllowed: true, // allows HTML as content value
                onClose: function () {
                    location.reload();

                } // callback called when the snackbar gets closed.
            }
            $.snackbar(options);
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
                    let options = {
                        content: "Your wishlist has been made", // text of the snackbar
                        style: "toast", // add a custom class to your snackbar
                        timeout: 1000, // time in milliseconds after the snackbar autohides, 0 is disabled
                        htmlAllowed: true, // allows HTML as content value
                        onClose: function () {
                            $.ajax({
                                type: 'POST',
                                url: '../backend_instantiate/int_eventsforcarts.php',
                                data: {clear: "clear"}
                            });
                            location.reload();
                        } // callback called when the snackbar gets closed.
                    }
                    $.snackbar(options);


                }else {
                    let options = {
                        content: output, // text of the snackbar
                        style: "toast", // add a custom class to your snackbar
                        timeout: 1000, // time in milliseconds after the snackbar autohides, 0 is disabled
                        htmlAllowed: true, // allows HTML as content value
                        onClose: function () {
                            location.reload();
                        } // callback called when the snackbar gets closed.
                    }
                    $.snackbar(options);
                }
                // location.reload();

            }


        });
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