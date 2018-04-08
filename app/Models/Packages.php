<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Packages extends Model  {


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'packages_info';

    public static function getAllPackage()
    {
        $queryReturn = Packages::select('*')
            ->paginate(10);

        return $queryReturn;
    }

    public static function getPackageById($id)
    {
        $queryReturn = Packages::find($id);

        return $queryReturn;
    }
}