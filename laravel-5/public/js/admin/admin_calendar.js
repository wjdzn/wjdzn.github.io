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
        url: (window.location.toString().indexOf('calendar')>0?"":"admin/")+"calendar/events",
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
                    putClickEvent();
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
                        url: (window.location.toString().indexOf('calendar')>0?"":"admin/")+"calendar/update",
                        data: data,
                        success: function (retrib) {
                            putClickEvent();
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
                        url: (window.location.toString().indexOf('calendar')>0?"":"admin/")+"calendar/update",
                        data: data,
                        success: function (retrib) {
                            putClickEvent();
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
                    var data={all_day:allDay?1:0,name: $(this).html(),init_at:date.toDateString() , end_at:date.toDateString(),backgroundcolor:$(this).css("background-color"),  _token:  $('meta[name="csrf-token"]').attr('content')}
                    $.ajax({
                        type: "POST",
                        url: (window.location.toString().indexOf('calendar')>0?"":"admin/")+"calendar/save",
                        data: data,
                        success: function (retrib) {
                            retrib = $.parseJSON(retrib);
                            var events = $('#calendar').fullCalendar( 'clientEvents',retrib);
                            if(events.length>0)
                            {
                                var event = events[0];
                                $('#calendar').fullCalendar( 'removeEvents',-1);
                                event.end = date;
                                $('#calendar').fullCalendar('updateEvent', event);
                            }
                            else
                            {
                                events =  $('#calendar').fullCalendar( 'clientEvents',-1);
                                var event = events[0];
                                event.id = retrib;
                                event._id = retrib;
                                $(event).attr('data-id',retrib);
                                $('#calendar').fullCalendar('updateEvent', event);
                            }
                            putClickEvent();
                        }
                    });
                }
            });
            putClickEvent();
        }
    });
    function putClickEvent()
    {
        $(".fc-event-close").each(function(e) {
            $(this).on("click", function(){
                var id=$(this).attr('data-id');
                $('#calendar').fullCalendar( 'removeEvents',id );
                var data = {id:id,_token:  $('meta[name="csrf-token"]').attr('content') };
                $.ajax({
                    type: "POST",
                    url: (window.location.toString().indexOf('calendar')>0?"":"admin/")+"calendar/delete",
                    data: data,
                    success: function (retrib) {
                        putClickEvent();
                    }
                });
            });
        });
    }

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
    putClickEvent();
});
