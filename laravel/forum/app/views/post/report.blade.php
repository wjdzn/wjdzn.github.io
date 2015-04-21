@extends('../layouts/default')

@section('title')
{{Lang::get('messages.report')}}
@stop

@section('content')
<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6 box">
        <h3 align="center"><i class='fa fa-pencil'></i> {{Lang::get('messages.report')}}</h3>
        @if(Session::has('error'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>{{Session::get('error')}}</strong>
        </div>
        @endif
        @if(Session::has('success'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>{{Session::get('success')}}</strong>
        </div>
        @endif
        {{Lang::get('messages.type')}}: {{$type}}<br />
        @if($type=="Post")
        <?php $var = 1; ?>
        {{$entity->text}}
        @else
        <?php $var = 2; ?>
        {{Lang::get('messages.title')}}: 
        {{$entity->title}}
        @endif
        <form method="post" action="{{URL::to('report')}}">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" name="type" value="{{$var}}">
            <input type="hidden" name="id" value="{{$entity->id}}">
            <strong>{{Lang::get('messages.reason')}}</strong>
            <textarea maxlength="1000" class="form-control" id="reason" name="report" rows="6"></textarea>
            <div class="label label-success" id="char_count">0</div>
            <br><br>
            <button type="submit" class="btn btn-success">{{Lang::get('messages.submit')}}</button>
        </form>
    </div>
    <div class="col-sm-3"></div>
</div>
<script>
    $("#reason").keydown(function(e) {
        $("#char_count").html($("#reason").val().trim().length);
    });
</script>
@stop