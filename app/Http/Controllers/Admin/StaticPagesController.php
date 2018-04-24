<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StaticPages;
use Validator;

class StaticPagesController extends Controller
{
    public function index()
    {
        $data = array(
            'staticPages' => StaticPages::getAllStaticPages()
        );
        return view('admin.static_pages.index', $data);
    }

    public function edit(Request $request, $pageId)
    {
        $page = StaticPages::find($pageId);
        if ($page === NULL) {
            $request->session()->flash('error', trans('common.msg_data_not_found'));
            return redirect(route('admin.staticPages'));
        }

        $data = array(
            'actionForm' => route('admin.staticPages.edit', ['pageId' => $pageId]),
            'pageInfo'   => $page,
            'title'      => 'Cập nhật',
            'titlePage'  => $page->title
        );
        if ($request->isMethod('POST')) {

            $rules = $this->_setRules($request, $pageId);

            // run the validation rules on the inputs from the form
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect()->route('admin.staticPages.edit', ['page' => $page])
                            ->withErrors($validator)
                            ->withInput();
            }

            $page->status = $request->get('status');
            $page->content = $request->get('content');
            $page->save();

            $request->session()->flash('success', trans('common.msg_update_success'));
            return redirect()->route('admin.staticPages');
        }

        return view('admin.static_pages.form', $data);
    }

    private function _setRules($request, $id = null)
    {
        $status       = array_values(config('site.user_status.value'));
        $rules =  array(
            'status'    => 'required|in:'. implode(',', $status),
        );

        return $rules;
    }
}