@extends('../layouts/default')

@section('title')
{{Lang::get('messages.reports')}}
@stop

@section('content')
<div class="row">
    <div class="col-sm-3 box">
        <ul class='nav nav-pills nav-stacked'>
            <li><a href="{{URL::to('admin-panel')}}"><i class='fa fa-home'></i> {{Lang::get('messages.home')}}</a></li>
            <li><a href="{{URL::to('admin-panel/settings')}}"><i class='fa fa-wrench'></i> {{Lang::get('messages.basic_settings')}}</a></li>
            <li><a href="{{URL::to('admin-panel/themes')}}"><i class='fa fa-desktop'></i> {{Lang::get('messages.themes')}}</a></li>
            <li><a href="{{URL::to('admin-panel/users')}}"><i class='fa fa-group'></i> {{Lang::get('messages.users')}}</a></li>
            <li class="active"><a href="{{URL::to('admin-panel/reports')}}"><i class='fa fa-flag'></i> {{Lang::get('messages.reports')}}</a></li>
            <li><a href="{{URL::to('admin-panel/bans')}}"><i class='fa fa-ban'></i> {{Lang::get('messages.bans')}}</a></li>
            <li><a href="{{URL::to('admin-panel/tos')}}"><i class="fa fa-list"></i> {{Lang::get('messages.terms_of_service')}}</a></li>
        </ul>
    </div>
    <div class='col-sm-1'></div>
    <div class="col-sm-8 box">
        <h3 align="center"><i class='fa fa-flag'></i> {{Lang::get('messages.reports')}}</h3>
        <table class="table table-hover">
            <thead>
                <tr style="height:20px;">
                    <th>{{Lang::get('messages.id')}}</th>
                    <th>{{Lang::get('messages.by')}}</th>
                    <th>{{Lang::get('messages.date')}}</th>
                </tr>
            </thead>
            <tbody>
                @if($reports->count()< 1)
                <tr><td class="vert-align"><i class='fa fa-warning'></i> {{Lang::get('messages.there_are_not_any_reports')}}</td><td></td><td></td></tr>
                @endif
                @foreach($reports as $report)
                <tr>
                    <td class="vert-align col-md-1"> {{$report->id}}</td>
                    <td class="vert-align col-md-4"><a href="{{URL::to('profile/'.User::find($report->by_id)->email)}}">{{User::find($report->by_id)->first_name}} {{User::find($report->by_id)->surname}}</a></td>
                    <td class="vert-align col-md-2">
                        @if($report->type==1)
                        {{Lang::get('messages.reply')}}
                        @endif
                        @if($report->type==2)
                        {{Lang::get('messages.discussion')}}
                        @endif
                    </td>
                    <td class="vert-align col-md-4">{{$report->created_at}}</td>
                    <td class="vert-align col-md-1"><a href="{{URL::to('report/'.$report->id)}}" class="label label-warning"><i class='fa fa-book'></i> {{Lang::get('messages.read')}}</a><a href="{{URL::to('report_d/'.$report->id)}}" class="label label-danger"><i class='fa fa-times'></i></a></td>
                </tr>		
                @endforeach
            </tbody>
        </table>
        <center>{{$reports->links()}}</center>
    </div>
</div>
@stop