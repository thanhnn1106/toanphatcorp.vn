<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Front\BaseController;
use Illuminate\Http\Request;
use App\Models\PurchaseHistory;


class AccountController extends BaseController
{
    public function index(Request $request)
    {
        $user = \Auth::user();

        $data = array(
            'user'       => $user,
            'infoChases' => PurchaseHistory::getList(),
        );

        return view('front.account.index', $data);
    }
}