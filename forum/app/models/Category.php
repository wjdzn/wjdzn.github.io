<?php

class Category extends Eloquent
{

    protected $table = 't_categories';
    protected $fillable = array('name', 'description', 'min_membership', 'must_logged');

    public function discussions()
    {
        return $this->hasMany('Discussion', 'cat_id');
    }

}
