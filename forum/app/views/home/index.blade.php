@extends('../layouts/default')

@section('title')
Home
@stop

@section('content')
<div class="row">
    <div class="col-sm-3">
        @if(Session::has('logged'))
        @if(User::where('email',Session::get('logged'))->first()->membership>=4)
        <a href="{{URL::to('category/create')}}" style="width:100%;margin-bottom:30px;" class="btn btn-success">{{Lang::get('messages.create_category')}}</a>
        @endif
        @endif
        <div class="box">
            <form action="{{URL::to('search')}}">
                <input type="text" name="query" id="inputQuery" class="form-control" placeholder="{{Lang::get('messages.search')}}...">
            </form>	
        </div>
        <div class="panel panel-primary" style="margin-top:30px;">
            <div class="panel-heading">
                <i class="fa fa-list"></i> {{Lang::get('messages.all_categories')}}
            </div>
            <div class="panel-body" style="padding:0px;">
                <ul class="list-group" style="margin:0px;">
                    @foreach($acategories as $cat)
                    <li class="list-group-item" style="border-radius:0px;"><a href="{{URL::to('category/'.$cat->id)}}">{{$cat->name}}</a><span class="badge">{{$cat->discussions->count()}}</span></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="col-sm-9 box">
        <div class="btn-group">
        </div>
        @if(Discussion::where('type','announcement')->count()>0)
        <div class="panel panel-danger">
            <div class="panel-heading">
                <i class="fa fa-info"></i> {{Lang::get('messages.announcements')}}
            </div>
            <div class="panel-body" style="padding:0px;">
                <div class="table-responsive">
                    <table class="table table-responsive" style="margin:0px;border:none;">
                        <thead>
                            <tr style="height:20px;">
                                <th>{{Lang::get('messages.name')}}</th>
                                <th>{{Lang::get('messages.posts')}}</th>
                                <th>{{Lang::get('messages.last_post')}}</th>
                                <th>{{Lang::get('messages.seen')}}</th>
                            </tr>
                        </thead>
                        @foreach(Discussion::where('type','announcement')->get() as $an)
                        <tr>
                            <td class="vert-align col-md-5">
                                @if(Session::has('logged'))
                                @if(User::where('email',Session::get('logged'))->first()->membership>=3)
                                <a href="{{URL::to('discussion/'.$an->id.'/edit')}}" class="label label-success"><i class='fa fa-edit'></i></a>
                                <a class="label label-danger" data-toggle="modal" href='#modal-delete-topic-{{$an->id}}'><i class='fa fa-times'></i></a>
                                <div class="modal fade" id="modal-delete-topic-{{$an->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title">{{Lang::get('messages.delete_a_discussion')}}</h4>
                                            </div>
                                            <div class="modal-body">
                                                {{Lang::get('messages.delete_a_discussion')}} - {{$an->title}}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class='fa fa-times'></i> {{Lang::get('messages.cancel')}}</button>
                                                <a href="{{URL::to('discussion/'.$an->id.'/delete')}}" class="btn btn-primary"><i class='fa fa-trash-o'></i> {{Lang::get('messages.delete')}}</a>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                                @endif
                                @endif
                                <a href="{{URL::to('discussion/'.$an->id)}}">{{$an->title}}</a></td>
                            <td class="vert-align col-md-1"><i class="fa fa-comments"></i> {{$an->posts()->count()}}</td>
                            <td class="vert-align col-md-4">
                                @if($an->posts()->count()>0)
                                <a href="{{URL::to('profile/'.User::find($an->posts()->orderBy('created_at','DESC')->first()->by)->email)}}"><img src="{{User::getProfileLink($an->posts()->orderBy('created_at','DESC')->first()->by)}}" height="40" width="40" class="img-circle" />
                                    {{User::find($an->posts()->orderBy('created_at','DESC')->first()->by)->first_name}}
                                </a>
                                @else
                                {{Lang::get('messages.no_posts')}}
                                @endif
                            </td>
                            <td class="vert-align col-md-1"><i class="fa fa-eye"></i> {{$an->views}}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        @endif
        @foreach($categories as $cat)
        <?php
        if (!Session::has('sort/' . $cat->id)) {
            Session::put('sort/' . $cat->id, array('created_at', 'DESC'));
        }
        ?>

        <div class="panel panel-primary">
            <div class="panel-heading">
                <i class="fa fa-list"></i> {{$cat->name}} 
                <div class="pull-right">
                    @if(Session::has('logged'))
                    @if(User::isMuted(Session::get('logged')))
                    <a href="#" class="label label-warning">{{Lang::get('messages.you_are_muted')}}</a>
                    @else
                    <a href="{{URL::to('discussion/create/'.$cat->id)}}" style="color:#FFF" class="label label-success hidden-xs"><i class="fa fa-plus"></i> 
                        {{Lang::get('messages.start_discussion')}}
                    </a>
                    <a href="{{URL::to('discussion/create/'.$cat->id)}}" style="color:#FFF" class="label label-success visible-xs"><i class="fa fa-plus"></i></a>
                    @endif
                    @if(User::where('email',Session::get('logged'))->first()->membership>=4)
                    <a href="{{URL::to('category/'.$cat->id.'/edit')}}" class="label label-success"><i class="fa fa-pencil"></i></a>
                    <a class="label label-warning" data-toggle="modal" href='#modal-id-{{$cat->id}}'><i class="fa fa-times"></i></a>
                    <div class="modal fade" id="modal-id-{{$cat->id}}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title"><i class="fa fa-lock"></i> {{Lang::get('messages.delete_a_category')}}</h4>
                                </div>
                                <div class="modal-body">
                                    <div id="error_delete_cat_{{$cat->id}}"></div>
                                    {{Lang::get('messages.your_password')}}:
                                    <input type="password"  id="password_{{$cat->id}}" class="form-control" required="required">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class='fa fa-times'></i> {{Lang::get('messages.cancel')}}</button>
                                    <button type="button" class="btn btn-primary" id="delete_cat_{{$cat->id}}"><i class='fa fa-arrow-right'></i> {{Lang::get('messages.continue')}}</button>
                                    <a id="delete_final_category_{{$cat->id}}" href="{{URL::to('category/'.$cat->id.'/delete')}}" class="btn btn-danger" style="display:none"><i class='fa fa-trash-o'></i> {{Lang::get('messages.delete')}}</a>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                    <script type="text/javascript">
                        $("#delete_cat_{{$cat->id}}").click(function() {
                            $.ajax({
                                url: '{{URL::to("checkPassword")}}',
                                type: 'GET',
                                data: {
                                    email: '{{Session::get("logged")}}',
                                    password: $("#password_{{$cat->id}}").val()
                                }
                            }).done(function(data) {
                                if (data == 1) {
                                    $("#delete_cat_{{$cat->id}}").hide();
                                    $("#delete_final_category_{{$cat->id}}").show();
                                } else {
                                    $("#error_delete_cat_{{$cat->id}}").html("<div class='alert alert-danger'><i class='fa fa-warning'></i> {{Lang::get('messages.wrong_password')}}</div>");
                                }
                            });
                        });
                    </script>
                    @endif
                    @endif
                </div>
            </div>
            <div class="panel-body" style="padding:0px;">
                <div class="table-responsive">
                    <table class="table table-striped" style="margin:0px;border:none;">
                        <thead>
                            <tr style="height:20px;">
                                <th>{{Lang::get('messages.name')}}	<a href="{{URL::to('sortDis/'.$cat->id.'/title')}}"><i class='fa fa-arrows-v'></i></a></th>
                                <th></th>
                                <th>{{Lang::get('messages.posts')}}</th>
                                <th>{{Lang::get('messages.last_post')}}</th>
                                <th>{{Lang::get('messages.seen')}} <a href="{{URL::to('sortDis/'.$cat->id.'/views')}}"><i class='fa fa-arrows-v'></i></a></th>
                            </tr>
                        </thead>	
                        <tbody>
                            @if($cat->must_logged==0 && $cat->min_membership==1)
                            @if($cat->discussions()->count() < 1)
                            <tr><td class='vert-align'>{{Lang::get('messages.the_category_is_empty')}}</td><td></td><td></td><td></td><td></td></tr>
                            @endif
                            @foreach($cat->discussions()->where('type','<>','announcement')->limit(10)->orderBy(Session::get('sort/'.$cat->id)[0],Session::get('sort/'.$cat->id)[1])->get() as $dis)
                            <?php
                            if ($dis->posts()->count() >= 70) {
                                $dis->hot = 1;
                                $dis->save();
                            }
                            ?>
                            @if($dis->hot==1)
                            <tr class="warning">
                                @else
                            <tr>
                                @endif
                                <td class="vert-align col-md-5">
                                    @if($dis->hot==1)
                                    <i class="fa fa-bomb"></i>
                                    @endif
                                    @if($dis->closed==1)
                                    <i class="fa fa-lock"></i>
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
                                    <a href="{{URL::to('discussion/'.$dis->id)}}">
                                        {{$dis->title}}</a></td>
                                <td class="vert-align col-sm-1">
                                    @if($dis->hot==1)
                                    <span class="label label-warning">{{Lang::get('messages.hot')}}</span>
                                    @endif
                                    @if($dis->closed==1)
                                    <span class="label label-danger">{{Lang::get('messages.closed')}}</span>
                                    @endif
                                </td>
                                <td class="vert-align col-md-1"><i class="fa fa-comments"></i> {{$dis->posts()->count()}}</td>
                                <td  class="vert-align col-md-4">
                                    @if($dis->posts()->count()>0)
                                    <a href="{{URL::to('profile/'.User::find($dis->posts()->orderBy('created_at','DESC')->first()->by)->email)}}"><img src="{{User::getProfileLink($dis->posts()->orderBy('created_at','DESC')->first()->by)}}" height="40" width="40" class="img-circle" />
                                        {{User::find($dis->posts()->orderBy('created_at','DESC')->first()->by)->first_name}}
                                        @else
                                        {{Lang::get('messages.no_posts')}}
                                        @endif
                                    </a>
                                </td>
                                <td class="vert-align col-sm-2"><i class="fa fa-eye"></i> {{$dis->views}} </td>
                            </tr>
                            @endforeach
                            @endif
                            @if($cat->must_logged==1)
                            @if(!Session::has('logged'))
                            <tr><td class='vert-align'>{{Lang::get('messages.you_must_login_to_view_this_category')}}</td><td></td><td></td><td></td><td></td></tr>
                            @else
                            @if($cat->discussions()->count() < 1)
                            <tr><td class='vert-align'>{{Lang::get('messages.the_category_is_empty')}}</td><td></td><td></td><td></td><td></td></tr>
                            @endif
                            @foreach($cat->discussions()->where('type','<>','announcement')->limit(10)->orderBy(Session::get('sort/'.$cat->id)[0],Session::get('sort/'.$cat->id)[1])->get() as $dis)
                            <?php
                            if ($dis->posts()->count() >= 70) {
                                $dis->hot = 1;
                                $dis->save();
                            }
                            ?>
                            @if($dis->hot==1)
                            <tr class="warning">
                                @else
                            <tr>
                                @endif
                                <td class="vert-align col-md-5">
                                    @if($dis->hot==1)
                                    <i class="fa fa-bomb"></i>
                                    @endif
                                    @if($dis->closed==1)
                                    <i class="fa fa-lock"></i>
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
                                    <a href="{{URL::to('discussion/'.$dis->id)}}">
                                        {{$dis->title}}</a></td>
                                <td class="vert-align col-sm-1">
                                    @if($dis->hot==1)
                                    <span class="label label-warning">{{Lang::get('messages.hot')}}</span>
                                    @endif
                                    @if($dis->closed==1)
                                    <span class="label label-danger">{{Lang::get('messages.closed')}}</span>
                                    @endif
                                </td>
                                <td class="vert-align col-md-1"><i class="fa fa-comments"></i> {{$dis->posts()->count()}}</td>
                                <td  class="vert-align col-md-4">
                                    @if($dis->posts()->count()>0)
                                    <a href="{{URL::to('profile/'.User::find($dis->posts()->orderBy('created_at','DESC')->first()->by)->email)}}"><img src="{{User::getProfileLink($dis->posts()->orderBy('created_at','DESC')->first()->by)}}" height="40" width="40" class="img-circle" />
                                        {{User::find($dis->posts()->orderBy('created_at','DESC')->first()->by)->first_name}}
                                        @else
                                        {{Lang::get('messages.no_posts')}}
                                        @endif
                                    </a>
                                </td>
                                <td class="vert-align col-sm-1"><i class="fa fa-eye"></i> {{$dis->views}} </td>
                            </tr>
                            @endforeach
                            @endif
                            @else
                            @if($cat->min_membership>1)

                            @if(Session::has('logged'))
                            @if(User::where('email', Session::get('logged'))->first()->membership>=$cat->min_membership)
                            @if($cat->discussions()->count() < 1)
                            <tr><td class='vert-align'>{{Lang::get('messages.the_category_is_empty')}}</td><td></td><td></td><td></td><td></td></tr>
                            @endif
                            @foreach($cat->discussions()->where('type','<>','announcement')->limit(10)->orderBy(Session::get('sort/'.$cat->id)[0],Session::get('sort/'.$cat->id)[1])->get() as $dis)
                            <?php
                            if ($dis->posts()->count() >= 70) {
                                $dis->hot = 1;
                                $dis->save();
                            }
                            ?>
                            @if($dis->hot==1)
                            <tr class="warning">
                                @else
                            <tr>
                                @endif
                                <td class="vert-align col-md-5">
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
                                    <a href="{{URL::to('discussion/'.$dis->id)}}">
                                        {{$dis->title}}</a></td>
                                <td class="vert-align col-sm-1">
                                    @if($dis->hot==1)
                                    <span class="label label-warning">Hot</span>
                                    @endif
                                </td>
                                <td class="vert-align col-md-1"><i class="fa fa-comments"></i> {{$dis->posts()->count()}}</td>
                                <td  class="vert-align col-md-4">
                                    @if($dis->posts()->count()>0)
                                    <a href="{{URL::to('profile/'.User::find($dis->posts()->orderBy('created_at','DESC')->first()->by)->email)}}"><img src="{{User::getProfileLink($dis->posts()->orderBy('created_at','DESC')->first()->by)}}" height="40" width="40" class="img-circle" />
                                        {{User::find($dis->posts()->orderBy('created_at','DESC')->first()->by)->first_name}}
                                        @else
                                        {{Lang::get('messages.no_posts')}}
                                        @endif
                                    </a>
                                </td>
                                <td class="vert-align col-sm-1"><i class="fa fa-eye"></i> {{$dis->views}} </td>
                            </tr>
                            @endforeach
                            @else
                            <tr><td class='vert-align'>{{Lang::get('messages.no_permissions')}}</td><td></td><td></td><td></td><td></td></tr>
                            @endif
                            @else
                            <tr><td class='vert-align'>{{Lang::get('messages.no_permissions')}}</td><td></td><td></td><td></td><td></td></tr>
                            @endif
                            @endif
                            @endif
                            @if($cat->discussions()->count()>10)
                            <tr class="info"><td class="vert-align"><a href="{{URL::to('category/'.$cat->id)}}" class="label label-success"><i class='fa fa-list'></i> {{Lang::get('messages.more_discussions')}}...</a></td><td></td><td></td><td></td><td></td></tr>
                            @endif
                        </tbody>

                    </table>	
                </div>
            </div>
        </div>
        @endforeach	
        <center>{{$categories->links()}}</center>
    </div>
</div>
@stop