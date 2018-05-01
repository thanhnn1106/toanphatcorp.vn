<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Front\BaseController;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\FilesInfo;
use App\Models\Tags;


class HomeController extends BaseController
{
    public function index(Request $request)
    {
        if ($request->get('keyword')) {
            return $this->search($request);
        }

        // Get newest files.
        $currentDate = date('Y-m-d', strtotime(date('Y-m-d') . "+1 day"));

        do {
            $currentDate = date("Y-m-d", strtotime($currentDate . "-1 day"));
            $fielList = FilesInfo::getNewFileFront($currentDate);
        } while (count($fielList) <= 0);

        $data = array(
            'files'      => $fielList,
            'categories' => Category::getCateFile(),
        );

        return view('front.home.index', $data);
    }

    public function search(Request $request)
    {
        $keyword = $request->get('keyword');

        $files = FilesInfo::search(array('keyword' => $keyword));

        $fileIds = $files->map(function ($file) {
            return $file->id;
        })->toArray();

        $data = array(
            'keyword' => $keyword,
            'files'   => $files,
            'categories' => Category::getCateFile(),
            'tags'       => Tags::getTagsByIdFiles($fileIds),
            'cateTags'   => Category::getCatesByIdFiles($fileIds),
        );

        return view('front.home.search', $data);
    }

    public function redirect(Request $request)
    {
        $data = array();
        return view('front.partial.redirect', $data);
    }
}