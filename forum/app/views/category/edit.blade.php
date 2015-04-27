@extends('../layouts/default')

@section('title')
{{Lang::get('messages.edit_a_category')}}
@stop

@section('content')
<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6 box">
        <h3 align="center"><i class='fa fa-edit'></i> {{Lang::get('messages.edit_a_category')}}</h3>
        @if(Session::has('error'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>{{Session::get('error')}}</strong>
        </div>
        @endif
        <form method="post" action="{{URL::to('category/'.$category->id)}}">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" name="_method" value="PUT">
            <strong>{{Lang::get('messages.name')}}</strong>
            <input type="text" name="name" value="{{$category->name}}" class="form-control" maxlength="100">
            <strong>{{Lang::get('messages.description')}}:</strong>
            <textarea id="text" name="text"></textarea>
            <small>{{Lang::get('messages.limit_2000')}}</small>
            <br />
            <strong>{{Lang::get('messages.required_membership')}}:</strong><br />	
            <select name="membership">
                @if($category->min_membership==1)
                <option value="1" selected="selected">{{Lang::get('messages.normal_member')}}</option>
                @else
                <option value="1">{{Lang::get('messages.normal_member')}}</option>
                @endif
                @if($category->min_membership==2)
                <option value="2" selected="selected">{{Lang::get('messages.elite_member')}}</option>
                @else
                <option value="2">{{Lang::get('messages.elite_member')}}</option>
                @endif
                @if($category->min_membership==3)
                <option value="3" selected="selected">{{Lang::get('messages.moderator')}}</option>
                @else
                <option value="3">{{Lang::get('messages.moderator')}}</option>
                @endif
                @if($category->min_membership==4)
                <option value="4" selected="selected">{{Lang::get('messages.administrator')}}</option>
                @else
                <option value="4">{{Lang::get('messages.administrator')}}</option>
                @endif
            </select>
            <br />
            <div class="checkbox">
                <label>
                    @if($category->must_logged==1)
                    <input type="checkbox" name="logged" checked="checked">
                    @else
                    <input type="checkbox" name="logged">
                    @endif
                    {{Lang::get('messages.only_for_logged')}}
                </label>
            </div>
            <button type="submit" class="btn btn-primary pull-right"><i class='fa fa-arrow-up'></i> {{Lang::get('messages.update')}}</button>
        </form>
    </div>
    <div class="col-sm-3"></div>
</div>
<script type="text/javascript">
    CKEDITOR.replace('text');
    CKEDITOR.instances.text.setData('{{trim($category->description)}}');
</script>
@stop