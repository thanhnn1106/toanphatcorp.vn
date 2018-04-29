<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Packages extends Model  {

    const PACKAGE_FOREIGN_KEY = 'package_id';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'packages_info';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'number_month',
        'status',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function purchases()
    {
        return $this->hasMany('App\Models\PurchaseHistory', 'id', 'package_id');
    }

    public static function getAllPackage()
    {
        $queryReturn = Packages::select('*')
            ->paginate(LIMIT_ROW);

        return $queryReturn;
    }

    public static function getPackageById($id, $params = array())
    {
        $query = Packages::where('id', $id);
        if (isset($params['status'])) {
            $query->where('status', $params['status']);
        }

        return $query->first();
    }

    public static function getPackages($params = array())
    {
        $status = isset($params['status']) ? $params['status'] : config('site.package_status.value.active');

        $query = $queryReturn = Packages::select('*');
        $query->where('status', $status);

        return $query->get();
    }
}