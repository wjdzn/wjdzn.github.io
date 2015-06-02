<<<<<<< HEAD
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
=======
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
>>>>>>> f9eb8f2935e210dc911e20d1ac3f5a5339b5f8e8
