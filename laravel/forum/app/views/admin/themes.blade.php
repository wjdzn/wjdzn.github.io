@extends('../layouts/default')

@section('title')
{{Lang::get('messages.admin_panel')}}
@stop

@section('content')
<div class="row">
    <div class="col-sm-3 box">
        <ul class='nav nav-pills nav-stacked'>
            <li><a href="{{URL::to('admin-panel')}}"><i class='fa fa-home'></i> {{Lang::get('messages.home')}}</a></li>
            <li><a href="{{URL::to('admin-panel/settings')}}"><i class='fa fa-wrench'></i> {{Lang::get('messages.basic_settings')}}</a></li>
            <li class="active"><a href="{{URL::to('admin-panel/themes')}}"><i class='fa fa-desktop'></i> {{Lang::get('messages.themes')}}</a></li>
            <li><a href="{{URL::to('admin-panel/users')}}"><i class='fa fa-group'></i> {{Lang::get('messages.users')}}</a></li>
            <li><a href="{{URL::to('admin-panel/reports')}}"><i class='fa fa-flag'></i> {{Lang::get('messages.reports')}}</a></li>
            <li><a href="{{URL::to('admin-panel/bans')}}"><i class='fa fa-ban'></i> {{Lang::get('messages.bans')}}</a></li>
            <li><a href="{{URL::to('admin-panel/tos')}}"><i class="fa fa-list"></i> {{Lang::get('messages.terms_of_service')}}</a></li>
        </ul>
    </div>
    <div class='col-sm-1'></div>
    <div class="col-sm-8 box">
        <h3 align="center"><i class='fa fa-desktop'></i> {{Lang::get('messages.themes')}}</h3>
        @if(Session::has('success'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong><i class='fa fa-check'></i> {{Session::get('success')}}</strong>
        </div>
        @endif
        <form method="post" accept="{{URL::to('admin-panel/themes')}}">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <label>
                @if(Settings::first()->theme=='forumium')
                <input type="radio" name="theme" value="forumium" checked="checked">
                @else
                <input type="radio" name="theme" value="forumium">
                @endif
                Forumium
            </label><br>
            <label>
                @if(Settings::first()->theme=='mambo')
                <input type="radio" name="theme" value="mambo" checked="checked">
                @else
                <input type="radio" name="theme" value="mambo">
                @endif
                Mambo
            </label><br>
            <label>
                @if(Settings::first()->theme=='amnesia')
                <input type="radio" name="theme" value="amnesia" checked="checked">
                @else
                <input type="radio" name="theme" value="amnesia">
                @endif
                Amnesia
            </label><br>
            <label>
                @if(Settings::first()->theme=='galaxy')
                <input type="radio" name="theme" value="galaxy" checked="checked">
                @else
                <input type="radio" name="theme" value="galaxy">
                @endif
                Galaxy
            </label><br>
            <label>
                @if(Settings::first()->theme=='force')
                <input type="radio" name="theme" value="force" checked="checked">
                @else
                <input type="radio" name="theme" value="force">
                @endif
                Force
            </label><br>
            <label>
                @if(Settings::first()->theme=='base')
                <input type="radio" name="theme" value="base" checked="checked">
                @else
                <input type="radio" name="theme" value="base">
                @endif
                Base
            </label><br>
            <label>
                @if(Settings::first()->theme=='<blockquote></blockquote>')
                <input type="radio" name="theme" value="block" checked="checked">
                @else
                <input type="radio" name="theme" value="block">
                @endif
                Block
            </label>
            <br>
            <button type="submit" class="btn btn-primary">{{Lang::get('messages.update')}}</button>
        </form>
    </div>
</div>
@stop