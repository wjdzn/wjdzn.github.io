@extends('../layouts/default')

@section('title')
{{$category->name}}
@stop

@section('content')
<?php
if (!Session::has('sort/' . $category->id)) {
    Session::put('sort/' . $category->id, array('created_at', 'DESC'));
}
if (!Session::has('dis_per_page')) {
    Session::put('dis_per_page', 10);
}
?>
<div class="row">
    <div class="col-sm-3">
        @if(Session::has('logged'))
        @if(User::isMuted(Session::get('logged')))
        <a href="#" class="btn btn-warning disabled" style="width:100%;"><i class="fa fa-ban"	q></i> {{Lang::get('messages.you_are_muted')}}</a>
        @else
        <a href="{{URL::to('discussion/create/'.$category->id)}}" class="btn btn-success" style="width:100%;">{{Lang::get('messages.start_discussion')}}</a>
        @endif
        @else

        @endif
    </div>
    <div class="col-sm-1"></div>
    <div class="col-sm-8 box">
        @if(Session::has('success'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>{{Session::get('success')}}</strong>
        </div>
        @endif
        <h2 align="center"><i class="fa fa-list"></i> {{$category->name}}</h2>
        <div class="well" id="desc" style="word-wrap:break-word;max-width:60%;margin:0 auto;margin-bottom:20px;border-radius:0px;box-shadow: inset 0px 0px 5px #777;text-align:center">
            {{$category->description}}
        </div>
        @if($category->discussions()->count()>10)
        <strong>{{Lang::get('messages.discussions_per_page')}}</strong>
        <div class="btn-group">
            @if(Session::get('dis_per_page')==10)
            <a href="{{URL::to('dis_per_page/10')}}" class="btn btn-default active">10</a>
            @else
            <a href="{{URL::to('dis_per_page/10')}}" class="btn btn-default">10</a>
            @endif
            @if(Session::get('dis_per_page')==30)
            <a href="{{URL::to('dis_per_page/30')}}" class="btn btn-default active">30</a>
            @else
            <a href="{{URL::to('dis_per_page/30')}}" class="btn btn-default">30</a>
            @endif
            @endif
            @if($category->discussions()->count()>30)
            @if(Session::get('dis_per_page')==50)
            <a href="{{URL::to('dis_per_page/50')}}" class="btn btn-default active">50</a>
            @else
            <a href="{{URL::to('dis_per_page/50')}}" class="btn btn-default">50</a>
            @endif
            @endif
            @if($category->discussions()->count()>10)
        </div>
        @endif
        <div class="table-responsive" style="margin-top:30px;max-width:100%	">
            <table class="table table-striped">
                <thead>
                    <tr style="height:20px;">
                        <th>{{Lang::get('messages.name')}}	<a href="{{URL::to('sortDis/'.$category->id.'/title')}}"><i class='fa fa-arrows-v'></i></a></th>
                        <th></th>
                        <th>{{Lang::get('messages.posts')}}</th>
                        <th>{{Lang::get('messages.last_post')}}</th>
                        <th>{{Lang::get('messages.seen')}} <a href="{{URL::to('sortDis/'.$category->id.'/views')}}"><i class='fa fa-arrows-v'></i></a></th>
                    </tr>
                </thead>	
                <tbody>
                    @if($category->discussions()->where('type','<>','announcement')->count()< 1)
                    <tr><td class="vert-align">{{Lang::get('messages.the_category_is_empty')}}</td><td></td><td></td><td></td><td></td></tr>
                    @endif
                    @foreach($category->discussions()->orderBy(Session::get('sort/'.$category->id)[0],Session::get('sort/'.$category->id)[1])->where('type','<>','announcement')->paginate(Session::get('dis_per_page')) as $dis)
                    <tr><td class="vert-align col-md-7">
                            @if($dis->closed==1)
                            <i class="fa fa-lock"></i>
                            @endif
                            @if($dis->hot==1)
                            <i class="fa fa-bomb"></i>
                            @endif
                            @if(Session::has('logged'))
                            @if(User::where('email',Session::get('logged'))->first()->membership>=3)
                            <a href="{{URL::to('discussion/'.$dis->id.'/edit')}}" class="label label-success"><i class='fa fa-edit'></i></a>
                            <a class="label label-danger" data-toggle="modal" href='#modal-delete-topic-{{$dis->id}}'><i class='fa fa-times'></i></a>
                            <div class="modal fade" id="modal-delete-topic-{{$dis->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">{{Lang::get('messages.delete_a_discussion')}}</h4>
                                        </div>
                                        <div class="modal-body">
                                            {{Lang::get('messages.delete_a_discussion')}} - {{$dis->title}}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class='fa fa-times'></i> {{Lang::get('messages.cancel')}}</button>
                                            <a href="{{URL::to('discussion/'.$dis->id.'/delete')}}" class="btn btn-primary"><i class='fa fa-trash-o'></i> {{Lang::get('messages.delete')}}</a>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                            @endif
                            @endif
                            <a href="{{URL::to('discussion/'.$dis->id)}}">{{$dis->title}}</a></td>
                        <td class="vert-align">
                            @if($dis->hot==1)
                            <span class="label label-warning">{{Lang::get('messages.hot')}}</span>
                            @endif
                            @if($dis->closed==1)
                            <span class="label label-danger">{{Lang::get('messages.closed')}}</span>
                            @endif
                        </td>
                        <td class="vert-align"><i class="fa fa-comments"></i> {{$dis->posts()->count()}}</td>
                        <td class="vert-align">
                            @if($dis->posts()->count()>0)
                            <a href="{{URL::to('profile/'.User::find($dis->posts()->orderBy('created_at','DESC')->first()->by)->email)}}"><img src="{{User::getProfileLink($dis->posts()->orderBy('created_at','DESC')->first()->by)}}" height="40" width="40" class="img-circle" />
                                {{User::find($dis->posts()->orderBy('created_at','DESC')->first()->by)->first_name}}
                            </a>
                            @else
                            {{Lang::get('messages.no_posts')}}
                            @endif
                        </td>
                        <td class="vert-align"><i class="fa fa-eye"></i> {{$dis->views}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <center>{{$category->discussions()->where('type','<>','announcement')->paginate(Session::get('dis_per_page'))->links()}}</center>
        </div>
    </div>
</div>
@stop