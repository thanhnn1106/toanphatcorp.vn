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
            ->paginate(LIMIT_ROW);

        return $queryReturn;
    }

    public static function getPackageById($id)
    {
        $queryReturn = Packages::find($id);

        return $queryReturn;
    }

    public static function getPackages($params = array())
    {
        $status = isset($params['status']) ? $params['status'] : config('site.package_status.value.active');

        $query = $queryReturn = Packages::select('*');
        $query->where('status', $status);

        return $query->get();
    }
}