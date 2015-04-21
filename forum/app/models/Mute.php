<?php

class Mute extends Eloquent
{

    public $timestamps = false;
    protected $table = 't_mutes';
    protected $fillable = array('reason', 'user_id', 'muted_from', 'muted_to');

}
