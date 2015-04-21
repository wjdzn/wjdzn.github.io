@extends('../layouts/default')

@section('title')
{{Lang::get('messages.profile')}}
@stop

@section('content')

<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <?php
        if (Session::has('logged')) {
            $my_id = User::where('email', Session::get('logged'))->first()->id;
        }
        ?>
        @if(Session::has('error'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong><i class='fa fa-warning'></i> {{Session::get('error')}}</strong>
        </div>
        @endif
        @if(Session::has('success'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong><i class="fa fa-check"></i> {{Session::get('success')}}</strong>
        </div>
        @endif

        <div class="box">
            @if(Ban::where('user_id',$user->id)->where('BannedUser',1)->where('ban_to','>',time())->count()>0)
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong><i class="fa fa-warning"></i> {{Lang::get('messages.this_user_is_banned')}}</strong>
            </div>
            @endif
            @if(Session::has('logged'))
            @if(Session::get('logged')==$user->email)
            @if(!File::exists('assets/images/profile/'.$user->id.'.jpg') && !File::exists('assets/images/profile/'.$user->id.'.png'))
            <div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong><i class="fa fa-info"></i> {{Lang::get('messages.click_on_the_picture_to_change')}}</strong>
            </div>
            @endif
            @if($user->fb_id!="")
            @if(File::exists('assets/images/profile/'.$user->id.'.jpg') || File::exists('assets/images/profile/'.$user->id.'.png'))
            <br />
            <a href="{{URL::to('user/restoreFbImage')}}" class="label label-primary"><i class="fa fa-refresh"></i> {{Lang::get('messages.use_fb_image')}}</a>
            <br />
            @endif
            @endif
            <form method="post" enctype="multipart/form-data" action="{{URL::to('user/changeimg')}}" id="change_profile_pic_form">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <input type="file" name="file" style="display:none" id="file">
            </form>
            @endif
            @endif
            @if(Session::has('logged'))
            @if(Session::get('logged')==$user->email)
            @if($user->fb_id!="" && $user->password=="")
            <div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong><i class="fa fa-warning"></i> {{Lang::get('messages.facebook_set_password')}}</strong>
            </div>
            @endif
            @endif
            @if(Session::has('logged'))
            @if(Session::get('logged')==$user->email)
            <div class="btn-group">
                @if($user->fb_id!="" && $user->password=="")
                <a href="{{URL::to('user/set_password')}}" class="btn btn-primary"><i class="fa fa-cog"></i> {{Lang::get('messages.set_password')}}</a>
                @else
                <a href="{{URL::to('user/change_password')}}"  class="btn btn-primary"><i class="fa fa-cog"></i> {{Lang::get('messages.change_password')}}</a>
                @endif
                <a href="{{URL::to('my_settings')}}" class="btn btn-primary"><i class="fa fa-wrench"></i> {{Lang::get('messages.my_settings')}}</a>
            </div>
            @else
            <div class="btn-group">
                @if(Friendship::exists($my_id,$user->id))
                @if(Friendship::areFriends($my_id,$user->id))
                <a href="{{URL::to('addfriend/'.$user->id)}}" class="btn btn-success"><i class="fa fa-check"></i> {{Lang::get('messages.remove_from_friends_list')}}</a>
                @else
                <a href="{{URL::to('addfriend/'.$user->id)}}" class="btn btn-danger"><i class="fa fa-times"></i> {{Lang::get('messages.cancel_request')}}</a>
                @endif
                @else
                <a href="{{URL::to('addfriend/'.$user->id)}}" class="btn btn-success"><i class="fa fa-send"></i> {{Lang::get('messages.add_friends_list')}}</a>
                @endif
                <a href="{{URL::to('message/create/'.$user->id)}}" class="btn btn-success"><i class="fa fa-send"></i> {{Lang::get('messages.send_message')}}</a>
            </div>
            @if(User::where('email',Session::get('logged'))->first()->membership>=4)
            @if(User::isMuted($user->email))
            <a href="{{URL::to('unmute/'.$user->id)}}" class="btn btn-warning">
                <i class="fa fa-comment"></i>
                {{Lang::get('messages.unmute')}}</a>
            @else
            <a href="{{URL::to('mute/'.$user->id)}}" class="btn btn-warning">
                <i class="fa fa-comment"></i>
                {{Lang::get('messages.mute')}}</a>
            @endif
            <div clsss="btn-group">
                @if($user->membership< 4)
                <a href="{{URL::to('user/'.$user->id.'/rankup')}}" class="btn btn-success"><i class="fa fa-arrow-up"></i> {{Lang::get('messages.rank_up')}}</a>
                @endif
                @if($user->membership>1)
                <a href="{{URL::to('user/'.$user->id.'/rankdown')}}" class="btn btn-danger"><i class="fa fa-arrow-down"></i> {{Lang::get('messages.rank_down')}}</a>
                @endif
            </div>
            @endif
            @endif
            @endif

            @endif

            <hr>


            <div class="row">
                <div class="col-sm-7">
                    <div class="media block-update-card">
                        <a class="pull-left" href="#">
                            @if($user->fb_id!="" && !File::exists('assets/images/profile/'.$user->id.'.png') && !File::exists('assets/images/profile/'.$user->id.'.jpg'))
                            <img class="media-object update-card-MDimentions" src="https://graph.facebook.com/{{$user->fb_id}}/picture?type=large" id="profile_pic" alt="...">
                            @else
                            @if(File::exists('assets/images/profile/'.$user->id.'.jpg') || File::exists('assets/images/profile/'.$user->id.'.png'))
                            @if(File::exists('assets/images/profile/'.$user->id.'.jpg'))
                            {{HTML::image('assets/images/profile/'.$user->id.'.jpg','',array('height'=>100,'style'=>'max-width:100px','class'=>'media-object update-card-MDimentions','id'=> 'profile_pic'))}}
                            @else
                            {{HTML::image('assets/images/profile/'.$user->id.'.png','',array('height'=>100,'style'=>'max-width:100px','class'=>'media-object update-card-MDimentions','id'=> 'profile_pic'))}}
                            @endif
                            @else
                            {{HTML::image('assets/images/default-avatar.png','',array('height'=>100,'style'=>'max-width:100px','class'=>'media-object update-card-MDimentions','id'=> 'profile_pic'))}}
                            @endif
                            @endif
                        </a> 
                        <div class="media-body update-card-body hidden-xs">
                            <h4>{{$user->email}}</h4>
                            <img src="http://www.geonames.org/flags/x/bg.gif" width="40" />
                            @if($user->points>100 && $user->points<=1000)
                            <a href="#" title="{{Lang::get('messages.user_has_more_than_100_points')}}"><i class="fa fa-star"></i></a>
                            @endif
                            @if($user->points>1000 && $user->points<=10000)
                            <a href="#" title="{{Lang::get('messages.user_has_more_than_1000_points')}}"><i class="fa fa-star"></i> <i class="fa fa-star"></i></a>
                            @endif
                            @if($user->points>10000 && $user->points<=100000)
                            <a href="#" title="{{Lang::get('messages.user_has_more_than_10000_points')}}"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></a>
                            @endif
                            @if($user->points>100000 )
                            <a href="#" title="{{Lang::get('messages.user_has_more_than_10000_points')}}"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></a>
                            @endif
                            <br />
                            @if($user->membership==1)
                            {{Lang::get('messages.normal_member')}}
                            @endif
                            @if($user->membership==2)
                            {{Lang::get('messages.elite_member')}}
                            @endif
                            @if($user->membership==3)
                            {{Lang::get('messages.moderator')}}
                            @endif
                            @if($user->membership==4)
                            {{Lang::get('messages.administrator')}}
                            @endif
                        </div>
                        </a> 
                        <div class="media-body update-card-body visible-xs" style="width:100%">
                            <h4>{{$user->email}}</h4>
                            <img src="http://www.geonames.org/flags/x/bg.gif" width="40" />
                            @if($user->points>100 && $user->points<=1000)
                            <a href="#" title="{{Lang::get('messages.user_has_more_than_100_points')}}"><i class="fa fa-star"></i></a>
                            @endif
                            @if($user->points>1000 && $user->points<=10000)
                            <a href="#" title="{{Lang::get('messages.user_has_more_than_1000_points')}}"><i class="fa fa-star"></i> <i class="fa fa-star"></i></a>
                            @endif
                            @if($user->points>10000 && $user->points<=100000)
                            <a href="#" title="{{Lang::get('messages.user_has_more_than_10000_points')}}"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></a>
                            @endif
                            @if($user->points>100000 )
                            <a href="#" title="{{Lang::get('messages.user_has_more_than_10000_points')}}"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></a>
                            @endif
                            <br />
                            @if($user->membership==1)
                            {{Lang::get('messages.normal_member')}}
                            @endif
                            @if($user->membership==2)
                            {{Lang::get('messages.elite_member')}}
                            @endif
                            @if($user->membership==3)
                            {{Lang::get('messages.moderator')}}
                            @endif
                            @if($user->membership==4)
                            {{Lang::get('messages.administrator')}}
                            @endif
                        </div>
                        <div class="media-body update-card-body" style="width:100%;">
                            <hr>
                            <h4 class="media-heading">{{$user->first_name}}  {{$user->surname}}</h4>
                            @if($user->profile()->first()->city!="")
                            @if($user->profile()->first()->city_public==0)
                            @if($my_id!=$user->id)
                            @if(Friendship::areFriends($my_id,$user->id))
                            <i class="fa fa-home"></i> {{Lang::get('messages.lives_in')}}: {{$user->profile()->first()->city}}<br />
                            @endif
                            @else
                            <i class="fa fa-home"></i> {{Lang::get('messages.lives_in')}}: {{$user->profile()->first()->city}}<br><small style="color:tomato"><i class="fa fa-eye"></i> {{Lang::get('messages.visible_only_for_friends')}}</small><br />
                            @endif
                            @else
                            <i class="fa fa-home"></i> {{Lang::get('messages.lives_in')}}: {{$user->profile()->first()->city}}<br />
                            @endif
                            @endif
                            @if($user->profile()->first()->job!="")
                            @if($user->profile()->first()->job_public==0)
                            @if($my_id!=$user->id)
                            @if(Friendship::areFriends($my_id,$user->id))
                            <i class="fa fa-home"></i> {{Lang::get('messages.job')}}: {{$user->profile()->first()->job}}<br />
                            @endif
                            @else
                            <i class="fa fa-money"></i> {{Lang::get('messages.job')}}: {{$user->profile()->first()->job}}<br><small style="color:tomato"> <i class="fa fa-eye"></i> {{Lang::get('messages.visible_only_for_friends')}}</small><br />
                            @endif
                            @else
                            <i class="fa fa-money"></i> {{Lang::get('messages.job')}}: {{$user->profile()->first()->job}}<br />
                            @endif
                            @endif
                            <i class="fa fa-comment"></i> {{$user->posts}} {{Lang::get('messages.replies')}}<br />
                            <i class="fa fa-check-circle-o"></i> {{$user->points}} {{Lang::get('messages.xp_points')}}<br />
                            <i class="fa fa-group"></i> {{$num_friends}} {{Lang::get('messages.friends')}}
                        </div>
                    </div>
                </div>
                <div class="col-sm-1"></div>
                <div class="col-sm-4">
                    @if(Session::has('logged'))
                    @if(Session::get('logged')==$user->email)
                    @if($user->profile()->first()->about=="" || $user->profile()->first()->job=="" || $user->profile()->first()->city=="")
                    Complete Your Profile
                    <?php
                    $sum = 0;
                    if ($user->profile()->first()->about != "") {
                        $sum+=33;
                    }
                    if ($user->profile()->first()->city != "") {
                        $sum+=33;
                    }
                    if ($user->profile()->first()->job != "") {
                        $sum+=33;
                    }
                    ?>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="{{$sum}}" aria-valuemin="0" aria-valuemax="99" style="width: {{$sum}}%;">

                        </div>
                    </div>
                    @endif
                    @if($user->profile()->first()->about=="")
                    <form method="post" action="{{URL::to('user/update_description')}}">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <strong>{{Lang::get('messages.describe_yourself')}}:</strong>
                        <textarea name="about" class="form-control" rows="6" maxlength="2000"></textarea>
                        <br />
                        <select name="public">
                            <option value="0"><i class="fa fa-group"></i> {{Lang::get('messages.friends_only')}}</option>
                            <option value="1" selected="selected"><i class="fa fa-bullhorn"></i> {{Lang::get('messages.public')}}</option>
                        </select>
                        <br />
                        <br />
                        <button type="submit" class="btn btn-primary">{{Lang::get('messages.update')}}</button>
                    </form>
                    @else
                    @if($user->profile()->first()->city=="")
                    <form method="post" action="{{URL::to('user/update_city')}}">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <strong>{{Lang::get('messages.city_where_you_live')}}:</strong>
                        <input name="city" class="form-control" rows="6" maxlength="50">
                        <br />
                        <select name="public">
                            <option value="0">{{Lang::get('messages.friends_only')}}</option>
                            <option value="1" selected="selected">{{Lang::get('messages.public')}}</option>
                        </select>
                        <br />
                        <br />
                        <button type="submit" class="btn btn-primary">{{Lang::get('messages.update')}}</button>
                    </form>
                    @else
                    @if($user->profile()->first()->job=="")
                    <form method="post" action="{{URL::to('user/update_job')}}">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <strong>{{Lang::get('messages.your_job')}}:</strong>
                        <input name="job" class="form-control" rows="6" maxlength="50">
                        <br />
                        <select name="public">
                            <option value="0"> Friends Only</option>
                            <option value="1" selected="selected"> Public</option>
                        </select>
                        <br />
                        <br />
                        <button type="submit" class="btn btn-primary">{{Lang::get('messages.update')}}</button>
                    </form>
                    @endif
                    @endif
                    @endif

                    @endif
                    @endif
                    @if($user->profile()->first()->about!="" && $user->profile()->first()->about_public==1)
                    <div class="block-update-card status">
                        <div class="update-card-body">
                            <h4>{{Lang::get('messages.about_me')}}</h4>
                            <p>{{$user->profile()->first()->about}}</p>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
            <hr>
            @if($friends->count()>0)
            <h3>{{Lang::get('messages.friends')}}</h3>
            @endif
            @foreach($friends as $friend)
            <?php
            if ($friend->acc_1 == $user->id) {
                $fr_info = User::find($friend->acc_2);
            } else {
                $fr_info = User::find($friend->acc_1);
            }
            ?>
            @if($fr_info->fb_id!="")
            <img src="https://graph.facebook.com/{{$user->fb_id}}/picture?type=large" class="thumbnail" id="profile_pic" height="100" style="max-width:100px;" >
            @else
            @if(File::exists('assets/images/profile/'.$fr_info->id.'.jpg') || File::exists('assets/images/profile/'.$fr_info->id.'.png'))
            @if(File::exists('assets/images/profile/'.$fr_info->id.'.jpg'))
            <a href="{{URL::to('profile/'.$fr_info->email)}}">{{HTML::image('assets/images/profile/'.$fr_info->id.'.jpg','',array('height'=>100,'style'=>'max-width:100px','class'=>'image-fr'))}}</a>
            @else
            <a href="{{URL::to('profile/'.$fr_info->email)}}">{{HTML::image('assets/images/profile/'.$fr_info->id.'.png','',array('height'=>100,'style'=>'max-width:100px','class'=>'image-fr'))}}</a>
            @endif
            @else
            <a href="{{URL::to('profile/'.$fr_info->email)}}">{{HTML::image('assets/images/default-avatar.png','',array('height'=>100,'style'=>'max-width:100px','class'=>'image-fr'))}}</a>
            @endif
            @endif
            @endforeach
        </div>
        <script type="text/javascript">
            $("#profile_pic").click(function() {
                $("#file").click();
            });
            $("#file").change(function() {
                $("#change_profile_pic_form").submit();
            });
            $("#tip").tooltip();
        </script>   
    </div>
    <div class="col-sm-2"></div>
</div>

@stop