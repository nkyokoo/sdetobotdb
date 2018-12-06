<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Calendar</title>

    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2018.3.1017/styles/kendo.material-v2.min.css" />
    <link rel="stylesheet" href="calendar.css">

    <script src="https://code.jquery.com/jquery-1.12.3.min.js"></script>
    <script src="https://kendo.cdn.telerik.com/2018.2.620/js/angular.min.js"></script>
    <script src="https://kendo.cdn.telerik.com/2018.2.620/js/jszip.min.js"></script>
    <script src="https://kendo.cdn.telerik.com/2018.2.620/js/kendo.all.min.js"></script>
</head>
<body>

<div id="scheduler"></div>

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

    ds.fetch();
    var datasourcedata = ds.data();
    var startingDates = [];
    for (var i = 0; i < datasourcedata.length; i++) {
        var dataitem = datasourcedata[i].start;
        startingDates[i]=dataitem;
        console.log(kendo.toString(dataitem, "dd/MM/yyyy HH/mm"));
    }

</script>



<script type="text/javascript">


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


    $(function() {

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
            editable: true,
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


</body>
</html>