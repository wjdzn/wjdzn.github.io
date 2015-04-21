@extends('../layouts/default')

@section('title')
{{Lang::get('messages.users')}}
@stop

@section('content')
<div class="row">
    <div class="col-sm-3 box">
        <ul class='nav nav-pills nav-stacked'>
            <li><a href="{{URL::to('admin-panel')}}"><i class='fa fa-home'></i> {{Lang::get('messages.home')}}</a></li>
            <li><a href="{{URL::to('admin-panel/settings')}}"><i class='fa fa-wrench'></i> {{Lang::get('messages.basic_settings')}}</a></li>
            <li><a href="{{URL::to('admin-panel/themes')}}"><i class='fa fa-desktop'></i> {{Lang::get('messages.themes')}}</a></li>
            <li class="active"><a href="{{URL::to('admin-panel/users')}}"><i class='fa fa-group'></i> {{Lang::get('messages.users')}}</a></li>
            <li><a href="{{URL::to('admin-panel/reports')}}"><i class='fa fa-flag'></i> {{Lang::get('messages.reports')}}</a></li>
            <li><a href="{{URL::to('admin-panel/bans')}}"><i class='fa fa-ban'></i> {{Lang::get('messages.bans')}}</a></li>
    </div>
    <div class="col-sm-1"></div>
    <div class="col-sm-8 box">
        <h3 align="center"><i class='fa fa-group'></i> {{Lang::get('messages.users')}}</h3>
        @if($users->count()>10)
        {{Lang::get('messages.per_page')}}
        <a href="{{URL::to('setLimit/10')}}" class="btn btn-primary">10</a>
        @if($users->count()>20)
        <a href="{{URL::to('setLimit/20')}}" class="btn btn-primary">20</a>
        @if($users->count()>50)
        <a href="{{URL::to('setLimit/50')}}" class="btn btn-primary">50</a>
        @if($users->count()>100)
        <a href="{{URL::to('setLimit/100')}}" class="btn btn-primary">100</a>
        @endif
        @endif
        @endif
        @endif
        <div class='table-responsive'>
            <table class="table table-hover">
                <thead>
                    <tr style="height:20px;">
                        <th></th>
                        <th>{{Lang::get('messages.e-mail')}} <a href="{{URL::to('setOrder/email')}}"><i class='fa fa-arrows-v'></i></a></th>
                        <th>{{Lang::get('messages.type')}} <a href="{{URL::to('setOrder/first_name')}}"><i class='fa fa-arrows-v'></i></a></th>
                        <th>{{Lang::get('messages.ip_address')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td class="vert-align">
                            @if($user->email!=Session::get('logged') && $user->membership< User::where('email',Session::get('logged'))->first()->membership)
                            <a class="label label-danger" data-toggle="modal" href='#modal-user-del-{{$user->id}}'><i class="fa fa-trash-o"></i></a>
                            <div class="modal fade" id="modal-user-del-{{$user->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title"><i class="fa fa-warning"></i> {{Lang::get('messages.deleting_user')}}</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div id="error_delete_cat_{{$user->id}}"></div>
                                            {{Lang::get('messages.your_password')}}:
                                            <input type="password"  id="password_{{$user->id}}" class="form-control" required="required">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class='fa fa-times'></i> {{Lang::get('messages.cancel')}}</button>
                                            <button type="button" class="btn btn-primary" id="delete_cat_{{$user->id}}"><i class='fa fa-arrow-right'></i> {{Lang::get('messages.continue')}}</button>
                                            <a id="delete_final_category_{{$user->id}}" href="{{URL::to('user/'.$user->id.'/delete')}}" class="btn btn-danger" style="display:none"><i class='fa fa-trash-o'></i> {{Lang::get('messages.delete')}}</a>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                            <script type="text/javascript">
                                $("#delete_cat_{{$user->id}}").click(function() {
                                    $.ajax({
                                        url: '{{URL::to("checkPassword")}}',
                                        type: 'GET',
                                        data: {
                                            email: '{{Session::get("logged")}}',
                                            password: $("#password_{{$user->id}}").val()
                                        }
                                    }).done(function(data) {
                                        if (data == 1) {
                                            $("#delete_cat_{{$user->id}}").hide();
                                            $("#delete_final_category_{{$user->id}}").show();
                                        } else {
                                            $("#error_delete_cat_{{$user->id}}").html("<div class='alert alert-danger'><i class='fa fa-warning'></i> {{Lang::get('messages.wrong_password')}}</div>");
                                        }
                                    });
                                });
                            </script>
                            @endif
                        </td>
                        <td class="vert-align">
                            <a href="{{URL::to('profile/'.$user->email)}}">{{$user->email}}</a>
                            @if($user->email!=Session::get('logged'))
                            @if($user->membership< 4)
                            <a href="{{URL::to('user/'.$user->id.'/rankup')}}" style="color:green"><i class='fa fa-arrow-up'></i> </a>
                            @endif
                            @if($user->membership>1)
                            <a href="{{URL::to('user/'.$user->id.'/rankdown')}}" style="color:red"><i class='fa fa-arrow-down'></i> </a>
                            @endif
                            @endif
                        </td>
                        <td class="vert-align">
                            <?php
                            switch ($user->membership) {
                                case 1:echo 'Normal Member';
                                    break;
                                case 2:echo 'Elite Member';
                                    break;
                                case 3:echo 'Moderator';
                                    break;
                                case 4:echo 'Administrator';
                                    break;
                            }
                            ?>
                        </td>
                        <td class="vert-align">{{$user->ip}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <center>{{$users->links()}}</center>
    </div>
</div>
</div>
@stop