<html>
	<head>
		<title>Laravel</title>
		
		<link href="{{ asset('/plugins/fullcalendar/css/jquery-ui-1.9.2.custom.css') }}" rel="stylesheet">
        <link href="{{ asset('/plugins/fullcalendar/css/fullcalendar.css') }}" rel="stylesheet">
        <link href="{{ asset('/plugins/fullcalendar/css/view_calendar.css') }}" rel="stylesheet">
        <link href="{{ asset('/plugins/fullcalendar/css/jquery.miniColors.css') }}" rel="stylesheet" type="text/css" />
	</head>
	<body>
    <div id="content_wrapper">

        <!-- Calendar div -->
        <div id="calendar">
        </div>

        <!-- Event generation -->
        <div id="event_generation_wrapper">
            <div class='left'>
                <div class='text'>Background:</div><br />
                <div class='text'>Border:</div><br />
                <div class='text'>Text:</div><br />
            </div>
            <div class='right'>
                <input id="txt_background_color" type='hidden' class='color_picker' value='#2795C3' /><br />
                <input id="txt_border_color" type='hidden' class='color_picker' value='#6AB3D3' /><br />
                <input id="txt_text_color" type='hidden' class='color_picker' value='#ffffff' /><br />
            </div>
            <input id='txt_title' type='text' value='Title' /><br />
            <textarea id='txt_description'>Description</textarea><br />
            <input id='txt_price' type='text' value='5.00' /><br />
            <input id='txt_available' type='text' value='5' /><br />
            <input id="btn_gen_event" type="button" value="New Template" class='btn' />
            <input id="btn_update_event" type="button" value="Update Event" class='btn'/>
            <input id="txt_current_event" type="hidden" value="" />
        </div>

        <!-- Booking types list -->
        <div id='external_events'>
            <div id='external_event_template' class='external-event ui-draggable'>One Hour</div>
        </div>
    </div>
    <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js'></script>
    <script src="{{ asset('/plugins/fullcalendar/jquery-ui-1.9.2.custom.min.js') }}"></script>
    <script src="{{ asset('/plugins/fullcalendar/fullcalendar.js') }}"></script>
    <script src="{{ asset('/plugins/fullcalendar/view_calendar.js') }}"></script>
    <script src="{{ asset('/plugins/fullcalendar/jquery.miniColors.js') }}"></script>
	</body>
</html>

