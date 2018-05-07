<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Front\BaseController;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\FilesInfo;
use App\Models\Tags;


class FilesController extends BaseController
{
    /**
     * Get file detail.
     *
     * @param $slug string
     * @author ngthanh <thanh.nn1106@gmail.com>
     */
    public function detail(Request $request, $slug)
    {
        $status = config('site.file_status.value');
        $fileInfo = FilesInfo::where('slug', '=', $slug)
            ->where('status', '=', $status['active'])
            ->first();
        if (empty($fileInfo)) {
            $data = [
                'file' => null,
            ];

            return view('front.file.detail', $data);
        }

        $fileInfoNext = FilesInfo::where('id', '>', $fileInfo->id)
            ->where('status', '=', $status['active'])
            ->orderBy('id')
            ->limit(1)
            ->first();
        $fileInfoPrevious = FilesInfo::where('id', '<', $fileInfo->id)
            ->where('status', '=', $status['active'])
            ->orderBy('id')
            ->limit(1)
            ->first();
        $data = [
            'file'         => $fileInfo,
            'fileNext'     => $fileInfoNext,
            'filePrevious' => $fileInfoPrevious,
            'tags'         => Tags::getTagsByIdFiles(array($fileInfo->id)),
            'cateTags'     => Category::getCatesByIdFiles(array($fileInfo->id)),
        ];

        return view('front.file.detail', $data);
    }
}