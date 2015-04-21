<?php

class Post extends Eloquent
{

    protected $table = 't_posts';
    protected $fillable = array('by', 'text', 'dis_id', 'likes');

    public function discussion()
    {
        $this->belongsTo('Discussion');
    }

}
