<<<<<<< HEAD
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
=======
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
>>>>>>> f9eb8f2935e210dc911e20d1ac3f5a5339b5f8e8
