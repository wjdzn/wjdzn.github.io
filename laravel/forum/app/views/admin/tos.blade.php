@extends('../layouts/default')

@section('title')
{{Lang::get('messages.terms_of_service')}}
@stop

@section('content')
<div class="row">
    <div class="col-sm-3 box">
        <ul class='nav nav-pills nav-stacked'>
            <li><a href="{{URL::to('admin-panel')}}"><i class='fa fa-home'></i> {{Lang::get('messages.home')}}</a></li>
            <li><a href="{{URL::to('admin-panel/settings')}}"><i class='fa fa-wrench'></i> {{Lang::get('messages.basic_settings')}}</a></li>
            <li><a href="{{URL::to('admin-panel/themes')}}"><i class='fa fa-desktop'></i> {{Lang::get('messages.themes')}}</a></li>
            <li><a href="{{URL::to('admin-panel/users')}}"><i class='fa fa-group'></i> {{Lang::get('messages.users')}}</a></li>
            <li><a href="{{URL::to('admin-panel/reports')}}"><i class='fa fa-flag'></i> {{Lang::get('messages.reports')}}</a></li>
            <li><a href="{{URL::to('admin-panel/bans')}}"><i class='fa fa-ban'></i> {{Lang::get('messages.bans')}}</a></li>
            <li><a href="{{URL::to('admin-panel/tos')}}"><i class="fa fa-list"></i> {{Lang::get('messages.terms_of_service')}}</a></li>
        </ul>
    </div>
    <div class='col-sm-1'></div>
    <div class="col-sm-8 box">
        <h3 align="center"><i class="fa fa-list"></i> {{Lang::get('messages.terms_of_service')}}</h3>
        @if(Session::has('success'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>{{Session::get('success')}}</strong>
        </div>
        @endif
        <form method="post" accept="{{URL::to('admin-panel/tos')}}">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <strong>{{Lang::get('messages.terms_of_service')}}</strong>
            <textarea id="ss" name="tos" class="form-control"></textarea>
            <br>
            <button type="submit" class="btn btn-primary">{{Lang::get('messages.update')}}</button>
        </form>
    </div>
</div>
<script type="text/javascript">
    CKEDITOR.replace('ss');
            CKEDITOR.instances.ss.setData({{json_encode($tos->tos)}});
</script>
@stop