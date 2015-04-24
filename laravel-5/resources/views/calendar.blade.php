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
			</div>
		</div>
	</body>
</html>
<script type="text/javascript">
    $(document).ready(function() {

        // page is now ready, initialize the calendar...

        $('#calendar').fullCalendar({
            googleCalendarApiKey: 'AIzaSyAwPtWpxcxLqmNgHT4cgq3_ZK7eXaDUJkc',
            events: {
                googleCalendarId: ' jfllopiz87@gmail.com'
            }
        })

    });
</script>
