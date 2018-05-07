<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faqs;

class FaqsController extends Controller
{
    public function index(Request $request)
    {
        $data = array(
            'faqs'       => Faqs::getListFront(),
        );

        return view('front.faqs.index', $data);
    }
}