<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Countries extends Model  {


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'countries';

    public function user()
    {
        return $this->hasOne('App\User', 'country_id', 'id');
    }

    public static function getCountriesList()
    {
        $result = DB::table('countries')->select('*')->orderBy('id')->get();
        return $result;
    }

    public static function getResults()
    {
        $countries = Countries::all(array('id', 'name'));
        return $countries;
    }
}