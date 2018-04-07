<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model  {


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    public function users()
    {
        return $this->hasMany('App\User', 'role_id', 'id');
    }
}