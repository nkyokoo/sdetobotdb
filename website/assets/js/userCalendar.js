$(document).ready(function () {

    drawCalendar();
});


function drawCalendar() {
    let calendarEl = document.getElementById("userCalendar");

    //Create and Configure the Calendar
    let calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: [ 'dayGrid','bootstrap' ],
        header: {center: 'dayGridMonth,dayGridWeek'},
        defaultView: 'dayGridWeek',
        weekNumbers: true,        //Activate Week number
        locale: 'da',        //Local language for calendar
        weekLabel: 'uge',        //Label Wee
        firstDay: 1,        //Start from Monday
        hiddenDays: [0, 6],        //Hide sunday and saturday
        eventLimit: true, // for all non-TimeGrid views
        eventClick: function(info) { //Start Event when you click on event boxes.
            //Events
           let content = $("#user_modal_content")
            content.empty();
            let item =  document.createElement("div")
            item.setAttribute("id","kalenderitem")
            item.innerHTML = "<h1>"+info.event.title+"<h1>" +'\n <h4>'+ info.event.extendedProps.undertitle +'</h4>\n<p>'+ info.event.extendedProps.description+"</p>";
            content.append(item);
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