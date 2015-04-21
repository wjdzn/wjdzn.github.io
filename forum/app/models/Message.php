<?php

class Message extends Eloquent
{

    protected $table = 't_messages';
    protected $fillable = array('box', 'msg_from', 'msg_to', 'msg', 'read', 'deleted', 'title');

}
