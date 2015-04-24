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
                <iframe src="https://www.google.com/calendar/embed?src=jfllopiz87%40gmail.com&ctz=America/New_York" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
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
			</div>
		</div>
	</body>
</html>

<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js'></script>
<script src="{{ asset('/plugins/fullcalendar/jquery-ui-1.9.2.custom.min.js') }}"></script>
<script src="{{ asset('/plugins/fullcalendar/fullcalendar.js') }}"></script>
<script src="{{ asset('/plugins/fullcalendar/view_calendar.js') }}"></script>
<script src="{{ asset('/plugins/fullcalendar/jquery.miniColors.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function(){

        //Initialisations
        initialise_calendar();
        initialise_color_pickers();
        initialise_buttons();
        initialise_event_generation();
        initialise_update_event();
    });


    /* Initialise buttons */
    function initialise_buttons(){

        $('.btn').button();
    }


    /* Binds and initialises event generation functionality */
    function initialise_event_generation(){

        //Bind event
        $('#btn_gen_event').bind('click', function(){

            //Retrieve template event
            var template_event = $('#external_event_template').clone();
            var background_color = $('#txt_background_color').val();
            var border_color = $('#txt_border_color').val();
            var text_color = $('#txt_text_color').val();
            var title = $('#txt_title').val();
            var description = $('#txt_description').val();
            var price = $('#txt_price').val();
            var available = $('#txt_available').val();

            //Edit id
            $(template_event).attr('id', get_uni_id());

            //Add template data attributes
            $(template_event).attr('data-background', background_color);
            $(template_event).attr('data-border', border_color);
            $(template_event).attr('data-text', text_color);
            $(template_event).attr('data-title', title);
            $(template_event).attr('data-description', description);
            $(template_event).attr('data-price', price);
            $(template_event).attr('data-available', available);

            //Style external event
            $(template_event).css('background-color', background_color);
            $(template_event).css('border-color', border_color);
            $(template_event).css('color', text_color);

            //Set text of external event
            $(template_event).text(title);

            //Append to external events container
            $('#external_events').append(template_event);

            //Initialise external event
            initialise_external_event('#' + $(template_event).attr('id'));

            //Show
            $(template_event).fadeIn(2000);
        });
    }


    /* Initialise external events */
    function initialise_external_event(selector){

        //Initialise booking types
        $(selector).each(function(){

            //Make draggable
            $(this).draggable({
                revert: true,
                revertDuration: 0,
                zIndex: 999,
                cursorAt: {
                    left: 10,
                    top: 1
                }
            });

            //Create event object
            var event_object = {
                title: $.trim($(this).text())
            };

            //Store event in dom to be accessed later
            $(this).data('eventObject', event_object);
        });
    }


    /* Initialise color pickers */
    function initialise_color_pickers(){

        //Initialise color pickers
        $('.color_picker').miniColors({
            'trigger': 'show',
            'opacity': 'none'
        });
    }


    /* Initialises calendar */
    function initialise_calendar(){

        //Initialise calendar
        $('#calendar').fullCalendar({
            theme: true,
            firstDay: 1,
            header: {
                left: 'today prev,next',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            defaultView: 'agendaWeek',
            minTime: '6:00am',
            maxTime: '6:00pm',
            allDaySlot: false,
            columnFormat: {
                month: 'ddd',
                week: 'ddd dd/MM',
                day: 'dddd M/d'
            },
            eventSources: [
                {
                    url: '{{ asset('/plugins/fullcalendar/calendar_events.json') }}',
                    editable: false
                }
            ],
            droppable: true,
            drop: function(date, all_day){
                external_event_dropped(date, all_day, this);
            },
            eventClick: function(cal_event, js_event, view){
                calendar_event_clicked(cal_event, js_event, view);
            },
            editable: true
        });

        //Initialise external events
        initialise_external_event('.external-event');
    }


    /* Handle an external event that has been dropped on the calendar */
    function external_event_dropped(date, all_day, external_event){

        //Create vars
        var event_object;
        var copied_event_object;
        var duration = 60;
        var cost;

        //Retrive dropped elemetns stored event object
        event_object = $(external_event).data('eventObject');

        //Copy so that multiple events don't reference same object
        copied_event_object = $.extend({}, event_object);

        //Assign reported start and end dates
        copied_event_object.start = date;
        copied_event_object.end = new Date(date.getTime() + duration * 60000);
        copied_event_object.allDay = all_day;

        //Assign colors etc
        copied_event_object.backgroundColor = $(external_event).data('background');
        copied_event_object.textColor = $(external_event).data('text');
        copied_event_object.borderColor = $(external_event).data('border');

        //Assign text, price, etc
        copied_event_object.id = get_uni_id();
        copied_event_object.title = $(external_event).data('title');
        copied_event_object.description = $(external_event).data('description');
        copied_event_object.price = $(external_event).data('price');
        copied_event_object.available = $(external_event).data('available');

        //Render event on calendar
        $('#calendar').fullCalendar('renderEvent', copied_event_object, true);
    }


    /* Initialise event clicks */
    function calendar_event_clicked(cal_event, js_event, view){

        //Set generation values
        set_event_generation_values(cal_event.id, cal_event.backgroundColor, cal_event.borderColor, cal_event.textColor, cal_event.title, cal_event.description, cal_event.price, cal_event.available);
    }


    /* Set event generation values */
    function set_event_generation_values(event_id, bg_color, border_color, text_color, title, description, price, available){

        //Set values
        $('#txt_background_color').miniColors('value', bg_color);
        $('#txt_border_color').miniColors('value', border_color);
        $('#txt_text_color').miniColors('value', text_color);
        $('#txt_title').val(title);
        $('#txt_description').val(description);
        $('#txt_price').val(price);
        $('#txt_available').val(available);
        $('#txt_current_event').val(event_id);
    }


    /* Generate unique id */
    function get_uni_id(){

        //Generate unique id
        return new Date().getTime() + Math.floor(Math.random()) * 500;
    }


    /* Initialise update event button */
    function initialise_update_event(){
        var test = $('#calendar').fullCalendar( 'clientEvents');
        //Bind event
        $('#btn_update_event').bind('click', function(){

            //Create vars
            var current_event_id = $('#txt_current_event').val();

            //Check if value found
            if(current_event_id){

                //Retrieve current event
                var current_event = $('#calendar').fullCalendar('clientEvents', current_event_id);

                //Check if found
                if(current_event && current_event.length == 1){

                    //Retrieve current event from array
                    current_event = current_event[0];

                    //Set values
                    current_event.backgroundColor = $('#txt_background_color').val();
                    current_event.textColor = $('#txt_text_color').val();
                    current_event.borderColor = $('#txt_border_color').val();
                    current_event.title = $('#txt_title').val();
                    current_event.description = $('#txt_description').val();
                    current_event.price = $('#txt_price').val();
                    current_event.available = $('#txt_available').val();

                    //Update event
                    $('#calendar').fullCalendar('updateEvent', current_event);
                }
            }
        });
    }
</script>
