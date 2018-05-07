<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Front\BaseController;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\FilesInfo;
use App\Models\Tags;

class TagsController extends BaseController
{
    public function detail(Request $request, $slug)
    {
        $params   = array();
        $fileIds  = array();

        $tag = Tags::where('slug', $slug)->first();
        if ($tag !== NULL) {
            $params['tag_id'] = $tag->id;
        }

        if ( ! empty($params)) {
            $files = FilesInfo::getListFileByTagId($params);

            $fileIds = $files->map(function ($file) {
                return $file->id;
            })->toArray();
        }

        $data = array(
            'files'      => $files,
            'tag'        => $tag,
            'tags'       => Tags::getTagsByIdFiles($fileIds),
            'cateTags'   => Category::getCatesByIdFiles($fileIds),
        );

        return view('front.tag.detail', $data);
    }
}