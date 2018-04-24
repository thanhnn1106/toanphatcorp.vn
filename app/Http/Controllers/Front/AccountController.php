<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Front\BaseController;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\FilesInfo;


class AccountController extends BaseController
{
    public function index(Request $request)
    {
        $user = \Auth::user();

        $data = array(
            'user'      => $user,
        );

        return view('front.account.index', $data);
    }
}