<<<<<<< HEAD
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
=======
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
>>>>>>> f9eb8f2935e210dc911e20d1ac3f5a5339b5f8e8
