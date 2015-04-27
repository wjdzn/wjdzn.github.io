@extends('../layouts/default')

@section('title')
{{Lang::get('messages.bans')}}
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
            <li class="active"><a href="{{URL::to('admin-panel/bans')}}"><i class='fa fa-ban'></i> {{Lang::get('messages.bans')}}</a></li>
            <li><a href="{{URL::to('admin-panel/tos')}}"><i class="fa fa-list"></i> {{Lang::get('messages.terms_of_service')}}</a></li>
        </ul>
    </div>
    <div class='col-sm-1'></div>
    <div class="col-sm-8 box">
        <a href="{{URL::to('ban/create')}}" class="btn btn-danger"><i class="fa fa-ban"></i> {{Lang::get('messages.ban_user_or_ip')}}</a>
        <h3 align="center"><i class='fa fa-ban text-danger'></i> {{Lang::get('messages.bans')}}</h3>
        <div class='table-responsive'>
            <table class="table table-hover">
                <thead>
                    <tr style="height:20px;">
                        <th>{{Lang::get('messages.type')}}</th>
                        <th>{{Lang::get('messages.ip_address')}}/{{Lang::get('messages.user')}}</th>
                        <th>{{Lang::get('messages.unban')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @if($bans->count()< 1)
                    <tr>
                        <td class="vert-align"><i class="fa fa-warning"></i> {{Lang::get('messages.there_are_not_any_banned_users_or_ips')}}</td>
                        <td></td>
                        <td></td>
                    </tr>
                    @endif
                    @foreach($bans as $ban)
                    <tr>
                        <td class="vert-align">
                            @if($ban->BannedIp==1)
                            {{Lang::get('messages.ip_address')}}
                            @else
                            {{Lang::get('messages.user')}}
                            @endif
                        </td>
                        <td class="vert-align">
                            @if($ban->BannedIp==1)
                            {{$ban->ip}}
                            @else
                            <a href="{{URL::to('profile/'.User::find($ban->user_id)->email)}}">{{User::find($ban->user_id)->email}}</a>
                            @endif
                        </td>
                        <td class="vert-align col-md-1">
                            <a href="{{URL::to('ban_remove/'.$ban->id)}}" class="label label-success"><i class="fa fa-check"></i> {{Lang::get('messages.unban')}}</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <center>{{$bans->links()}}</center>
        </div>
    </div>
</div>
@stop