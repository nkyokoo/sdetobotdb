<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Calendar</title>

    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2018.3.1017/styles/kendo.material-v2.min.css" />
    <link rel="stylesheet" href="calendar.css"> <!--style I made for the popup box(modal) and for higlighting of dates in date range picker-->

    <!-- source library "Kendo UI": https://www.telerik.com/kendo-ui
    specific "Kendo Scheduler" with events: https://demos.telerik.com/kendo-ui/scheduler/events
    api reference: https://docs.telerik.com/kendo-ui/api/javascript/ui/scheduler
    documentation with various "how to" tutorials: https://docs.telerik.com/kendo-ui/controls/scheduling/scheduler/overview
    (navigation of the last one is on the left side, you can find date range pickers configuration there too, it's under DatePicker section if you need it)-->

    <script src="https://code.jquery.com/jquery-1.12.3.min.js"></script>
    <script src="https://kendo.cdn.telerik.com/2018.2.620/js/angular.min.js"></script>
    <script src="https://kendo.cdn.telerik.com/2018.2.620/js/jszip.min.js"></script>
    <script src="https://kendo.cdn.telerik.com/2018.2.620/js/kendo.all.min.js"></script>
</head>
<body>

<div id="scheduler"> <!--main container for the scheduler, it is initialize in here after function is called on line-->

<!-- templates that show events in the scheduler, the allDayEvent ones are the ones at the top of the page

 little more:    #: title #    represents something like a placeholder where items attribute under the name of "title" will be shown
                 #= description #      same goes for this but had to use = instead of : because it wouldn't work so I suggest you to use = in future

hope you understand -->

<script id="event-template" type="text/x-kendo-template">
    <div class="item-template">
        <h3>#: title #</h3>
        <p style="margin-left: 7px;">
            #: kendo.toString(start, "H:mm") # - #: kendo.toString(end, "H:mm") #
        </p>
         <p style="margin-left: 7px; line-height: 1rem;">
            #= description #
        </p>
    </div>
</script>
<script id="allDayEvent-template" type="text/x-kendo-template">
    <div class="item-template">
        <h3>#: title # #: kendo.toString(start, "H:mm") # - #: kendo.toString(end, "H:mm") #</h3>
    </div>
</script>

<script>
    /*temporary data source, this is just a basic example there are tutorials on how to link it with databases, I leave this to you, good luck :P
    these should help: https://docs.telerik.com/kendo-ui/api/javascript/ui/scheduler/configuration/resources
                        https://docs.telerik.com/kendo-ui/api/javascript/data/schedulerdatasource

                        and maybe this one: https://docs.telerik.com/kendo-ui/api/javascript/data/datasource, use the navigation on the left!!!
     */
    var ds = new kendo.data.SchedulerDataSource({
        data: [
            {
                id: 0,
                title: "New Item",
                start: new Date("2018-12-03T09:35"),
                end: new Date("2018-12-03T09:55"),
                description: "Just random description"
            },
            {
                id: 1,
                title: "Real Item",
                start: new Date("2018-12-03T12:15"),
                end: new Date("2018-12-04T14:00"),
                description: "Just another random description"
            },
            {
                id: 2,
                title: "The most real Item",
                start: new Date("2018-12-07T15:15"),
                end: new Date("2018-12-07T18:00"),
                description: "Just another real random description"
            }],
        schema:{
            model: {id: "id"}
        }
    });

    ds.fetch();             //this pulls the data from the datasource created above, now that I think about it it might not be needed
    var datasourcedata = ds.data();             //data from the datasource is stored in a temporary array,
    var startingDates = [];                 //in this for loop i pull the starting dates from the datasource and store them in this array
    for (var i = 0; i < datasourcedata.length; i++) {
        var dataitem = datasourcedata[i].start;          //this stores the starting date in a temporary variable, if you want to store description write datasourcedata[i].description
        startingDates[i]=dataitem;
        console.log(kendo.toString(dataitem, "dd/MM/yyyy HH/mm"));          //there are some logs, I will leave them for now but you should delete these of course
    }

</script>



<script type="text/javascript">

    /*next up we have a function that checks if an date in the calendar is a date located in some array, in our case if there is a date
    same as the one from the startingDates array it is going to be filtered and its background is going to be highlighted in the date range picker, the coloring part is done later in code*/

    function isInArray(date, dates) {
        for(var idx = 0, length = dates.length; idx < length; idx++) {
            var d = dates[idx];
            if (date.getFullYear() == d.getFullYear() &&
                date.getMonth() == d.getMonth() &&
                date.getDate() == d.getDate()) {
                return true;
            }
        }

        return false;
    }

    //callback function which initializes the scheduler and also hold on to scheduler change function
    $(function() {

        //scheduler change function is something like onEventClickListener, aka executes when you click on the event in the scheduler
        function scheduler_change(e) {
            var start = e.start; //selection start date
            var end = e.end; //selection end date
            var events = e.events;

            var dataItem = null;

            if (events.length) {
                ds.fetch(function () {
                    dataItem = ds.get(parseInt(events[events.length-1].id,10));  //links the item clicked on to variable dataItem
                });

                //
                document.getElementById("info").innerHTML = ("<strong>Item name: </strong>" + dataItem.title +"<br>" + "<strong>Starting date: </strong>" + kendo.toString(start, "dd/MM/yyyy  HH:mm") + "<br>" + "<strong>Ending date: </strong>" + kendo.toString(end, "dd/MM/yyyy HH:mm") + "<br>" + "<strong>Description: </strong>" + dataItem.desc) ;
                modal.style.display = "block";          //shows the popout box
                scheduler.select(null);         //unselects all the items, the schedle doesn't work very fluently if this is not here
            }
        }

        $("#scheduler").kendoScheduler({   //initializing the scheduler
            height: 100,
            views: [
                {type: "day"},
                {type: "week", selected: true},
                {type: "month"}
            ],
            timezone: "Etc/UTC",
            date: kendo.date.today(),
            dataSource: ds,  //linking with the dataSource
            selectable: true,
            editable: false,
            change: scheduler_change,   //function that is called when an item is selected
            eventTemplate: $("#event-template").html(),    //template of the item that is not an allDay event
            allDayEventTemplate: $("#allDayEvent-template").html(),    //
            majorTimeHeaderTemplate: kendo.template("<strong>#=kendo.toString(date, 'HH:mm')#</strong>"),
            dateHeaderTemplate: kendo.template("<strong>#= kendo.toString(date, 'dddd, dd/M')#")

        });


        //variable of the scheduler for function scheduler.select(null);    line: 81

        var scheduler = $("#scheduler").data("kendoScheduler");


        function fitWidget() {
            var widget = $("#scheduler").data("kendoScheduler");
            var height = $(window).outerHeight();

            //size widget to take the whole view
            widget.element.height(height);
            widget.resize(true);
        }

        //Adjust the calendar on window resize

        $(window).resize(function() {
            clearTimeout(window._resizeId);

            window._resizeId = setTimeout(function() {
                console.log("resize");
                fitWidget();
            }, 500);
        });

        fitWidget();



        var today = new Date();

        var schedDateLink = $('ul.k-scheduler-navigation').find('.k-nav-current');
        console.log(schedDateLink);
        schedDateLink.on('click', function(){



            console.log('Opening Calendar');
            setTimeout(function(){
                var schedCalendar = $('.k-scheduler-calendar.k-widget.k-calendar').data('kendoCalendar');
                console.log(schedCalendar);
                schedCalendar.setOptions({
                   weekNumber: false,
                    dates: startingDates,
                    date: today,
                    month: {
                        // template for dates in month view
                        content: '# if (isInArray(data.date, data.dates)) { #' +
                            '<div class="hasevent">#= data.value #</div>' +
                            '# } else { #' + '<div>#= data.value #</div>' + '# } #',
                        weekNumber:  '<a class="italic">#= data.weekNumber #</a>'
                    },
                    footer: "Today - #=kendo.toString(data, 'd') #",
                    open: function () {
                        var dateViewCalendar = this.dateView.calendar;
                        if (dateViewCalendar) {
                            dateViewCalendar.element.width(300);
                        }
                    }
                });
            }, 100);
        });
    });
  </script>
    <!-- The Modal -->
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <p id="info" style="font-size: large;"></p>
        </div>
    </div>

    <script>
        // Get the modal
        var modal = document.getElementById('myModal');

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

    </script>

</div>



</body>
</html>
