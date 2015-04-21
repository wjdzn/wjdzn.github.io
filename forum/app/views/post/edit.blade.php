@extends('../layouts/default')

@section('title')
{{Lang::get('messages.edit_a_post')}}
@stop

@section('content')
<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6 box">
        <h3 align="center"><i class='fa fa-pencil'></i> {{Lang::get('messages.edit_a_post')}}</h3>
        <form method="post" action="{{URL::to('post/'.$post->id)}}">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" name="_method" value="PUT">
            <textarea name="reply" id="reply"></textarea>
            <br />
            <button type="submit" class="btn btn-primary"> {{Lang::get('messages.update')}} </button>
        </form>
    </div>
    <div class="col-sm-3"></div>
</div>
<script type="text/javascript">
    CKEDITOR.replace('reply');
    CKEDITOR.instances.reply.setData('{{trim($post->text)}}');
</script>
@stop