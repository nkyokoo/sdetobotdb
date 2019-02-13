//Always running when DOM is ready
$(document).ready(function() {

    //Trigger instances if it contain this name.

    $('*[id*="button-remove"]').click(function(){
      let variable = this.id;
      let key = variable.slice(13);
      // Run Function
        removeProduct(key);
    });

    //Trigger clearbutton if it's clicked on
    $('#button-clear').click(function () {
        //Run function
        clearCart();
    });
    //trigger onChange attribute on <input> tag
    $('*[id*="product-quantity-"]').change(function(){
        //get id of clicked button
        let variable = this.id;
        let key = variable.slice(17);
        //get quantity of <input> tag
        let quantity = document.getElementById(variable);
        quantity = quantity.value;
        //Run Function
        onChangeQuantity(quantity,key);
    });
    $('#button-booking').click(function () {
        booking();
    })
});

function onChangeQuantity(qts,pid) {
    //$qts = quantity || $pid = product id
    try {
        //if the quantity you want to change is over -1
        if (qts >= 0) {
            if (qts % 1 === 0){

            $.ajax({
                type: 'POST',
                url: 'api/api_eventsforcarts.php',
                data: {onChangeQuantity: qts, PID: pid},
                success: function (output) {
                    if (output)
                        alert(output);
                   location.reload();
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
        url: 'api/api_eventsforcarts.php',
        data: {remove: "remove", PID: pid},
        success: function () {
            //reload page if successful
            location.reload();
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
        url: 'api/api_eventsforcarts.php',
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
                url:'api/api_bookingsend.php',
                data:{choice: 0},
                success:function (output) {
                    alert(output);
                    alert("you've succeed");
                }
            })
        }
}
