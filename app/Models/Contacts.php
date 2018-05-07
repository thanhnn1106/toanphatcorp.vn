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

    public static function getList($params)
    {
        $query = Contacts::where('email', 'LIKE', "%{$params['email']}%");;
        if ($params['filter_status'] != '') {
            $query->where('status', '=', $params['filter_status']);
        }
        $query->orderBy('created_at', 'DESC');
        $result = $query->paginate(LIMIT_ROW);

        return $result;
    }

}
