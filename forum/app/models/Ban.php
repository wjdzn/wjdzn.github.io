<<<<<<< HEAD
<?php

class Ban extends Eloquent
{

    public $timestamps = false;
    protected $table = 't_bans';
    protected $fillable = array('user_id', 'ip', 'bannedIp', 'bannedUser', 'ban_from', 'ban_to');

}
=======
<?php

class Ban extends Eloquent
{

    public $timestamps = false;
    protected $table = 't_bans';
    protected $fillable = array('user_id', 'ip', 'bannedIp', 'bannedUser', 'ban_from', 'ban_to');

}
>>>>>>> f9eb8f2935e210dc911e20d1ac3f5a5339b5f8e8
