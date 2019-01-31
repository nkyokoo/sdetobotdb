

function onChangeQuantity($qts,$pid) {
    //$qts = quantity || $pid = product id
    try {
        //if the quantity you want to change is over -1
        if ($qts >= 0) {

            $.ajax({
                type: 'POST',
                url: 'api/api_eventsforcarts.php',
                data: {onChangeQuantity: $qts, PID: $pid},
                success: function () {
                }
            })
        } else {
            alert("We don't take Negative numbers!");
            location.reload();
        }
    } catch (e) {
    }

}

function removeProduct($pid) {
    $.ajax({
        type: 'POST',
        url: 'api/api_eventsforcarts.php',
        data: {remove: "remove", PID: $pid},
        success: function () {
            //reload page if successful
            location.reload();
        }
    })
}
function clearCart() {
  $choice = confirm("Do you really want to Clear the Cart ?");
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