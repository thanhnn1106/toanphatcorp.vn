<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StaticPages;
use App\Models\Category;
use Validator;

class StaticPagesController extends Controller
{
    public function detail(Request $request, $slug)
    {
        $page = StaticPages::getPageDetailBySlug($slug);
        if ($page === NULL) {
            return redirect(route('front.home'));
        }
        $data = [
            'pageDetail' => $page,
            'categories' => Category::getCateFile(),
        ];

        return view('front.static_page.detail', $data);
    }

}