<?php

class Key extends Eloquent
{

    public $timestamps = false;
    protected $table = 't_keys';
    protected $fillable = array('user_id', 'created', 'key');

}
