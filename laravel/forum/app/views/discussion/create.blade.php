@extends('../layouts/default')

@section('title')
{{Lang::get('messages.start_discussion')}}
@stop

@section('content')
<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6 box">
        <h3 align="center"><i class="fa fa-pencil"></i> {{Lang::get('messages.start_discussion')}}</h3>
        @if(Session::has('error'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong><i class="fa fa-warning"></i> {{Session::get('error')}}</strong>
        </div>
        @endif
        <form method="post" action="{{URL::to('discussion/'.$cat_id)}}">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <strong>{{Lang::get('messages.title')}} <small>({{Lang::get('messages.max_length_150')}})</small></strong>
            <input type="text" name="title" class="form-control" maxlength="100" value="{{Input::old('title')}}">
            <strong>{{Lang::get('messages.description')}}:</strong>
            <textarea id="text" name="text"></textarea>
            <small>{{Lang::get('messages.min_50')}}</small><br />
            <small>{{Lang::get('messages.limit_2000')}}</small>
            <br />
            @if(User::where('email', Session::get('logged'))->first()->membership>=3)
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="announcement">
                    Announcement
                </label>
            </div>
            @endif
            <span class="label label-warning">{{$first." + ".$second}}</span> = <input type="text" name="answer" style="width:30px;height:20px;text-align:center" maxlength="2" maxlength="60"><br /><br />
            <button type="submit" class="btn btn-success">{{Lang::get('messages.create')}}</button>
        </form>
    </div>
    <div class="col-sm-3"></div>
</div>
<script type="text/javascript">
    CKEDITOR.replace('text');
    CKEDITOR.instances.text.setData('{{trim(Input::old("text"))}}');
</script>
@stop