<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Validator;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $data = array(
            'categories' => Category::getList(),
        );
        return view('admin.category.list', $data);
    }

    public function add(Request $request)
    {
        $data = array(
            'actionForm' => route('admin.category.add'),
            'title'      => 'Add new',
        );

        if ($request->isMethod('POST')) {

            $rules = $this->_setRules($request);

            // run the validation rules on the inputs from the form
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect()->route('admin.category.add')
                            ->withErrors($validator)
                            ->withInput();
            }

            Category::insert([
                'thumbnail'   => Category::uploadThumbnail($request),
                'name'        => $request->get('name'),
                'slug'        => str_slug($request->get('name')),
                'description' => $request->get('description'),
                'created_at'  => date('Y-m-d H:i:s')
            ]);

            $request->session()->flash('success', trans('common.msg_create_success'));
            return redirect()->route('admin.category');
        }

        return view('admin.category.form', $data);
    }

    public function edit(Request $request, $categoryId)
    {
        $category = Category::find($categoryId);
        if ($category === NULL) {
            $request->session()->flash('error', trans('common.msg_data_not_found'));
            return redirect(route('admin.category'));
        }

        $data = array(
            'actionForm' => route('admin.category.edit', ['categoryId' => $categoryId]),
            'category'   => $category,
            'title'      => 'Edit',
        );

        if ($request->isMethod('POST')) {

            $rules = $this->_setRules($request, $categoryId);

            // run the validation rules on the inputs from the form
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect()->route('admin.category.edit', ['categoryId' => $categoryId])
                            ->withErrors($validator)
                            ->withInput();
            }

            $thumbnail = Category::uploadThumbnail($request);
            if ( ! empty($thumbnail)) {
                $category->thumbnail = $thumbnail;
            }
            $category->name = $request->get('name');
            $category->slug = str_slug($request->get('name'));
            $category->description = $request->get('description');
            $category->save();

            $request->session()->flash('success', trans('common.msg_update_success'));
            return redirect()->route('admin.category');
        }

        return view('admin.category.form', $data);
    }

    public function delete(Request $request, $categoryId)
    {
        $category = Category::find($categoryId);
        if ($category === NULL) {
            $request->session()->flash('error', trans('common.msg_data_not_found'));
            return redirect(route('admin.category'));
        }

        $category->delete();

        $request->session()->flash('success', trans('common.msg_delete_success'));
        return redirect()->route('admin.category');
    }

    private function _setRules($request, $id = null)
    {
        $thumbnail = '';
        if ($id === null) {
            $thumbnail = 'required|';
        }

        $rules =  array(
            'thumbnail'        => $thumbnail.'max:2048|mimes:'.config('site.file_accept_types'),
            'name'             => 'required|max:255',
            'description'      => 'max:255',
        );

        return $rules;
    }
}