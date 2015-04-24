<html>
	<head>
		<title>Laravel</title>
		
		<link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
        <link href="{{ asset('/plugins/fullcalendar/css/jquery-ui-1.9.2.custom.css') }}" rel="stylesheet">
        <link href="{{ asset('/plugins/fullcalendar/css/fullcalendar.css') }}" rel="stylesheet">
        <link href="{{ asset('/plugins/fullcalendar/css/view_calendar.css') }}" rel="stylesheet">
        <link href="{{ asset('/plugins/fullcalendar/css/jquery.miniColors.css') }}" rel="stylesheet" type="text/css" />
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
            body{
                font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
                font-size: 12px;
            }

            #content_wrapper{
                width: 820px;
                margin-left: auto;
                margin-right: auto;
            }

            #calendar{
                width: 650px;
                float: left;
            }

            .btn{
                font-size: 85%
            margin-top: 10px;
            }

            #event_generation_wrapper{
                float: left;
                width: 120px;
                background-color: #DDD;
                margin-left: 20px;
                margin-top: 40px;
                border: 1px solid #4297D7;
                background-color: #FCFDFD;
                -moz-border-radius: 3px;
                -webkit-border-radius: 3px;
                border-radius: 3px;
                padding: 10px 5px 10px 5px;
            }

            #event_generation_wrapper .left{
                float: left;
                width: 70px;
            }

            #event_generation_wrapper .right{
                float: left;
                max-width: 25px;
                margin-left: 10px;
            }

            #event_generation_wrapper input{
                width: 112px;
            }

            #event_generation_wrapper textarea{
                width: 110px;
                height: 50px;
            }

            #event_generation_wrapper .miniColors-triggerWrap{
                margin-bottom: 5px;
            }

            #event_generation_wrapper .text{
                padding-top: 1px;
                margin-bottom: 5px;
                line-height: 10px;
            }


            #external_events{
                float: left;
                width: 130px;
                background-color: #DDD;
                margin-left: 20px;
                margin-top: 40px;
                border: 1px solid #4297D7;
                background-color: #FCFDFD;
                -moz-border-radius: 3px;
                -webkit-border-radius: 3px;
                border-radius: 3px;
            }

            #external_events .external-event{
                width: 100px;
                margin: 5px;
                font-family: Verdana, Arial, sans-serif;
                border: 1px solid #36C;
                padding: 3px;
                text-align: center;
                background-color: #36C;
                color: white;
                cursor: pointer;
                -moz-border-radius: 3px;
                -webkit-border-radius: 3px;
                border-radius: 3px;
            }

            #calendar .ui-widget-header{
                font-weight: normal;
                padding: 3px 3px 3px 3px;
            }

            #calendar .fc-header-title{
                font-weight: normal;
            }

            #external_event_template{
                display: none;
            }
		</style>
	</head>
	<body>
		<div class="container">
			<div class="content">
                <div id='calendar'></div>
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

                <!-- Booking types list -->
                <div id='external_events'>
                    <div id='external_event_template' class='external-event ui-draggable'>One Hour</div>
                </div>
            </div>
			</div>
		</div>
	</body>
</html>

<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js'></script>
<script src="{{ asset('/plugins/fullcalendar/jquery-ui-1.9.2.custom.min.js') }}"></script>
<script src="{{ asset('/plugins/fullcalendar/fullcalendar.js') }}"></script>
<script src="{{ asset('/plugins/fullcalendar/view_calendar.js') }}"></script>
<script src="{{ asset('/plugins/fullcalendar/jquery.miniColors.js') }}"></script>