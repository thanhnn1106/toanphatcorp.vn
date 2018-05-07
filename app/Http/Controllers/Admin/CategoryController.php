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
        $paramSearch['name'] = $request->get('name');
        $data = array(
            'categories' => Category::getList($paramSearch),
            'name' => $paramSearch['name'],
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
            $insert = [
                'name'        => $request->get('name'),
                'slug'        => str_slug($request->get('name')),
                'description' => $request->get('description'),
                'created_at'  => date('Y-m-d H:i:s')
            ];
            $thumbnail = Category::uploadImage($request);
            $cover     = Category::uploadImage($request, 'cover_image');
            if ( ! empty($thumbnail)) {
                $insert['thumbnail'] = $thumbnail;
            }
            if ( ! empty($cover)) {
                $insert['cover_image'] = $cover;
            }

            Category::insert($insert);

            Category::saveCateToFile();

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

            $thumbnail = Category::uploadImage($request);
            if ( ! empty($thumbnail)) {
                $category->thumbnail = $thumbnail;
            }
            $coverImage = Category::uploadImage($request, 'cover_image');
            if ( ! empty($coverImage)) {
                $category->cover_image = $coverImage;
            }
            $category->name = $request->get('name');
            $category->slug = str_slug($request->get('name'));
            $category->description = $request->get('description');
            $category->save();

            Category::saveCateToFile();

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

        $hasDelete = $category->deleteCate();

        if ($hasDelete) {
            $request->session()->flash('success', trans('common.msg_delete_success'));
        } else {
            $request->session()->flash('warning', trans('common.can_not_delete_category_because_it_is_using'));
        }
        return redirect()->route('admin.category');
    }

    private function _setRules($request, $id = null)
    {
        $rules =  array(
            'thumbnail'        => 'max:2048|mimes:'.config('site.file_accept_types'),
            'cover_image'      => 'max:2048|mimes:'.config('site.file_accept_types'),
            'name'             => 'required|unique:categories,name,'.$id.'|regex:/(^[A-Za-z0-9 ]+$)+/|max:255',
            'description'      => 'max:255',
        );

        return $rules;
    }
}