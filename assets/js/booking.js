
//Always running when DOM is ready
$(document).ready(function() {

    //Get products from db and send them to booking.php
    getProductsFromDB();

    //Trigger instances if it contain this name.
    //Jquery cannot see Innerhtml, so it cannot call innerhtml text normally.
    $("body").on("click", "*[id*='btn-']", function (){
        let variable = this.id;
        let key = variable.slice(4);
        // Run Function
        addToCart(key);
    })

});



// Add product to cart via SESSION in a php file
function addToCart(productID) {
    try {
        //Get the input
        let product = document.getElementById( "product-unit-"+productID);
        //Get the Value of input
        let getChosenValueOfProduct = product.value;
        //
        if (getChosenValueOfProduct > 0) {
            $.ajax({
                type: 'POST',
                url: 'api/api_eventsforcarts.php',
                data: {PID: productID,quantity: getChosenValueOfProduct, submit:'submit'},
                success: function (output) {
                    if (output)
                    alert(output);
                    else {
                        let btn = document.getElementById('btn-' + productID);
                        btn.innerHTML = 'Added';
                        btn.disabled = true;
                        product.disabled = true;
                    }
                }
            })
        } else {
            alert("You've not chosen an Amount Yet");
        }
    } catch (e) {
    }
}
function getProductsFromDB() {
    $.ajax({
        type: 'POST',
        url: 'api/api_dropdownlistproducts_function.php',
        success: function (output) {

            //We're using appendchild instead of innerhtml so it doesn't cause a complete rebuild of the DOM.
           let p = document.createElement("div");
           p.innerHTML = output;
           let h = document.getElementById("select_list_1");
           h.appendChild(p);
        }

    })
}
