<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class BaseController extends Controller
{
    public function normalDownload(Request $request)
    {
        if ( ! $request->isMethod('POST')) {
            return redirect(route('front.home'));
        }

        if (empty($request->get('file_id'))) {
            return redirect(route('front.home'));
        }

        $file = \App\Models\FilesInfo::where('id', $request->get('file_id'))->where('status', config('site.file_status.value.active'))->first();
        if ($file === NULL) {
            return redirect(route('front.home'));
        }

        if ( ! $file->isNormalDownload()) {
            return redirect(route('front.home'));
        }

        $download =  $file->download();
        if ($download === false) {
            return redirect(route('front.home'));
        }

        return $download;
    }
}