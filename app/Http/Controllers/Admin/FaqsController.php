<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faqs;
use Validator;

class FaqsController extends Controller
{
    public function index(Request $request)
    {
        $data = array(
            'faqs' => Faqs::getList(),
        );

        return view('admin.faqs.index', $data);
    }

    public function add(Request $request)
    {
        $data = array(
            'actionForm' => route('admin.faqs.add'),
            'title'      => 'Thêm mới',
            'status'     => config('site.faqs_status.value'),
        );
        if ($request->isMethod('POST')) {
            $rules = $this->_setRules($request);

            // run the validation rules on the inputs from the form
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect()->route('admin.faqs.add')
                            ->withErrors($validator)
                            ->withInput();
            }

            Faqs::insert([
                'question'   => $request->get('question'),
                'answer'     => $request->get('answer'),
                'status'     => $request->get('status'),
                'created_at' => date('Y-m-d H:i:s')
            ]);
            $request->session()->flash('success', trans('common.msg_create_success'));

            return redirect()->route('admin.faqs');
        }

        return view('admin.faqs.form', $data);
    }

    public function edit(Request $request, $faqId)
    {
        $faq = Faqs::find($faqId);
        if ($faq === NULL) {
            $request->session()->flash('error', trans('common.msg_data_not_found'));
            return redirect(route('admin.faqs'));
        }

        $data = array(
            'actionForm' => route('admin.faqs.edit', ['faqId' => $faqId]),
            'faqInfo'      => $faq,
            'title'      => 'Cập nhật',
            'status'     => config('site.faqs_status.value'),
        );
        if ($request->isMethod('POST')) {

            $rules = $this->_setRules($request, $faqId);

            // run the validation rules on the inputs from the form
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect()->route('admin.faqs.edit', ['faq' => $faq])
                            ->withErrors($validator)
                            ->withInput();
            }

            $faq->question = $request->get('question');
            $faq->answer   = $request->get('answer');
            $faq->status   = $request->get('status');
            $faq->save();

            $request->session()->flash('success', trans('common.msg_update_success'));
            return redirect()->route('admin.faqs');
        }

        return view('admin.faqs.form', $data);
    }

    public function delete(Request $request, $faqId)
    {
        $faq = Faqs::find($faqId);
        if ($faq === NULL) {
            $request->session()->flash('error', trans('common.msg_data_not_found'));
            return redirect(route('admin.faqs'));
        }

        $faq->delete();

        $request->session()->flash('success', trans('common.msg_delete_success'));
        return redirect()->route('admin.faqs');
    }

    private function _setRules($request, $id = null)
    {
        $status = config('site.faqs_status.value');

        $rules =  array(
            'question' => 'required|max:255',
            'answer'   => 'required',
            'status'   => 'required|in:'. implode(',', $status),
        );

        return $rules;
    }
}