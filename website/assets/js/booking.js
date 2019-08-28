
//Always running when DOM is ready
$(document).ready(function() {

    //Get products from db and send them to booking.php
    getProductsFromDB();
    //Trigger instances if it contain this name.
    //Jquery cannot see Innerhtml, so it cannot call innerhtml text normally.
    $("body").on("click", "*[id*='btn-']", function (){
        let variable = this.id;
        let key = variable.slice(4);
        alert("adding to cart");
        // Run Function
        addToCart(key);
    });
    $('#display').delegate('#dateButton','click',function () {
        updateProductView($('#sdate').val(),$('#edate').val());
    });

});

function updateProductView(sdate,edate) {
   let sdateFormat = formatAndCheckDate(sdate);
   let edateFormat = formatAndCheckDate(edate);
    if (edateFormat && sdateFormat){

    }
    else {
        alert("pls enter a valid date");
    }
}

function formatAndCheckDate(date) {
   // yyyy/mm/dd database date format
    let date1 = new  Date();
    // Replace all occur and matches
    let newDate = date.replace(new RegExp("-","g"),"/");
    let datearr = newDate.split('/');
    //check if dd/mm/yy is right
    if ((parseInt(datearr[0]) >= date1.getFullYear()) && (parseInt(datearr[1]) > 0 && parseInt(datearr[1]) <= 12) && (parseInt(datearr[2]) > 0 &&parseInt(datearr[2]) <= 31)){
        return newDate;
    }
    return false;
}
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
                url: '../backend_instantiate/int_eventsforcarts.php',
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
        type: 'GET',
        url: '../backend_instantiate/int_dropdownlist.php',
        success: function (output) {
            //We're using appendchild instead of innerhtml so it doesn't cause a complete rebuild of the DOM.
            let p = document.createElement("div");
            p.innerHTML = output;
            document.getElementById("select_list_1").appendChild(p);

        }

    })
}
