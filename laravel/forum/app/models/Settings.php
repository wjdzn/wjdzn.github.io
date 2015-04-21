<?php

class Settings extends Eloquent
{

    public $timestamps = false;
    protected $table = 't_settings';
    protected $fillable = array('title', 'description', 'acc_activaiton', 'keywords', 'tos', 'fb_app_id', 'fb_app_secret', 'theme');

}
