<?php

class Profile extends Eloquent
{

    protected $table = 't_profiles';
    protected $fillable = array('user_id', 'city', 'job', 'about');

    public function user()
    {
        return $this->belongsTo('User', 'user_id');
    }

}
