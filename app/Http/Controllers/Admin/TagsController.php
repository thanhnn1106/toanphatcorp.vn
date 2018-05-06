<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tags;
use Validator;

class TagsController extends Controller
{
    public function index(Request $request)
    {
        $paramSearch['name'] = $request->get('name');
        $paramSearch['is_popular'] = $request->get('is_popular');
        $data = array(
            'tags'      => Tags::getList($paramSearch),
            'status'    => config('site.tags_status.label'),
            'name'   => $paramSearch['name'],
            'is_popular' => $paramSearch['is_popular']
        );
        return view('admin.tag.list', $data);
    }

    public function add(Request $request)
    {
        $data = array(
            'actionForm' => route('admin.tags.add'),
            'title'      => 'Thêm mới',
            'status' => config('site.tags_status.value')
        );

        if ($request->isMethod('POST')) {

            $rules = $this->_setRules($request);

            // run the validation rules on the inputs from the form
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect()->route('admin.tags.add')
                            ->withErrors($validator)
                            ->withInput();
            }
            $insert = [
                'name'        => $request->get('name'),
                'slug'        => str_slug($request->get('name')),
                'is_popular'  => $request->get('is_popular'),
                'created_at'  => date('Y-m-d H:i:s')
            ];

            Tags::insert($insert);

            $request->session()->flash('success', trans('common.msg_create_success'));
            return redirect()->route('admin.tags');
        }

        return view('admin.tag.form', $data);
    }

    public function edit(Request $request, $tagId)
    {
        $tag = Tags::find($tagId);
        if ($tag === NULL) {
            $request->session()->flash('error', trans('common.msg_data_not_found'));
            return redirect(route('admin.tags'));
        }

        $data = array(
            'actionForm' => route('admin.tags.edit', ['tagId' => $tagId]),
            'tag'   => $tag,
            'title'      => 'Cập nhật',
            'status' => config('site.tags_status.value')
        );

        if ($request->isMethod('POST')) {

            $rules = $this->_setRules($request, $tagId);

            // run the validation rules on the inputs from the form
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect()->route('admin.tags.edit', ['tagId' => $tagId])
                            ->withErrors($validator)
                            ->withInput();
            }

            $tag->name = $request->get('name');
            $tag->slug = str_slug($request->get('name'));
            $tag->is_popular = $request->get('is_popular');
            $tag->save();

            $request->session()->flash('success', trans('common.msg_update_success'));
            return redirect()->route('admin.tags');
        }

        return view('admin.tag.form', $data);
    }

    public function delete(Request $request, $tagId)
    {
        $tag = Tags::find($tagId);
        if ($tag === NULL) {
            $request->session()->flash('error', trans('common.msg_data_not_found'));
            return redirect(route('admin.tags'));
        }

        $tag->delete();
        $request->session()->flash('success', trans('common.msg_delete_success'));

        return redirect()->route('admin.tags');
    }

    private function _setRules($request, $id = null)
    {
        
        // Add
        if ($id === null) {
            $name = 'required|max:255|unique:tags,name';
        } else {
            $name = 'required|max:255';
        }
        $rules =  array(
            'name'       => $name,
            'is_popular' => 'boolean'
        );

        return $rules;
    }
}