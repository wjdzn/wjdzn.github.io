<<<<<<< HEAD
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
=======
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
>>>>>>> f9eb8f2935e210dc911e20d1ac3f5a5339b5f8e8
