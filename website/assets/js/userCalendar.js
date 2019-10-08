$(document).ready(function () {

    drawCalendar();
});


function drawCalendar() {
    let calendarEl = document.getElementById("userCalendar");

    //Create and Configure the Calendar
    let calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: [ 'dayGrid' ],
        header: {center: 'dayGridMonth,dayGridWeek'},
        defaultView: 'dayGridWeek',
        weekNumbers: true,
        locale: 'da',
        weekLabel: 'uge',
        firstDay: 1,
        hiddenDays: [0, 6],
        eventLimit: true, // for all non-TimeGrid views
        eventClick: function(info) { //Start Event when you click on event boxes.
            //Events

            let item =  document.createElement("div")
            item.setAttribute("id","kalenderitem")
            item.innerHTML = "<h1>"+info.event.title+"<h1>" +'\n <h4>'+ info.event.extendedProps.undertitle +'</h4>\n<p>'+ info.event.extendedProps.description+"</p>";
            $('#usermodal').modal('show')

        },
        //Data for view
        events:'../backend_instantiate/int_getUserCalendar.php',
        timeFormat: 'H(:mm)',
        displayEventTime: false,
    });

    //Draw the Calendar
    calendar.render();
}