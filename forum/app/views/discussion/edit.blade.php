@extends('../layouts/default')

@section('title')
{{Lang::get('messages.edit_a_discussion')}}
@stop

@section('content')
<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6 box">
        <h3 align="center"><i class="fa fa-pencil"></i> {{Lang::get('messages.edit_a_discussion')}}</h3>
        @if(Session::has('error'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong><i class="fa fa-warning"></i> {{Session::get('error')}}</strong>
        </div>
        @endif
        <form method="post" action="{{URL::to('discussion/'.$dis->id)}}">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" name="_method" value="put">
            <strong>{{Lang::get('messages.title')}} <small>({{Lang::get('messages.max_length_150')}})</small></strong>
            <input type="text" name="title" id="inputTitle" class="form-control" value="{{$dis->title}}">
            <strong>{{Lang::get('messages.description')}}</strong>
            <textarea name="text" id="text"></textarea>
            <small>{{Lang::get('messages.min_50')}}</small><br />
            <small>{{Lang::get('messages.limit_2000')}}</small>
            <br />
            <div class="checkbox">
                <label>
                    @if($dis->closed==1)
                    <input type="checkbox" name="closed" checked="checked">
                    @else
                    <input type="checkbox" name="closed">
                    @endif
                    {{Lang::get('messages.closed')}}
                </label>
            </div>
            <br />
            <button type="submit" class="btn btn-primary">{{Lang::get('messages.update')}}</button>
        </form>
    </div>
    <div class="col-sm-3"></div>
</div>
<script>
    CKEDITOR.replace('text');
    CKEDITOR.instances.text.setData('{{trim($dis->description)}}');
</script>
@stop