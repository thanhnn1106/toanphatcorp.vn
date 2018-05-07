<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Front\BaseController;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Packages;


class PackageController extends BaseController
{
    public function index(Request $request)
    {
        $data = array(
            'packages'   => Packages::getPackages(),
        );

        return view('front.package.index', $data);
    }
}