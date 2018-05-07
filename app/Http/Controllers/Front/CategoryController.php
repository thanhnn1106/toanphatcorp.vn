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
        $fileIds  = array();
        $params   = array();

        $category = Category::where('slug', $slug)->first();
        if ($category !== NULL) {
            $params['category_id'] = $category->id;
        }

        if ( ! empty($params)) {
            $files = FilesInfo::getListFront($params);

            $fileIds = $files->map(function ($file) {
                return $file->id;
            })->toArray();
        }


        $data = array(
            'files'      => $files,
            'category'   => $category,
            'tags'       => Tags::getTagsByIdFiles($fileIds),
            'cateTags'   => Category::getCatesByIdFiles($fileIds),
        );

        return view('front.category.detail', $data);
    }

    public function calendar(Request $request, $date)
    {
        $checkYearMonth = \DateTime::createFromFormat('Y-m', $date);
        $checkDate      = \DateTime::createFromFormat('Y-m-d', $date);
        if ( ! $checkYearMonth && ! $checkDate) {
            return abort(404);
        }
        if ($checkYearMonth) {
            $searchDate = $checkYearMonth->format('Y-m');
        } else {
            $searchDate = $checkDate->format('Y-m-d');
        }

        $params   = array('search_date' => $searchDate);
        $files    = FilesInfo::search($params);

        $fileIds = $files->map(function ($file) {
            return $file->id;
        })->toArray();

        $data = array(
            'files'      => $files,
            'inputDate'  => $searchDate,
            'tags'       => Tags::getTagsByIdFiles($fileIds),
            'cateTags'   => Category::getCatesByIdFiles($fileIds),
        );

        return view('front.category.calendar', $data);
    }
}