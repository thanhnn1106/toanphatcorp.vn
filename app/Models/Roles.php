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

    public function admins()
    {
        return $this->hasMany('App\Models\Admin', 'role_id', 'id');
    }
}