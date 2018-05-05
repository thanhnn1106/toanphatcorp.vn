<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Front\BaseController;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\FilesInfo;
use App\Models\Tags;

class CategoryController extends BaseController
{
    public function detail(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)->first();
        $params   = array();
        if ($category !== NULL) {
            $params['category_id'] = $category->id;
        }

        $files = FilesInfo::getListFront($params);

        $fileIds = $files->map(function ($file) {
            return $file->id;
        })->toArray();


        $data = array(
            'files'      => $files,
            'category'   => $category,
            'tags'       => Tags::getTagsByIdFiles($fileIds),
            'cateTags'   => Category::getCatesByIdFiles($fileIds),
            'categories' => Category::getCateFile(),
        );

        return view('front.category.detail', $data);
    }
}