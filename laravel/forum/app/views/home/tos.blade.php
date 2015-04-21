@extends('../layouts/default')

@section('title')
{{Lang::get('messages.terms_of_service')}}
@stop

@section('content')
<div class="box">
    <h3 align="center"><i class="fa fa-list"></i> {{Lang::get('messages.terms_of_service')}}</h3>
    <div class="well">
        @if(TOS::first()!=null)
        {{TOS::first()->tos}}
        @endif
    </div>
</div>
@stop