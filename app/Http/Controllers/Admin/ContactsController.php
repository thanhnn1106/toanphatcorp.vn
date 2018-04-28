<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contacts;
use Validator;

class ContactsController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('contactStatus');
        $data = array(
            'contacts' => Contacts::getList($status),
            'filter' => $status
        );
        return view('admin.contacts.list', $data);
    }

    public function edit(Request $request, $contactId)
    {
        $contact = Contacts::find($contactId);
        if ($contact === NULL) {
            $request->session()->flash('error', trans('common.msg_data_not_found'));
            return redirect(route('admin.contacts.edit'));
        }

        $data = array(
            'actionForm' => route('admin.contacts.edit', ['contactId' => $contactId]),
            'contactInfo'      => $contact,
            'title'      => 'Cập nhật',
        );
        if ($request->isMethod('POST')) {

            $rules = $this->_setRules($request, $contactId);

            // run the validation rules on the inputs from the form
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect()->route('admin.contacts.edit', ['contactId' => $contactId])
                            ->withErrors($validator)
                            ->withInput();
            }

            $contact->status = $request->get('status');
            $contact->note = $request->get('note');
            $contact->save();

            $request->session()->flash('success', trans('common.msg_update_success'));
            return redirect()->route('admin.contacts');
        }

        return view('admin.contacts.form', $data);
    }

    public function delete(Request $request, $contactId)
    {
        $contact = Contacts::find($contactId);
        if ($contact === NULL) {
            $request->session()->flash('error', trans('common.msg_data_not_found'));
            return redirect(route('admin.contacts'));
        }

        $contact->delete();

        $request->session()->flash('success', trans('common.msg_delete_success'));
        return redirect()->route('admin.contacts');
    }

    private function _setRules($request, $id = null)
    {
        $status = array_keys(config('site.contact_status.label'));
        $rules =  array(
            'status'    => 'required|in:'. implode(',', $status),
        );

        return $rules;
    }
}