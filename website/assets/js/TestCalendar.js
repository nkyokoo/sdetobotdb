$(document).ready(function () {

        drawCalendar();
});


function drawCalendar() {
    let calendarEl = document.getElementById("calendar");

    //Create and Configure the Calendar
    let calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: [ 'dayGrid' ],
        header: {center: 'dayGridMonth,dayGridWeek'},
        defaultView: 'dayGridWeek',
        eventLimit: true, // for all non-TimeGrid views

        eventClick: function(info) { //Start Event when you click on event boxes.
            //Events
            alert(info.event.title +'\n'+ info.event.extendedProps.description);
        },
        //Data for view
        events: [{
            title: "Long Ly booking fra 2019-09-22 til 2019-10-27",
            start:"2019-09-22",
            end: '2019-10-27T23:59:00',
            description:"hello"
        },
            {
                title: "Long Ly booking fra 2019-09-22 til 2019-10-27",
                start:"2019-09-22",
                end: '2019-10-27T23:59:00',
                description:"hello"
            },
            {
                title: "Long Ly booking fra 2019-09-22 til 2019-10-27",
                start:"2019-09-22",
                end: '2019-10-27T23:59:00',
                description:"hello"
            },
            {
                title: "Long Ly booking fra 2019-09-22 til 2019-10-27",
                start:"2019-09-22",
                end: '2019-10-27T23:59:00',
                description:"hello"
            },
            {
                title: "Long Ly booking fra 2019-09-22 til 2019-10-27",
                start:"2019-09-22",
                end: '2019-10-27T23:59:00',
                description:"hello"
            },
            {
                title: "Long Ly booking fra 2019-09-22 til 2019-10-27",
                start:"2019-09-22",
                end: '2019-10-27T23:59:00',
                description:"hello"
            },
            {
                title: "Long Ly booking fra 2019-09-22 til 2019-10-27",
                start:"2019-09-22",
                end: '2019-09-27T23:59:00',
                description:"hello"
            },
            {
                title: "Long Ly booking fra 2019-09-22 til 2019-10-27",
                start:"2019-09-22",
                description:"hello"
            },
            {
                title: "Long Ly booking fra 2019-09-22 til 2019-10-27",
                start:"2019-09-22",
                description:"hello"
            },
            {
                title: "Long Ly booking fra 2019-09-22 til 2019-10-27",
                start:"2019-09-22",
                end: '2019-10-27T23:59:00',
                description:"hello"
            }
        ],
        timeFormat: 'H(:mm)',
        displayEventTime: false,
    });

    //Draw the Calendar
    calendar.render();
}