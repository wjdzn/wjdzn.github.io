<html>
	<head>
		<title>Laravel</title>
		
		<link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
        <link href="{{ asset('/plugins/fullcalendar/fullcalendar.css') }}" rel="stylesheet">
        <link href="{{ asset('/plugins/fullcalendar/fullcalendar.css') }}" rel="stylesheet">
        <script src="{{ asset('/plugins/fullcalendar/lib/jquery.min.js') }}"></script>
        <script src="{{asset('/plugins/fullcalendar/lib/moment.min.js')}}"></script>
        <script src="{{ asset('/plugins/fullcalendar/fullcalendar.js') }}"></script>
        <script src="{{ asset('/plugins/fullcalendar/gcal.js') }}"></script>
		<style>
			body {
				margin: 0;
				padding: 0;
				width: 100%;
				height: 100%;
				color: #B0BEC5;
				display: table;
				font-weight: 100;
				font-family: 'Lato';
			}

			.container {
				text-align: center;
				display: table-cell;
				vertical-align: middle;
			}

			.content {
				text-align: center;
				display: inline-block;
			}

			.title {
				font-size: 96px;
				margin-bottom: 40px;
			}

			.quote {
				font-size: 24px;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="content">
                <div id='calendar'></div>
                <iframe src="https://www.google.com/calendar/embed?src=jfllopiz87%40gmail.com&ctz=America/New_York" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
                <div id="eventContent" title="Event Details" style="display:none;">
                    Start: <span id="startTime"></span><br>
                    End: <span id="endTime"></span><br><br>
                    <p id="eventInfo"></p>
                    <p><strong><a id="eventLink" href="" target="_blank">Read More</a></strong></p>
                </div>
			</div>
		</div>
	</body>
</html>
<script type="text/javascript">
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            events: source,
            header: {
                left: '',
                center: 'prev title next',
                right: ''
            },
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
    });
</script>
