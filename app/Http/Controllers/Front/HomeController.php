<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Front\BaseController;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\FilesInfo;


class HomeController extends BaseController
{
    public function index(Request $request)
    {
        $data = array(
            'files'      => FilesInfo::getListFront(),
            'categories' => Category::getCateFile(),
        );

        return view('front.home.index', $data);
    }

    public function redirect(Request $request)
    {
        $data = array();
        return view('front.partial.redirect', $data);
    }
}