<<<<<<< HEAD
<?php

class Mute extends Eloquent
{

    public $timestamps = false;
    protected $table = 't_mutes';
    protected $fillable = array('reason', 'user_id', 'muted_from', 'muted_to');

}
=======
<?php

class Mute extends Eloquent
{

    public $timestamps = false;
    protected $table = 't_mutes';
    protected $fillable = array('reason', 'user_id', 'muted_from', 'muted_to');

}
>>>>>>> f9eb8f2935e210dc911e20d1ac3f5a5339b5f8e8
