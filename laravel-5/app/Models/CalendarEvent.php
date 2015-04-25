<?php namespace App\Models;

use App\Traits\RoleTrait;
use App\Traits\SlugableTrait;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\RoleContract;

class CalendarEvent extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'calendar_events';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'init_at','end_at'];

    /**
     * Create a new Eloquent model instance.
     *
     * @param array $attributes
     * @return mixed
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        if ($connection = Config::get('roles.connection')) {
            $this->connection = $connection;
        }
    }
}
