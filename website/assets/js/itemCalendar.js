$(document).ready(function () {


        //if clicking on show product booking history
        $(document).delegate("#rendCal","click",function () {
            if (calendar){

                destroyCalendar();
            }
            drawCalendar(this.dataset.product,this.name);


        });

        //if close product booking history
    $(document).delegate("#closeCal","click",function () {
        destroyCalendar();
    });

});

//Global variable to contain the Rendered Calendar object

let calendar;
function drawCalendar(productID, productName) {
    document.getElementById("modalTitle").innerHTML = productName;

    let calendarEl = document.getElementById("itemCalendar");

    //Create and Configure the Calendar
    calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: [ 'dayGrid' ],
        //header: {center: 'dayGridMonth'},
        titleFormat: { year: 'numeric', month: 'short'},
        weekNumbers: true,
        locale: 'da',
        weekLabel: 'uge',
        firstDay: 1,
        hiddenDays: [0, 6],
        eventLimit: true, // for all non-TimeGrid views
        eventClick: function(info) { //Start Event when you click on event boxes.
            //Events
            alert(info.event.extendedProps.description +'\n'+ info.event.extendedProps.undertitle +'\n'+ info.event.title);
        },
        //Data for view
        events:{
          url: '../backend_instantiate/int_getItemCalendar.php',
          method: 'POST',
          extraParams: {
              productID: productID
          },
            failure: function () {
                alert("Der er noget galt med forbindelsen. Prøv igen senere eller kontakt it service");
            }
        },
        timeFormat: 'H(:mm)',
        displayEventTime: false
    });

    //Draw/Render the Calendar
     calendar.render();
}



function destroyCalendar() {
    //Destroy the Calendar
    calendar.destroy();
}