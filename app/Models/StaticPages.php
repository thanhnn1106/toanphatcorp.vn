<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaticPages extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'static_pages';

    public static function getAllStaticPages()
    {
        $queryReturn = StaticPages::select('*')
            ->paginate(LIMIT_ROW);

        return $queryReturn;
    }

    public static function getPageDetailBySlug($slug)
    {
        $status = config('site.static_page_status.value');
        $queryReturn = StaticPages::select('*')
            ->where('slug', '=', $slug)
            ->where('status', '=', $status['active'])
            ->first();

        return $queryReturn;
    }
}
