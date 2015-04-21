@extends('../layouts/default')

@section('title')
{{$discussion->title}}
@stop

@section('content')
<?php
$by = User::find($discussion->by_id);
if (Session::has('logged')) {
    $me = User::where('email', Session::get('logged'))->first();
}
?>
<div class="container">
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <div class="title-dis">
                @if($discussion->type=="announcement")
                <small>{{Lang::get('messages.announcement')}}</small>
                @else
                <small>{{Lang::get('messages.discussion')}}</small>
                @endif
                <br /> - - -
                <h3 style="padding:0px;margin:0px;">{{$discussion->title}}</h3>
            </div>
            <div class="panel panel-default panel-google-plus" style="margin-top:20px">
                @if(Session::has('logged'))
                @if(Session::get('logged')==$by->email || $me->membership>=3)
                <div class="dropdown">
                    <span class="dropdown-toggle" type="button" data-toggle="dropdown">
                        <span class="caret"></span>
                    </span>
                    <ul class="dropdown-menu" role="menu">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="{{URL::to('discussion/'.$discussion->id.'/delete')}}" ><i class="fa fa-times"></i> {{Lang::get('messages.delete')}}</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="{{URL::to('discussion/'.$discussion->id.'/edit')}}"><i class="fa fa-pencil"></i> {{Lang::get('messages.edit')}}</a></li>
                    </ul>
                </div>
                @endif
                @endif
                <div class="panel-heading" style="border-radius:0px;">
                    @if(User::isOnline($by->email))
                    <a href="{{URL::to('profile/'.$by->email)}}"><img class="img-circle pull-left" src="{{User::getProfileLink($by->id)}}" style="width:54px;height:54px;border:4px solid #2DE80A" alt="Mouse0270" /></a>
                    @else
                    <a href="{{URL::to('profile/'.$by->email)}}"><img class="img-circle pull-left" src="{{User::getProfileLink($by->id)}}" style="width:50px;height:50px;" alt="Mouse0270" /></a>
                    @endif
                    <h3>{{$by->first_name}} {{$by->surname}}
                        @if($by->points>100 && $by->points<=1000)
                        <a href="#" title="{{Lang::get('messages.user_has_more_than_100_points')}}"><i class="fa fa-star"></i></a>
                        @endif
                        @if($by->points>1000 && $by->points<=10000)
                        <a href="#" title="{{Lang::get('messages.user_has_more_than_1000_points')}}"><i class="fa fa-star"></i> <i class="fa fa-star"></i></a>
                        @endif
                        @if($by->points>10000 && $by->points<=100000)
                        <a href="#" title="{{Lang::get('messages.user_has_more_than_10000_points')}}"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></a>
                        @endif
                        @if($by->points>100000 )
                        <a href="#" title="{{Lang::get('messages.user_has_more_than_10000_points')}}"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></a>
                        @endif
                    </h3> 
                    <small>
                        @if($by->membership==1)
                        {{Lang::get('messages.normal_member')}}
                        @endif
                        @if($by->membership==2)
                        {{Lang::get('messages.elite_member')}}
                        @endif
                        @if($by->membership==3)
                        {{Lang::get('messages.moderator')}}
                        @endif
                        @if($by->membership==4)
                        {{Lang::get('messages.administrator')}}
                        @endif
                    </small>
                    <h5> <span>{{substr($discussion->created_at,0,10)}}</span> </h5>
                </div>
                <div class="panel-body post-body">
                    <p>{{$discussion->description}}</p>
                    @if(Session::has('logged'))
                    @if(User::where('email',Session::get('logged'))->first()->id!=$discussion->by_id)
                    <a href="{{URL::to('report/2/'.$discussion->id)}}" class="label label-warning">{{Lang::get('messages.report')}}</a>
                    @endif
                    @endif
                </div>
            </div>
        </div>
        <div class="col-sm-1"></div>
    </div>
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            @foreach($discussion->posts()->paginate(10) as $post)
            <?php
            $byp = User::find($post->by);
            ?>
            <div class="[ panel panel-default ] panel-google-plus" id="post_{{$post->id}}">
                @if(Session::has('logged'))
                @if(Session::get('logged')==$byp->email || $me->membership>=3)
                <div class="dropdown">
                    <span class="dropdown-toggle" type="button" data-toggle="dropdown">
                        <span class="caret"></span>
                    </span>
                    <ul class="dropdown-menu" role="menu">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="{{URL::to('post/'.$post->id.'/delete')}}" ><i class="fa fa-times"></i> {{Lang::get('messages.delete')}}</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="{{URL::to('post/'.$post->id.'/edit')}}"><i class="fa fa-pencil"></i> {{Lang::get('messages.edit')}}</a></li>
                    </ul>
                </div>
                @endif
                @endif
                <div class="panel-heading">
                    @if(User::isOnline($byp->email))
                    <a href="{{URL::to('profile/'.$byp->email)}}"><img class="img-circle pull-left" src="{{User::getProfileLink($byp->id)}}" style="width:54px;height:54px;border:4px solid #2DE80A" alt="Mouse0270" /></a>
                    @else
                    <a href="{{URL::to('profile/'.$byp->email)}}"><img class="img-circle pull-left" src="{{User::getProfileLink($byp->id)}}" style="width:50px;height:50px;" alt="Mouse0270" /></a>
                    @endif
                    <h3>{{$byp->first_name}} {{$byp->surname}}
                        @if($byp->points>100 && $byp->points<=1000)
                        <a href="#" title="{{Lang::get('messages.user_has_more_than_100_points')}}"><i class="fa fa-star"></i></a>
                        @endif
                        @if($byp->points>1000 && $byp->points<=10000)
                        <a href="#" title="{{Lang::get('messages.user_has_more_than_1000_points')}}"><i class="fa fa-star"></i> <i class="fa fa-star"></i></a>
                        @endif
                        @if($byp->points>10000 && $byp->points<=100000)
                        <a href="#" title="{{Lang::get('messages.user_has_more_than_10000_points')}}"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></a>
                        @endif
                        @if($byp->points>100000 )
                        <a href="#" title="{{Lang::get('messages.user_has_more_than_10000_points')}}"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></a>
                        @endif
                    </h3> 
                    <small>
                        @if($byp->membership==1)
                        {{Lang::get('messages.normal_member')}}
                        @endif
                        @if($byp->membership==2)
                        {{Lang::get('messages.elite_member')}}
                        @endif
                        @if($byp->membership==3)
                        {{Lang::get('messages.moderator')}}
                        @endif
                        @if($byp->membership==4)
                        {{Lang::get('messages.administrator')}}
                        @endif
                    </small>
                    <h5> <span>{{substr($discussion->created_at,0,10)}}</span> </h5>
                </div>
                <div class="panel-body post-body">
                    <p>{{$post->text}}</p>
                    @if(Session::has('logged'))
                    @if(User::where('email',Session::get('logged'))->first()->id!=$post->by)
                    @if(Like::where('post_id',$post->id)->where('by_id',User::where('email',Session::get('logged'))->first()->id)->count()<1)
                    <a href="{{URL::to('like/'.$post->id)}}" class="label label-success">+1 <i class="fa fa-thumbs-up"></i></a> |
                    @endif
                    @endif
                    @endif
                    <i class="fa fa-thumbs-up"></i> {{$post->likes}}
                    @if(Session::has('logged'))
                    @if(User::where('email',Session::get('logged'))->first()->id!=$post->by)
                    | <a href="{{URL::to('report/1/'.$post->id)}}" class="label label-warning">{{Lang::get('messages.report')}}</a>
                    @endif
                    @endif
                </div>
            </div>
            @endforeach
            {{$discussion->posts()->paginate(10)->links()}}

            @if(Session::has('logged'))
            @if(!User::isMuted(Session::get('logged')))
            @if($discussion->closed==0)
            <form method="post" action="{{URL::to('post')}}">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <input type="hidden" name="dis" value="{{$discussion->id}}">
                <textarea name="reply" id="reply"></textarea>
                <small>{{Lang::get('messages.limit_2000')}}</small>
                <br />
                <button type="submit" class="btn btn-success"><i class="fa fa-send"></i> {{Lang::get('messages.reply')}} </button>
            </form>
            @else
            <h3 align="center" style="background-color:tomato;border:2px solid #000;border-radius:5px;padding:5px;"><i class="fa fa-lock"></i> {{Lang::get('messages.discussion_is_closed')}}</h3>
            @endif
            @endif
            @endif
        </div>
        <div class="col-sm-2"></div>
    </div>
</div>

<script type="text/javascript">
    CKEDITOR.replace('reply');
</script>

@stop