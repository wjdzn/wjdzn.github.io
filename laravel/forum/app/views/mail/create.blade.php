@extends('../layouts/default')

@section('title')
{{Lang::get('messages.send_message')}}
@stop

@section('content')
<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6 box">
        <h3 align="center"><i class="fa fa-send"></i> {{Lang::get('messages.send_message')}}</h3>
        @if(Session::has('error'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong><i class="fa fa-warning"></i> {{Session::get('error')}}</strong>
        </div>
        @endif
        @if(Session::has('success'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong><i class="fa fa-check"></i> {{Session::get('success')}}</strong>
        </div>
        @endif
        <form method="post" action="{{URL::to('message/create')}}">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" name="to_id" value="{{Request::segment(3)}}">
            <strong>{{Lang::get('messages.subject')}}:</strong>
            <input type="text" name="title" id="inputTitle" maxlength="155" class="form-control">
            <strong>{{Lang::get('messages.message')}}:</strong>
            <textarea id="text" name="text"></textarea>
            <small>{{Lang::get('messages.min_50')}}</small><br />
            <small>{{Lang::get('messages.limit_1000')}}</small><br /><br />
            <div class="label label-danger">{{$first}} + {{$second}} = <input type="text" name="answer" maxlength="2" style="color:#000;width:40px;max-height:100%;border-radius:3px;"></div>
            <br />
            <br />
            <button type="submit" class="btn btn-success">{{Lang::get('messages.send')}}</button>
        </form>
    </div>
    <div class="col-sm-3"></div>
</div>
<script type="text/javascript">
    CKEDITOR.replace('text');
</script>
@stop