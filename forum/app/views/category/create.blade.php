@extends('../layouts/default')

@section('title')
{{Lang::get('messages.create_category')}}
@stop

@section('content')
<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6 box">
        <h3 align="center"><i class='fa fa-list'></i> {{Lang::get('messages.create_category')}}</h3>
        @if(Session::has('error'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong><i class="fa fa-warning"></i> {{Session::get('error')}}</strong>
        </div>
        @endif
        <form method="post" action="{{URL::to('category')}}">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <strong>{{Lang::get('messages.name')}}</strong>
            <input type="text" name="title" class="form-control" maxlength="100">
            <strong>{{Lang::get('messages.description')}}:</strong>
            <textarea id="text" name="text"></textarea>
            <small>{{Lang::get('messages.limit_2000')}}</small>
            <br />
            <strong>{{Lang::get('messages.required_membership')}}:</strong><br />	
            <select name="membership">
                <option value="1">{{Lang::get('messages.normal_member')}}</option>
                <option value="2">{{Lang::get('messages.elite_member')}}</option>
                <option value="3">{{Lang::get('messages.moderator')}}</option>
                <option value="4">{{Lang::get('messages.administrator')}}</option>
            </select>
            <br />
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="logged">
                    {{Lang::get('messages.only_for_logged')}}
                </label>
            </div>
            <br />
            <button type="submit" class="btn btn-success">{{Lang::get('messages.create')}}</button>
        </form>
    </div>
    <div class="col-sm-3"></div>
</div>
<script type="text/javascript">
    CKEDITOR.replace('text');
</script>
@stop