@extends('layouts/default')

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
    <div class="pixfort_corporate_2">
        <div class="calendar_section">
            <div class="sixteen columns context_style">
                <div class="logotext">
                    Calendar InventPalooza!
                </div>
                <div class="subtitle_style">
                    <h3 class="strapline">Work smarter, work safer, work together.</h3>
                </div>
            </div>
            <div class="container">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-body">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--<div class="pixfort_corporate_2">--}}
        {{--<section class="content">--}}
        {{--<div class="row">--}}

            {{--<!-- /.col --> </div>--}}
    </section>
    </div>
@stop

@section('footer_scripts')
    <script src="{{ asset('/plugins/AdminJhon/vendors/fullcalendar/fullcalendar.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/plugins/AdminJhon/vendors/fullcalendar/calendarcustom.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/calendar.js') }}" type="text/javascript"></script>
<<<<<<< HEAD
@stop
=======
@stop
>>>>>>> f9eb8f2935e210dc911e20d1ac3f5a5339b5f8e8
