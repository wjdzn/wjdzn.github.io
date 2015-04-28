@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Calendar
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<link href="{{ asset('/plugins/AdminJhon/vendors/fullcalendar/css/fullcalendar.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/plugins/AdminJhon/css/pages/calendar_custom.css') }}" rel="stylesheet" type="text/css" />
@stop


{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Calendar</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{route('admin')}}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Home
            </a>
        </li>
        <li>Calendar</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <div class="box">
                <div class="box-title">
                    <h3>Draggable Events</h3>
                    <div class="pull-right box-toolbar">
                        <a href="#" class="btn btn-link btn-xs" data-toggle="modal" data-target="#myModal"> <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="box-body">
                    <div id='external-events'>
                        <div class='external-event palette-warning'>Team Out</div>
                        <div class='external-event palette-primary'>Product Seminar</div>
                        <div class='external-event palette-danger'>Client Meeting</div>
                        <div class='external-event palette-info'>Repeating Event</div>
                        <div class='external-event palette-success'>Anniversary Celebrations</div>
                        <p class="well no-border no-radius">
                            <input type='checkbox' id='drop-remove' style="opacity:1 !important" />
                            <label for='drop-remove'>remove after drop</label>
                        </p>
                    </div>
                </div>
                <div class="box-footer">
                    <a href="#" class="btn btn-success btn-block" data-toggle="modal" data-target="#myModal">Create event</a>
                </div>
            </div>
            <!-- /.box --> </div>
        <div class="col-md-9">
            <div class="box">
                <div class="box-body">
                    <div id="calendar"></div>
                </div>
            </div>
            <!-- /.box --> </div>
        <!-- /.col --> </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">
                        <i class="fa fa-plus"></i>
                        Create Event
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="input-group">
                        <input type="text" id="new-event" class="form-control" placeholder="Event">
                        <div class="input-group-btn">
                            <button type="button" id="color-chooser-btn" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                Type
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu pull-right" id="color-chooser">
                                <li>
                                    <a class="palette-primary" href="#">Primary</a>
                                </li>
                                <li>
                                    <a class="palette-success" href="#">Success</a>
                                </li>
                                <li>
                                    <a class="palette-info" href="#">Info</a>
                                </li>
                                <li>
                                    <a class="palette-warning" href="#">warning</a>
                                </li>
                                <li>
                                    <a class="palette-danger" href="#">Danger</a>
                                </li>
                                <li>
                                    <a class="palette-default" href="#">Default</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /btn-group --> </div>
                    <textarea id="new-event-description" class="form-control">Description</textarea>
                    <!-- /input-group --> </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">
                        Close
                        <i class="fa fa-times"></i>
                    </button>
                    <button type="button" class="btn btn-success pull-left" id="add-new-event" data-dismiss="modal">
                        <i class="fa fa-plus"></i>
                        Add
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@section('footer_scripts')
<script src="{{ asset('/plugins/AdminJhon/vendors/fullcalendar/fullcalendar.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/plugins/AdminJhon/vendors/fullcalendar/calendarcustom.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
     /* initialize the external events
                 -----------------------------------------------------------------*/
        function ini_events(ele) {
            ele.each(function() {

                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                };

                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject);

                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 1070,
                    revert: true, // will cause the event to go back to its
                    revertDuration: 0 //  original position after the drag
                });

            });
        }
        ini_events($('#external-events div.external-event'));

        /* initialize the calendar
                 -----------------------------------------------------------------*/
        //Date for the calendar events (dummy data)
        var date = new Date();
        var d = date.getDate(),
            m = date.getMonth(),
            y = date.getFullYear();
        var data={_token:  $('meta[name="csrf-token"]').attr('content')}
        $.ajax({
            type: "POST",
            url: "{{route('calendar_events')}}",
            data: data,
            success: function (retrib) {
                var events = $.parseJSON(retrib);
                $('#calendar').fullCalendar({
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    buttonText: {
                        prev: "<span class='fa fa-caret-left'></span>",
                        next: "<span class='fa fa-caret-right'></span>",
                        today: 'today',
                        month: 'month',
                        week: 'week',
                        day: 'day'
                    },
                    events:events,
                    eventClick: function(calEvent, jsEvent, view) {
//                          Here go the code when someone click on an event div
//                        alert('Event id: ' + calEvent.id);
//                        alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
//                        alert('View: ' + view.name);
//
//                        // change the border color just for fun
//                        $(this).css('border-color', 'red');

                    },
                    eventDrop: function(calEvent, jsEvent, view) {
                        var hours = typeof $(this).find('.fc-event-time').html()!== "undefined"?$(this).find('.fc-event-time').html().split('-'):'';
                        var init =hours.length>0? hours[0].trim():calEvent.start.toLocaleTimeString();
                        var end = hours.length>1?hours[1].trim():
                        (parseInt(init.split(":")[0])+2)+":00";
                        var start = calEvent.start.toDateString()+" "+($('#calendar').fullCalendar('getView').name=="month"?calEvent.start.toLocaleTimeString():init);
                        var end =calEvent.end !== null?calEvent.end.toDateString()+" "+end:calEvent.start.toDateString()+" "+end;
                        var data = {id:calEvent.id,init_at:start,end_at:end,all_day:calEvent.allDay,_token:  $('meta[name="csrf-token"]').attr('content') };
                        $.ajax({
                            type: "POST",
                            url: "{{route('calendar_update_event')}}",
                            data: data,
                            success: function (retrib) {
                            }
                        });
                    },
                    eventResizeStop:function(calEvent, jsEvent, view) {
                        var hours = typeof $(this).find('.fc-event-time').html()!== "undefined"?$(this).find('.fc-event-time').html().split('-'):'';
                        var init =hours.length>0? hours[0].trim():calEvent.start.toLocaleTimeString();
                        var end = hours.length>1?hours[1].trim():
                        (parseInt(init.split(":")[0])+2)+":00";
                        var start = calEvent.start.toDateString()+" "+($('#calendar').fullCalendar('getView').name=="month"?calEvent.start.toLocaleTimeString():init);
                        var end =calEvent.end !== null?calEvent.end.toDateString()+" "+end:calEvent.start.toDateString()+" "+end;
                        var data = {id:calEvent.id,init_at:start,end_at:end,all_day:calEvent.allDay,_token:  $('meta[name="csrf-token"]').attr('content') };
                        $.ajax({
                            type: "POST",
                            url: "{{route('calendar_update_event')}}",
                            data: data,
                            success: function (retrib) {
                            }
                        });
                    },
                    editable: true,
                    droppable: true, // this allows things to be dropped onto the calendar !!!
                    drop: function(date, allDay) { // this function is called when something is dropped

                        // retrieve the dropped element's stored Event Object
                        var originalEventObject = $(this).data('eventObject');

                        // we need to copy it, so that multiple events don't have a reference to the same object
                        var copiedEventObject = $.extend({}, originalEventObject);

                        // assign it the date that was reported
                        copiedEventObject.start = date;
                        copiedEventObject.allDay = allDay;
                        copiedEventObject.backgroundColor = $(this).css("background-color");
                        copiedEventObject.borderColor = $(this).css("border-color");
                        copiedEventObject.id = -1;

                        // render the event on the calendar
                        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                        // is the "remove after drop" checkbox checked?
                        if ($('#drop-remove').is(':checked')) {
                            // if so, remove the element from the "Draggable Events" list
                            $(this).remove();
                        }
                        alert(allDay);
                        var data={all_day:allDay?1:0,name: $(this).html(),init_at:date.toDateString() , end_at:date.toDateString(),backgroundcolor:$(this).css("background-color"),  _token:  $('meta[name="csrf-token"]').attr('content')}
                        $.ajax({
                            type: "POST",
                            url: "{{route('calendar_save_event')}}",
                            data: data,
                            success: function (retrib) {
                                retrib = $.parseJSON(retrib);
                                var event = $('#calendar').fullCalendar( 'clientEvents',retrib);
                                if(event.length>0)
                                {
                                    $('#calendar').fullCalendar( 'removeEvents',-1);
                                    event[0].end = date;
                                    $('#calendar').fullCalendar('updateEvent', event[0]);
                                }
                                else
                                {
                                    event =  $('#calendar').fullCalendar( 'clientEvents',-1);
                                    event[0].id = retrib;
                                    $('#calendar').fullCalendar('updateEvent', event);
                                }

                                if(retrib==2)
                                {
                                    $(copiedEventObject).remove();
                                }
                                $( ".fc-event-close" ).each(function( index ) {
                                    $(this).click(function(e){
                                        var id=$(this).attr('data-id');
                                        $('#calendar').fullCalendar( 'removeEvents',id );
                                        var data = {id:id,_token:  $('meta[name="csrf-token"]').attr('content') };
                                        $.ajax({
                                            type: "POST",
                                            url: "{{route('calendar_delete_event')}}",
                                            data: data,
                                            success: function (retrib) {
                                            }
                                        });
                                    });
                                });
                            }
                        });
                    }
                });
                $( ".fc-event-close" ).each(function( index ) {
                    $(this).click(function(e){
                        var id=$(this).attr('data-id');
                        $('#calendar').fullCalendar( 'removeEvents',id );
                        var data = {id:id,_token:  $('meta[name="csrf-token"]').attr('content') };
                        $.ajax({
                            type: "POST",
                            url: "{{route('calendar_delete_event')}}",
                            data: data,
                            success: function (retrib) {
                            }
                        });
                    });
                });
            }
        });


        /* ADDING EVENTS */
        var currColor = "#418BCA"; //default
        //Color chooser button
        var colorChooser = $("#color-chooser-btn");
        $("#color-chooser > li > a").click(function(e) {
            e.preventDefault();
            //Save color
            currColor = $(this).css("background-color");
            //Add color effect to button
            colorChooser
                .css({
                    "background-color": currColor,
                    "border-color": currColor
                })
                .html($(this).text() + ' <span class="caret"></span>');
        });
        $("#add-new-event").click(function(e) {
            e.preventDefault();
            //Get value and make sure it is not null
            var val = $("#new-event").val();
            if (val.length == 0) {
                return;
            }

            //Create event
            var event = $("<div />");
            event.css({
                "background-color": currColor,
                "border-color": currColor,
                "color": "#fff"
            }).addClass("external-event");
            event.html(val);
            $('#external-events').prepend(event);

            //Add draggable funtionality
            ini_events(event);

            //Remove event from text input
            $("#new-event").val("");
        });
    });
    </script>
@stop