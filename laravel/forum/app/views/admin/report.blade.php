@extends('../layouts/default')

@section('title')
{{Lang::get('messages.reports')}}
@stop

@section('content')
<div class="row">
    <div class="col-sm-3 box">
        <ul class='nav nav-pills nav-stacked'>
            <li><a href="{{URL::to('admin-panel')}}"><i class='fa fa-home'></i> {{Lang::get('messages.home')}}</a></li>
            <li><a href="{{URL::to('admin-panel/settings')}}"><i class='fa fa-wrench'></i> {{Lang::get('messages.basic_settings')}}</a></li>
            <li><a href="{{URL::to('admin-panel/themes')}}"><i class='fa fa-desktop'></i> {{Lang::get('messages.themes')}}</a></li>
            <li><a href="{{URL::to('admin-panel/users')}}"><i class='fa fa-group'></i> {{Lang::get('messages.users')}}</a></li>
            <li class="active"><a href="{{URL::to('admin-panel/reports')}}"><i class='fa fa-flag'></i> {{Lang::get('messages.reports')}}</a></li>
            <li><a href="{{URL::to('admin-panel/bans')}}"><i class='fa fa-ban'></i> {{Lang::get('messages.bans')}}</a></li>
            <li><a href="{{URL::to('admin-panel/tos')}}"><i class="fa fa-list"></i> {{Lang::get('messages.terms_of_service')}}</a></li>
        </ul>
    </div>
    <div class='col-sm-1'></div>
    <div class="col-sm-8 box">
        <i class='fa fa-tag'></i> <strong>{{Lang::get('messages.type')}}: </strong>
        @if($report->type==1)
        {{Lang::get('messages.reply')}}
        <br>
        <div class='well'>{{Post::find($report->entity_id)->text}}</div>
        @else
        {{Lang::get('messages.discussion')}}
        <br>
        <i class='fa fa-list'></i> <strong>{{Lang::get('messages.title')}}</strong>: <a href="{{URL::to('discussion/'.Discussion::find($report->entity_id)->id)}}">{{Discussion::find($report->entity_id)->title}}</a>
        @endif
        <br><i class='fa fa-user'></i> {{Lang::get('messages.reported_by')}} - <a href="{{URL::to('category/'.User::find($report->by_id)->email)}}">{{User::find($report->by_id)->email}}</a>
    </div>
</div>
@stop