<?php

class Widget extends Eloquent
{

    protected $table = 't_widgets';
    protected $fillable = array('position', 'type', 'ad_x', 'ad_y', 'ad_type', 'custom');

}
