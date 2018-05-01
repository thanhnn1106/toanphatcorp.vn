<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faqs;
use App\Models\Category;
use Validator;

class FaqsController extends Controller
{
    public function index(Request $request)
    {
        $data = array(
            'faqs' => Faqs::getListFront(),
            'categories' => Category::all()
        );

        return view('front.faqs.index', $data);
    }
}