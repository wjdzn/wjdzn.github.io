<?php

class Discussion extends Eloquent
{

    protected $table = 't_discussions';
    protected $fillable = array('title', 'description', 'cat_id', 'by_id', 'views', 'hot', 'closed', 'type');

    public function category()
    {
        return $this->belongsTo('Category');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function posts()
    {
        return $this->hasMany('Post', 'dis_id');
    }

}
