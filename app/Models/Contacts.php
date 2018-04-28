<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contacts';

    public static function getList($status)
    {
        $result = Contacts::select('*');
            if ($status != '') {
                $result = $result->where('status', '=', $status)->orderBy('created_at', 'DESC')->paginate(LIMIT_ROW);
            } else {
                $result = $result->orderBy('created_at', 'DESC')->paginate(LIMIT_ROW);
            }
        return $result;
    }

}
