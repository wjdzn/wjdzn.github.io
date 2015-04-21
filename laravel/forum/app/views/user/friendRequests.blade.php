@extends('../layouts/default')

@section('title')
{{Lang::get('messages.friend_requests')}}
@stop

@section('content')
<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8 box">
        <h3 align="center"><i class="fa fa-group"></i> {{Lang::get('messages.friend_requests')}}</h3>
        @if(Session::has('success'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>{{Session::get('success')}}</strong>
        </div>
        @endif
        <div class="table-responsive">
            <table class="table table-striped">
                @if($requests->count()>0)
                <th>{{Lang::get('messages.from')}}</th>
                <th>{{Lang::get('messages.to')}}</th>
                <th>{{Lang::get('messages.sent')}}</th>
                <th>{{Lang::get('messages.options')}}</th>
                @foreach($requests as $request)
                <tr>
                    <td>
                        <a href="{{URL::to('profile/'.User::find($request->acc_1)->email)}}">{{User::find($request->acc_1)->email}}</a></td><td><a href="{{URL::to('profile/'.User::find($request->acc_1)->email)}}">{{User::find($request->acc_2)->email}}</a></td><td>{{$request->created_at}}</td><td>
                        @if(User::find($request->acc_1)->email!=Session::get('logged'))
                        <a href="{{URL::to('acceptRequest/'.$request->id)}}" class="label label-success"><i class="fa fa-check"></i> {{Lang::get('messages.accept')}}</a> | <a href="{{URL::to('rejectRequest/'.$request->id)}}" class="label label-danger"><i class="fa fa-times"></i> {{Lang::get('messages.reject')}}</a>
                        @else
                        <a href="{{URL::to('addfriend/'.$request->acc_2)}}" class="label label-warning"><i class="fa fa-times"></i> {{Lang::get('messages.cancel_request')}}</a>
                        @endif
                    </td>
                </tr>
                @endforeach
                @else
                <tr><td class="vert-align"><i class="fa fa-info"></i> {{Lang::get('messages.there_are_not_any_friend_requests')}}</td></tr>
                @endif
            </table>
            <center>{{$requests->links()}}</center>
        </div>			
    </div>
    <div class="col-sm-2"></div>
</div>
@stop