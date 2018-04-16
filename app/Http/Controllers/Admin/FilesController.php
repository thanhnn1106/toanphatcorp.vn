<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FilesInfo;
use App\Models\Category;
use App\Models\Tags;
use Validator;
use Illuminate\Support\Facades\DB;

class FilesController extends Controller
{
    public function index(Request $request)
    {
        $data = array(
            'files' => FilesInfo::getList(),
        );
        return view('admin.files.list', $data);
    }

    public function add(Request $request)
    {
        $data = array(
            'actionForm' => route('admin.files.add'),
            'title'      => 'Add new',
            'categories' => Category::all(),
        );

        if ($request->isMethod('POST')) {
            $rules = $this->_setRules($request);

            // run the validation rules on the inputs from the form
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect()->route('admin.files.add')
                            ->withErrors($validator)
                            ->withInput();
            }

            DB::beginTransaction();

            try {
                $filesInfo = FilesInfo::firstOrCreate([
                    'thumbnail'   => FilesInfo::uploadThumbnail($request),
                    'category_id'        => $request->get('category_id'),
                    'title'        => $request->get('title'),
                    'slug'        => str_slug($request->get('title')),
                    'file_name'   => $request->get('file_name'),
                    'track_list' => $request->get('track_list'),
                    'type_download' => $request->get('type_download', config('site.type_download.value.inactive')),
                    'status' => $request->get('status', config('site.status.value.inactive')),
                    'created_at'  => date('Y-m-d H:i:s')
                ]);
                $this->_saveTags($filesInfo, $request);

                FilesInfo::makeCateFolderAndFile($filesInfo, null, 'add');

                DB::commit();

                $request->session()->flash('success', trans('common.msg_create_success'));
                return redirect()->route('admin.files');

            } catch (\Exception $e) {
                DB::rollback();

                $request->session()->flash('error', trans('common.msg_update_error'));
                return redirect()->route('admin.files');
            }
        }

        return view('admin.files.form', $data);
    }

    public function edit(Request $request, $fileId)
    {
        $file = FilesInfo::find($fileId);
        if ($file === NULL) {
            $request->session()->flash('error', trans('common.msg_data_not_found'));
            return redirect(route('admin.files'));
        }
        $olCateName = $file->category->name;

        $data = array(
            'actionForm' => route('admin.files.edit', ['fileId' => $fileId]),
            'file'   => $file,
            'title'      => 'Edit',
            'categories' => Category::all(),
        );

        if ($request->isMethod('POST')) {

            $rules = $this->_setRules($request, $fileId);

            // run the validation rules on the inputs from the form
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect()->route('admin.files.edit', ['fileId' => $fileId])
                            ->withErrors($validator)
                            ->withInput();
            }

            DB::beginTransaction();

            try {

                $thumbnail = FilesInfo::uploadThumbnail($request);
                if ( ! empty($thumbnail)) {
                    $file->thumbnail = $thumbnail;
                }

                $file->category_id = $request->get('category_id');
                $file->slug = str_slug($request->get('title'));
                $file->title = $request->get('title');
                $file->file_name = $request->get('file_name');
                $file->track_list = $request->get('track_list');
                $file->type_download = $request->get('type_download', config('site.type_download.value.inactive'));
                $file->status = $request->get('status', config('site.status.value.inactive'));
                $file->save();

                $this->_saveTags($file, $request);

                FilesInfo::makeCateFolderAndFile($file, $olCateName);

                DB::commit();

                $request->session()->flash('success', trans('common.msg_update_success'));
                return redirect()->route('admin.files');

            } catch (\Exception $e) {

                DB::rollback();

                $request->session()->flash('error', trans('common.msg_update_error'));
                return redirect()->route('admin.files');
            }
        }

        return view('admin.files.form', $data);
    }

    public function delete(Request $request, $fileId)
    {
        $file = FilesInfo::find($fileId);
        if ($file === NULL) {
            $request->session()->flash('error', trans('common.msg_data_not_found'));
            return redirect(route('admin.files'));
        }

        $hasDelete = $file->deleteFiles();
        if ($hasDelete) {
            $request->session()->flash('success', trans('common.msg_delete_success'));
        } else {
            $request->session()->flash('warning', trans('common.can_not_delete'));
        }

        return redirect()->route('admin.files');
    }

    private function _saveTags($filesInfo, $request)
    {
        $tags = explode(',', $request->get('tag_name'));
        if ( ! empty($tags)) {
            $tagIds = [];
            foreach ($tags as $tag) {
                $objTag = Tags::where('name', trim($tag))->first();
                if ($objTag === NULL) {
                    $objTag = Tags::firstOrCreate([
                        'name' => $tag,
                        'slug' => str_slug($tag),
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
                }
                $tagIds[] = $objTag->id;
            }
            $filesInfo->tags()->sync($tagIds);
        }
    }

    private function _setRules($request, $id = null)
    {
        $thumbnail = '';
        if ($id === null) {
            $thumbnail = 'required|';
        }
        $typeDownload = array_values(config('site.type_download.value'));
        $status       = array_values(config('site.file_status.value'));

        $rules =  array(
            'thumbnail'        => $thumbnail.'max:2048|mimes:'.config('site.file_accept_types'),
            'category_id'      => 'required|exists:categories,id',
            'title'            => 'required|max:255',
            'tag_name'         => 'required',
            'file_name'        => 'required',
            'track_list'       => 'required',
            'type_download'    => 'required|in:'. implode(',', $typeDownload),
            'status'           => 'required|in:'. implode(',', $status),
        );

        return $rules;
    }
}