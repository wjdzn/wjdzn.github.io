<?php namespace App\Models;

use App\Traits\SlugableTrait;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;
use App\Traits\PermissionTrait;
use App\Contracts\PermissionContract;

class Permission extends Model implements PermissionContract
{
    use PermissionTrait, SlugableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'description', 'model'];

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
