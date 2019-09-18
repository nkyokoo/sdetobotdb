


//Always running when DOM is ready
$(document).ready(function() {
    //Update max date from start date
    checkForSupportedDatePicker();
    $('#searchInput').bind('keypress', {}, keypress);
    updateMaxDate();
    //Trigger instances if it contain this name.
    //Jquery cannot see Innerhtml, so it cannot call innerhtml text normally.
    $("body").on("click", "*[id*='btn-']", function (){
        let variable = this.id;
        let key = variable.slice(4);

        //alert("adding to cart");
        // Run Function
        addToCart(key);


    });
    let display = $('#display');
    display.delegate('#dateButton','click',function () {
        updateProductView($('#date_s').val(),$('#date_e').val());
    });
    display.delegate("*[id*='date_']",'change',function () {

        /*        if (this.id === "date_e"){
        //            alert("hey");
                    updateProductView($('#date_s').val(),$('#date_e').val());

                }*/
        updateMaxDate();
        resetCart();
    });

});
function checkForSupportedDatePicker() {
    let sDate = $('#date_s');
    let eDate = $('#date_e');
    if (sDate[0].type === "text"){
        sDate.datepicker();
        eDate.datepicker();
    }
}
function keypress(e) {

    let code = (e.keyCode ? e.keyCode : e.which);
    if (code === 13) // Enter Keycode
    {
        updateProductView($('#date_s').val(),$('#date_e').val(),$('#searchInput').val());
    }
}
function resetCart() {
    $.ajax({
        type: 'POST',
        url: '../backend_instantiate/int_eventsforcarts.php',
        data: {clear: "clear"},
        success: function () {
            /* reset cart icon to 0 and null */
        }
    })
}
function updateMaxDate() {
    let sdate = $('#date_s');
    let edate = $('#date_e');
    let dt = new Date(sdate.val());
    let day = dt.getDate();
    if (day < 10){
        day = "0" + day.toString();
    }
    // go to next month, months range from 0-11 where 0 = January
    dt.setMonth(dt.getMonth() + 1);
    let month = dt.getMonth();
    //increment +1 month to show correct month to the client 1-12
    month++;
    if (month < 10){
        month = "0" + month.toString();
    }
    let year = dt.getFullYear();
    let maxDate = year+'-'+month+'-'+day;
    edate.attr('max',maxDate);
    edate.attr('min',sdate.val());
    if (edate.val() < sdate.val()){
        edate.val(sdate.val());
    }
}
function updateProductView(sdate,edate, search = null) {
    let sdateFormat = formatAndCheckDate(sdate);
    let edateFormat = formatAndCheckDate(edate);
    let sdateMinValue = document.getElementById("date_s").min;
    let edateMaxValue = document.getElementById("date_e").max;
    if (edateFormat && sdateFormat){
        //Get products from db and send them to booking.php
        //alert(edateFormat);
        //  alert(sdateFormat);
        if (search){
            getProductsFromDB(sdateFormat,edateFormat,search);
        }
        else
        {
            if (sdateFormat >= sdateMinValue && edateFormat >= sdateMinValue)
            {
                if (edateFormat >= sdateFormat)
                {
                    if (edateMaxValue >= edateFormat)
                    {
                        getProductsFromDB(sdateFormat,edateFormat);
                    }
                    else
                    {
                        let options = {
                            content: "You can only book 1 month ahead", // text of the snackbar
                            style: "toast", // add a custom class to your snackbar
                            timeout: 3000, // time in milliseconds after the snackbar autohides, 0 is disabled
                            htmlAllowed: true, // allows HTML as content value
                            onClose: function () {

                            } // callback called when the snackbar gets closed.
                        };
                        $.snackbar(options);
                    }
                }
                else
                {
                    let options = {
                        content: "Wrong end date selected", // text of the snackbar
                        style: "toast", // add a custom class to your snackbar
                        timeout: 3000, // time in milliseconds after the snackbar autohides, 0 is disabled
                        htmlAllowed: true, // allows HTML as content value
                        onClose: function () {

                        } // callback called when the snackbar gets closed.
                    }
                    $.snackbar(options);
                }
            }
            else
            {
                let options = {
                    content: "You can only book from Today onward "+sdateMinValue, // text of the snackbar
                    style: "toast", // add a custom class to your snackbar
                    timeout: 3000, // time in milliseconds after the snackbar autohides, 0 is disabled
                    htmlAllowed: true, // allows HTML as content value
                    onClose: function () {

                    } // callback called when the snackbar gets closed.
                }
                $.snackbar(options);
            }
        }
    }
    else {
        let options = {
            content: "Please enter a valid date", // text of the snackbar
            style: "toast", // add a custom class to your snackbar
            timeout: 3000, // time in milliseconds after the snackbar autohides, 0 is disabled
            htmlAllowed: true, // allows HTML as content value
            onClose: function () {

            } // callback called when the snackbar gets closed.
        }
        $.snackbar(options);
    }
}

function formatAndCheckDate(date) {
    // yyyy/mm/dd database date format
    let date1 = new Date();
    // Replace all occur and matches
    let datearr = date.split('-');
    //check if dd/mm/yy is right
    if ((parseInt(datearr[0]) >= date1.getFullYear()) && (parseInt(datearr[1]) > 0 && parseInt(datearr[1]) <= 12) && (parseInt(datearr[2]) > 0 &&parseInt(datearr[2]) <= 31)){
        return date;
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
            let options = {
                content: "Adding to cart", // text of the snackbar
                style: "toast", // add a custom class to your snackbar
                timeout: 1000, // time in milliseconds after the snackbar autohides, 0 is disabled
                htmlAllowed: true, // allows HTML as content value
                onClose: function () {

                } // callback called when the snackbar gets closed.
            }
            $.snackbar(options);
            $.ajax({
                type: 'POST',
                url: '../backend_instantiate/int_eventsforcarts.php',
                data: {PID: productID,quantity: getChosenValueOfProduct, submit:'submit'},
                success: function (output) {
                    if (output) {
                        let options = {
                            content: output, // text of the snackbar
                            style: "toast", // add a custom class to your snackbar
                            timeout: 3000, // time in milliseconds after the snackbar autohides, 0 is disabled
                            htmlAllowed: true, // allows HTML as content value
                            onClose: function () {

                            } // callback called when the snackbar gets closed.
                        }
                        $.snackbar(options);
                    }
                    else {
                        let btn = document.getElementById('btn-' + productID);
                        btn.innerHTML = 'Added';
                        btn.disabled = true;
                        product.disabled = true;
                    }
                }
            })
        } else {
            let options = {
                content: "You've not chosen an amount yet", // text of the snackbar
                style: "toast", // add a custom class to your snackbar
                timeout: 3000, // time in milliseconds after the snackbar autohides, 0 is disabled
                htmlAllowed: true, // allows HTML as content value
                onClose: function () {

                } // callback called when the snackbar gets closed.
            }
            $.snackbar(options);
        }
    } catch (e) {
    }
}
function getProductsFromDB(sDate, eDate, search = null) {
    let obj = {};
    obj.sdate = sDate;
    obj.edate = eDate;
    if (search){
        obj.search = search;
    }
    $.ajax({
        type: 'POST',
        url: '../backend_instantiate/int_dropdownlist.php',
        data: obj,
        success: function (output) {
            //We're using appendchild instead of innerhtml so it doesn't cause a complete rebuild of the DOM.
            let p = document.createElement("div");
            p.innerHTML = output;
            let selectList1 = $('#select_list_1');
            selectList1.empty();
            selectList1.append(p);

            //document.getElementById("select_list_1").innerHTML = output;

        }

    })
}