<?php

class Ban extends Eloquent
{

    public $timestamps = false;
    protected $table = 't_bans';
    protected $fillable = array('user_id', 'ip', 'bannedIp', 'bannedUser', 'ban_from', 'ban_to');

}
