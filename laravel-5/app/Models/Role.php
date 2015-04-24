<?php namespace App\Models;

use App\Traits\RoleTrait;
use App\Traits\SlugableTrait;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\RoleContract;

class Role extends Model implements RoleContract
{
    use RoleTrait, SlugableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'description', 'level'];

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
