@extends('../layouts/default')

@section('title')
{{$message->title}}
@stop

@section('content')
<div class="box">
    <div class="row">
        <div class="col-sm-2"></div>	
        <div class="col-sm-8" style="word-wrap:break-word;">
            <h3 align="center"><i class="fa fa-envelope-o"></i> {{$message->title}}</h3>
            <center><i class="fa fa-clock-o"></i> {{substr($message->created_at,0,10)}} | <i class='fa fa-user'></i> {{User::find($message->msg_from)->email}}
                <p>{{$message->msg}}</p></center>
        </div>	
        <div class="col-sm-2"></div>	
    </div>
</div>
@stop