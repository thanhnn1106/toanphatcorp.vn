<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faqs extends Model
{
    public static function getList()
    {
        $queryReturn = Faqs::select('*')
            ->orderBy('created_at', 'DESC')
            ->paginate(LIMIT_ROW);

        return $queryReturn;
    }

    public static function getListFront()
    {
        $queryReturn = Faqs::select('*')
            ->orderBy('created_at', 'DESC')
            ->get();

        return $queryReturn;
    }
}
