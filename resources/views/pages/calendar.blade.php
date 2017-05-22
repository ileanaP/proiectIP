@extends('layouts.home')
@section('content')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#calendar').fullCalendar({
                googleCalendarApiKey: 'AIzaSyB2OIqOZ88NGTUiqj_y_YNFIthk9k2c4qQ',
                events: {
                    googleCalendarId: 'mjd3mg13mecqeb3ltcc9n4fmcc@group.calendar.google.com',
                    className: 'gcal-event',
                    events: 'https://calendar.google.com/calendar/embed?src=mjd3mg13mecqeb3ltcc9n4fmcc%40group.calendar.google.com&ctz=Europe/Bucharest'
                },
                header: {
                    left: '',
                    center: 'prev title next',
                    right: ''
                },
                defaultView: 'month',
                eventRender: function (event, element) {
                    element.attr('href', 'javascript:void(0);');
                    element.click(function() {
                        $("#startTime").html(moment(event.start).format('MMM Do h:mm A'));
                        $("#endTime").html(moment(event.end).format('MMM Do h:mm A'));
                        $("#eventInfo").html(event.description);
                        $("#eventLink").attr('href', event.url);
                        $("#eventContent").dialog({ modal: true, title: event.title, width:350});
                    });
                }
            });
            <!--$('#calendar').fullCalendar('next'); moves the calendar one something (depending on what you're looking at)-->
        });
    </script>
    <div id="calendar"></div>
    <div id="eventContent" title="Event Details" style="display:none;">
        Start: <span id="startTime"></span><br>
        End: <span id="endTime"></span><br><br>
        <p id="eventInfo"></p>
        <p><strong><a id="eventLink" href="" target="_blank">Read More</a></strong></p>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#calendarr').fullCalendar({
                googleCalendarApiKey: 'AIzaSyB2OIqOZ88NGTUiqj_y_YNFIthk9k2c4qQ',
                events: {
                    googleCalendarId: 'mjd3mg13mecqeb3ltcc9n4fmcc@group.calendar.google.com',
                    className: 'gcal-event' // an option!
                }
            });
        });
    </script>
    <div id="calendarr"></div>
@stop