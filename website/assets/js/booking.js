
//Always running when DOM is ready
$(document).ready(function() {
    //Check for supported native datepicker
    checkForSupportedDatePicker();
    //Update max date from start date
    updateMaxDate();

    $('#searchInput').keypress(function (e) {
        if (e.which === 13) {
            e.preventDefault();

            updateProductView($('#date_s').val(),$('#date_e').val(),$('#searchInput').val());

        }
    });

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
    display.delegate("*[id*='date_']",'blur',function (e) {
        e.preventDefault();

        updateMaxDate();
        resetCart();

    });

    //Pagination Events
    let pagination = $("#pagination");

    pagination.delegate("#lastBtn","click",function () {
        changePage(totalPages());
    });

    pagination.delegate("#firstBtn","click",function () {
       changePage(1);
    });

    pagination.delegate("[id^=page]","click",function () {
        changePage(parseInt(this.innerText));
    });

    pagination.delegate("#prevBtn","click",function () {
        prevPage();
    });

    pagination.delegate("#nextBtn","click",function () {
        nextPage();
    });
});
function checkForSupportedDatePicker()
{
    let sDate = $('#date_s');
    let eDate = $('#date_e');
    if (sDate[0].type === "text")
    {
        sDate.datepicker();
        eDate.datepicker();
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
          //   We're using appendchild instead of innerhtml so it doesn't cause a complete rebuild of the DOM.

           // output = output.slice(0,-1);
             //output = output.split(",");
            //total_Products = output;

            let selectList1 = $('#select_list_1');
            selectList1.empty();
            let div = document.createElement("div");
            div.innerHTML = output;
            selectList1.append(div);
            //Count the grandchildren elements from selectList1
            total_Products = selectList1.children().children().length;

            changePage(1);

          //   //document.getElementById("select_list_1").innerHTML = output;

        }

    })
}


//Pagination

let total_Products;
let current_Page;
let products_pr_page = 1;
function changePage(newPage) {

    let prevBtn = $("#prevBtn");
    let nextBtn = $("#nextBtn");
    let currentPage = $("#pageOne");
    let pageTwo = $("#pageTwo");
    let pageThree = $("#pageThree");
    let pagination = $('#pagination');
    let p = document.createElement("div");
    //p.setAttribute("class","Item-list");

    $("[id^=item_]").css("display","none");
    for (let i =(newPage-1)*products_pr_page; i < newPage*products_pr_page;i++) {
      //  let x = document.createElement("div");

        $("#item_"+i).css("display","block");
        //if (total_Products[i] !== undefined){
          //  x.innerHTML = total_Products[i];
        //}

        //p.append(x);
    }
    //Reset Active Anchors
    pageThree.parent().removeClass("active");
    pageTwo.parent().removeClass("active");
    currentPage.parent().removeClass("active");

    //Reset Buttons
    prevBtn.parent().removeClass("disabled");
    nextBtn.parent().removeClass("disabled");

    //If next page is below second to last


    //If the current page is the first and last page
 if (newPage === 1 && newPage === totalPages())
    {

        prevBtn.parent().addClass("disabled");
        nextBtn.parent().addClass("disabled");

        pageThree.parent().css("display","none");
        pageTwo.parent().css("display","none");

        //Change pagination anchor number display
        currentPage.html(newPage);
    }
    //If next page is the last
    else if (newPage === totalPages() || newPage === 3) {

        if (newPage === totalPages()){

            nextBtn.parent().addClass("disabled");
            //Change pagination anchor number display

        }
         currentPage.html(newPage-2);
         pageTwo.html(newPage-1);
         pageThree.html(newPage);

        pageThree.parent().addClass("active");

        //Change pagination anchor number display

    }
        //If next page is second to last
   else if (newPage === (totalPages() -1) || newPage === 2)
    {
        pageTwo.parent().addClass("active");

        if (newPage-1 < 1){
            currentPage.parent().css("display","none");
        }
        else {
            currentPage.parent().css("display","block");

        }
        //Change pagination anchor number display
        currentPage.html(newPage-1);
        pageTwo.html(newPage);
        pageThree.html(newPage+1);

    }
    else if (newPage < totalPages() -1){


        if (newPage === 1)
        {
            currentPage.parent().addClass("active");

            prevBtn.parent().addClass("disabled");
            //Change pagination anchor number display
            currentPage.html(newPage);
            pageTwo.html(newPage+1);
            pageThree.html(newPage+2);
        }
        else {
            pageTwo.parent().addClass("active");

            //Change pagination anchor number display
            currentPage.html(newPage-1);
            pageTwo.html(newPage);
            pageThree.html(newPage+1);
        }

    }
    else {
        alert("error");
 }
    current_Page = newPage;

    //Display Pagination
    pagination.css("display","block");

}

function prevPage() {
    if (parseInt(current_Page)-1 >= 1){


        changePage(current_Page -1);
    }

}
function nextPage() {
    if (parseInt(current_Page)+1 <= totalPages()){

        changePage(current_Page +1);
    }
}
function totalPages() {
    return Math.ceil(total_Products/products_pr_page);
}

