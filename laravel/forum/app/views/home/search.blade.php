@extends('../layouts/default')

@section('title')
{{Input::get('query')}}
@stop

@section('content')
<div class="box">
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">{{Lang::get('messages.users_found')}}</h3>
                </div>
                <div class="panel-body" style="word-wrap:break-word">
                    @foreach($users as $user)
                    <img src="{{User::getProfileLink($user->id)}}" width="50" class="img-circle"> <a href="{{URL::to('profile/'.$user->email)}}">{{$user->first_name}} {{$user->surname}}</a> ({{$user->email}})<br>
                    <hr>
                    @endforeach
                    @if($users->count()< 1)
                    <i class="fa fa-warning"></i> {{Lang::get('messages.there_is_not_any_user_with_firstname_surname_or_email')}} - {{Input::get('query')}}
                    @endif
                </div>
            </div>
            <br >
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">{{Lang::get('messages.categories_found')}}</h3>
                </div>
                <div class="panel-body" style="word-wrap:break-word">
                    @foreach($categories as $category)
                    <i class="fa fa-folder"></i> <a href="{{URL::to('category/'.$category->id)}}">{{$category->name}}</a> - {{$category->description}}
                    <br>
                    <br>
                    @endforeach
                    @if($categories->count()< 1)
                    <i class="fa fa-warning"></i> {{Lang::get('messages.there_is_no_category_with_name')}} - {{Input::get('query')}}
                    @endif
                </div>
            </div>
            <br >
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">{{Lang::get('messages.discussions_found')}}</h3>
                </div>
                <div class="panel-body" style="word-wrap:break-word">
                    @foreach($discussions as $discussion)
                    <i class="fa fa-comments"></i> <a href="{{URL::to('discussion/'.$discussion->id)}}">{{$discussion->title}}</a> {{Lang::get('messages.in_category')}}: <a href="{{URL::to('category/'.$discussion->cat_id)}}">{{Category::find($discussion->cat_id)->name}}</a>
                    <br>
                    <br>
                    @endforeach
                    @if($discussions->count()< 1)
                    <i class="fa fa-warning"></i> {{Lang::get('messages.there_is_not_any_discussion_with_title')}} - {{Input::get('query')}}
                    @endif
                </div>
            </div>		
            <br >
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">{{Lang::get('messages.posts_found')}}</h3>
                </div>
                <div class="panel-body" style="word-wrap:break-word">
                    @foreach($posts as $post)
                    <i class="fa fa-arrow"></i> {{substr($post->text,0,50)}}<?php
                    if (strlen($post->text) > 50) {
                        echo "...";
                    }
                    ?> <br>{{Lang::get('messages.discussion')}}: <a href="{{URL::to('discussion/'.$post->dis_id)}}"><a href="{{URL::to('discussion/'.$post->dis_id.'#post_'.$post->id)}}">{{Discussion::where('id',$post->dis_id)->first()->title}}</a>
                        <hr>
                        @endforeach
                        @if($posts->count()< 1)
                        <i class="fa fa-warning"></i> {{Lang::get('messages.there_is_not_any_post_which_contains_the_word')}} - {{Input::get('query')}}
                        @endif
                </div>
            </div>					
        </div>
        <div class="col-sm-2"></div>
    </div>
</div>
@stop