<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class BaseController extends Controller
{
    public function download(Request $request)
    {
        if ( ! $request->isMethod('POST')) {
            return redirect(Request::url());
        }

        if (empty($request->get('file_id'))) {
            return redirect(Request::url());
        }

        $file = \App\Models\FilesInfo::where('id', $request->get('file_id'))->where('status', config('site.file_status.value.active'))->first();
        if ($file === NULL) {
            return redirect(Request::url());
        }

        if ( ! $file->isDownload()) {
            return redirect(Request::url());
        }
        $data = array(
            'files'      => FilesInfo::getListFront(),
            'categories' => Category::getCateFile(),
        );
        return view('front.home.index', $data);
    }
}