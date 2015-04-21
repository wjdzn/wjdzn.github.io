<?php

class Report extends Eloquent
{

    protected $table = 't_reports';
    protected $fillable = array('by_id', 'type', 'entity_id', 'report');

}
