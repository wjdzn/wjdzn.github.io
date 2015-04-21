@extends('../layouts/default')

@section('title')
{{Lang::get('messages.inbox')}}
@stop

@section('content')
<div class="row">
    <div class="col-sm-3">
        <a href="#" id="compose" class="btn btn-danger" style="width:100%;margin-bottom:20px">{{Lang::get('messages.compose')}}</a>
        <div class="box">
            <ul class="nav nav-pills nav-stacked">
                <li><a href="{{URL::to('mail/1')}}"><i class="fa fa-inbox"></i> {{Lang::get('messages.inbox')}}</a></li>
                <li><a href="{{URL::to('mail/2')}}"><i class="fa fa-send"></i> {{Lang::get('messages.sent')}}</a></li>
                <li><a href="{{URL::to('mail/3')}}"><i class="fa fa-trash-o"></i> {{Lang::get('messages.trash')}}</a></li>
            </ul>
        </div>
    </div>
    <div class="col-sm-1"></div>
    <div class="col-sm-8">
        <div class="box">
            <h4>
                @if($type==1)
                <i class="fa fa-inbox"></i> {{Lang::get('messages.inbox')}}
                @endif
                @if($type==2)
                <i class="fa fa-send"></i> {{Lang::get('messages.sent')}}
                @endif
                @if($type==3)
                <i class="fa fa-trash-o"></i> {{Lang::get('messages.trash')}}
                @endif

            </h4>
            @if(Session::has('success'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong><i class="fa fa-check"></i> {{Session::get('success')}}</strong>
            </div>
            @endif
            @if(Session::has('error'))
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong><i class="fa fa-check"></i> {{Session::get('error')}}</strong>
            </div>
            @endif
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr style="height:20px;">
                            <th>
                            <th><i class="fa fa-language"></i> {{Lang::get('messages.title')}} <a href="{{URL::to('ordermail/title')}}"><i class="fa fa-arrows-v"></i></a></th>
                            <th><i class="fa fa-user"></i> {{Lang::get('messages.sender')}}</th>
                            <th><i class="fa fa-calendar"></i> {{Lang::get('messages.date')}} <a href="{{URL::to('ordermail/created_at')}}"><i class="fa fa-arrows-v"></i></a></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($type==3)
                    <form method="get" action="{{URL::to('restoremail')}}">
                        @else
                        <form method="get" action="{{URL::to('deletemail')}}">
                            @endif
                            @if($mails->count()< 1)
                            <tr style="height:20px;"><td>{{Lang::get('messages.empty')}}</td><td>{{Lang::get('messages.empty')}}</td></tr>
                            @endif
                            @foreach($mails as $mail)
                            <tr style="height:20px;">
                                <td class="col-sm-1">
                                    <input type="checkbox" name="delete[]" value="{{$mail->id}}">
                                </td>
                                <td>
                                    @if($type==1)
                                    @if($mail->read==1)
                                    <i class="fa fa-envelope-o"></i>
                                    @else
                                    <i class="fa fa-envelope"></i>
                                    @endif
                                    @endif
                                    <a href="{{URL::to('message/'.$mail->id)}}">{{$mail->title}}</a></td> <td><a href="{{URL::to('profile/'.User::find($mail->msg_from)->email)}}"> {{User::find($mail->msg_from)->first_name}} {{User::find($mail->msg_from)->surname}}</a></td><td>{{substr($mail->created_at,0,10)}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                            </table>
                            @if($type!=3)
                            <button type="submit"><i class="fa fa-trash-o"></i></button>
                            @else
                            <button type="submit"><i class="fa fa-mail-reply"></i> {{Lang::get('messages.restore')}}</button>
                            @endif
                        </form>
                        {{$mails->links()}}
                        </div>
                        </div>
                        </div>
                        </div>
                        @stop