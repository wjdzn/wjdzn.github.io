<?php

class Like extends Eloquent
{

    public $timestamps = false;
    protected $table = 't_likes';
    protected $fillable = array('by_id', 'post_id');

}
