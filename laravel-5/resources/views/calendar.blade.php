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
    {{--<div class="pixfort_corporate_2">--}}
        {{--<section class="content">--}}
        {{--<div class="row">--}}
            {{--<div class="col-md-12">--}}
                {{--<div class="box">--}}
                    {{--<div class="box-body">--}}
                        {{--<div id="calendar"></div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<!-- /.box --> </div>--}}
            {{--<!-- /.col --> </div>--}}
        {{--<!-- Modal -->--}}
        {{--<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">--}}
            {{--<div class="modal-dialog">--}}
                {{--<div class="modal-content">--}}
                    {{--<div class="modal-header">--}}
                        {{--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>--}}
                        {{--<h4 class="modal-title" id="myModalLabel">--}}
                            {{--<i class="fa fa-plus"></i>--}}
                            {{--Create Event--}}
                        {{--</h4>--}}
                    {{--</div>--}}
                    {{--<div class="modal-body">--}}
                        {{--<div class="input-group">--}}
                            {{--<input type="text" id="new-event" class="form-control" placeholder="Event">--}}
                            {{--<div class="input-group-btn">--}}
                                {{--<button type="button" id="color-chooser-btn" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">--}}
                                    {{--Type--}}
                                    {{--<span class="caret"></span>--}}
                                {{--</button>--}}
                                {{--<ul class="dropdown-menu pull-right" id="color-chooser">--}}
                                    {{--<li>--}}
                                        {{--<a class="palette-primary" href="#">Primary</a>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<a class="palette-success" href="#">Success</a>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<a class="palette-info" href="#">Info</a>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<a class="palette-warning" href="#">warning</a>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<a class="palette-danger" href="#">Danger</a>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<a class="palette-default" href="#">Default</a>--}}
                                    {{--</li>--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                            {{--<!-- /btn-group --> </div>--}}
                        {{--<textarea id="new-event-description" class="form-control">Description</textarea>--}}
                        {{--<!-- /input-group --> </div>--}}
                    {{--<div class="modal-footer">--}}
                        {{--<button type="button" class="btn btn-danger pull-right" data-dismiss="modal">--}}
                            {{--Close--}}
                            {{--<i class="fa fa-times"></i>--}}
                        {{--</button>--}}
                        {{--<button type="button" class="btn btn-success pull-left" id="add-new-event" data-dismiss="modal">--}}
                            {{--<i class="fa fa-plus"></i>--}}
                            {{--Add--}}
                        {{--</button>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</section>--}}
    {{--</div>--}}
@stop

@section('footer_scripts')
    <script src="{{ asset('/plugins/AdminJhon/vendors/fullcalendar/fullcalendar.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/plugins/AdminJhon/vendors/fullcalendar/calendarcustom.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/calendar.js') }}" type="text/javascript"></script>
@stop