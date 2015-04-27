@extends('../layouts/default')

@section('title')
{{Lang::get('messages.admin_panel')}}
@stop

@section('content')
<div class="row">
    <div class="col-sm-3 box">
        <ul class='nav nav-pills nav-stacked'>
            <li class="active"><a href="{{URL::to('admin-panel')}}"><i class='fa fa-home'></i> {{Lang::get('messages.home')}}</a></li>
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
        <div class="row">
            <div class="col-xs-3">
                <div class="panel panel-default" style="min-height:150px;">
                    <div class="panel-body">
                        <center>
                            <h4><i class='fa fa-user fa-2x'></i><br><font style="font-size:23px;font-weight:bold">{{User::count()}}</font></h4>
                        </center></div>
                    <div class="panel-footer">
                        {{Lang::get('messages.registered_users')}}
                    </div>
                </div>
            </div>

            <div class="col-xs-3">
                <div class="panel panel-default" style="min-height:150px;">
                    <div class="panel-body">
                        <center>
                            <h4><i class='fa fa-user fa-2x'></i><br>  <font style="font-size:23px;font-weight:bold">{{User::where('last_seen','>',(time()-900))->count()}}</font></h4>
                        </center></div>
                    <div class="panel-footer">
                        {{Lang::get('messages.online_users')}}
                    </div>
                </div>
            </div>

            <div class="col-xs-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <center>
                            <h4><i class='fa fa-folder-o fa-2x'></i><br><font style="font-size:23px;font-weight:bold">{{Category::count()}}</font></h4>
                        </center>
                    </div>
                    <div class="panel-footer">
                        {{Lang::get('messages.categories')}}
                    </div>
                </div>
            </div>



            <div class="col-xs-3">
                <div class="panel panel-default" style="min-height:150px;">
                    <div class="panel-body">
                        <center>
                            <h4><i class='fa fa-folder-o fa-2x'></i><br> <font style="font-size:23px;font-weight:bold">{{Discussion::count()}}</font></h4>
                        </center></div>
                    <div class="panel-footer">
                        {{Lang::get('messages.discussions')}} 
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class='fa fa-star'></i> {{Lang::get('messages.most_popular_users')}}</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                                <tr style="height:20px;">
                                    <th>@ Email</th>
                                    <th><i class='fa fa-star-o'></i> Points</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(User::limit(3)->orderBy('points','DESC')->get() as $user)
                                <tr>
                                    <td class="col-md-9 vert-align"><a href="{{URL::to('profile/'.$user->email)}}">{{$user->email}}</a></td>
                                    <td class="col-md-3 vert-align">{{$user->points}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class='fa fa-list'></i> {{Lang::get('messages.most_popular_discussions')}}</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                                <tr style="height:20px;">
                                    <th>Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(Discussion::count()< 1)
                                <tr>
                                    <td class="vert-align" >
                                        <i class='fa fa-warning'></i> {{Lang::get('messages.there_are_not_any_discussions')}}
                                    </td>
                                </tr>
                                @endif
                                @foreach(Discussion::limit(3)->orderBy('views','DESC')->get() as $dis)
                                <tr>
                                    <td class="vert-align" style="word-wrap:break-word">
                                        <a href="{{URL::to('discussion/'.$dis->id)}}">{{$dis->title}}</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop