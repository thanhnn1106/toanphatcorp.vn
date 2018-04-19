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

        $tags = Tags::getTagsByIdFiles($fileIds);

        $infoTags = array();
        $tags->map(function ($tag) use ( & $infoTags) {
            $infoTags[$tag->file_id][] = array(
                'tag_id' => $tag->id,
                'name' => $tag->name,
                'slug' => $tag->slug,
            );
        });

        $data = array(
            'files'      => $files,
            'category'   => $category,
            'tags'       => $infoTags,
        );

        return view('front.category.detail', $data);
    }
}