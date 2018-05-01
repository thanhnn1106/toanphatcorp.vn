<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Roles;
use Validator;

class AdminsController extends Controller
{
    public function index(Request $request)
    {
        $data = array(
            'admins' => Admin::getList()
        );
        return view('admin.admins.list', $data);
    }

    public function add(Request $request)
    {
        $data = array(
            'actionForm' => route('admin.admins.add'),
            'title'      => 'Thêm mới',
            'roles'      => Roles::all(),
        );

        if ($request->isMethod('POST')) {
            $rules = $this->_setRules($request);

            // run the validation rules on the inputs from the form
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect()->route('admin.admins.add')
                            ->withErrors($validator)
                            ->withInput();
            }

            Admin::create([
                'user_name' => $request->get('user_name'),
                'password'  => bcrypt($request->get('password')),
                'role_id' => $request->get('role_id'),
                'status'    => $request->get('status'),
                'created_at'  => date('Y-m-d H:i:s')
            ]);

            $request->session()->flash('success', trans('common.msg_create_success'));
            return redirect()->route('admin.admins');
        }

        return view('admin.admins.form', $data);
    }

    public function edit(Request $request, $adminId)
    {
        $admin = Admin::find($adminId);
        if ($admin === NULL) {
            $request->session()->flash('error', trans('common.msg_data_not_found'));
            return redirect(route('admin.admins'));
        }

        $data = array(
            'actionForm' => route('admin.admins.edit', ['adminId' => $adminId]),
            'adminInfo'      => $admin,
            'title'      => 'Cập nhật',
            'roles'      => Roles::all(),
        );
        if ($request->isMethod('POST')) {

            $rules = $this->_setRules($request, $adminId);

            // run the validation rules on the inputs from the form
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect()->route('admin.admins.edit', ['admin' => $admin])
                            ->withErrors($validator)
                            ->withInput();
            }

            $admin->user_name = $request->get('user_name');
            $admin->role_id = $request->get('role_id');
            if (!empty($request->get('password'))) {
                $admin->password = bcrypt($request->get('password'));
            }
            $admin->status = $request->get('status');
            $admin->save();

            $request->session()->flash('success', trans('common.msg_update_success'));
            return redirect()->route('admin.admins');
        }

        return view('admin.admins.form', $data);
    }

    public function delete(Request $request, $adminId)
    {
        $admin = Admin::find($adminId);
        if ($admin === NULL) {
            $request->session()->flash('error', trans('common.msg_data_not_found'));
            return redirect(route('admin.admins'));
        }

        $admin->delete();

        $request->session()->flash('success', trans('common.msg_delete_success'));
        return redirect()->route('admin.admins');
    }

    private function _setRules($request, $id = null)
    {
        $status       = array_values(config('site.user_status.value'));
        $email = '';
        $password = '';
        // Add
        if ($id === null) {
            $password = 'required|min:8';
        } else {
            // Edit
            if (!empty($request->get('password'))) {
                $password = 'required|min:8';
            }
        }
        $rules =  array(
            'user_name' => 'required|max:255',
            'role_id' => 'required|exists:roles,id',
            'password'  => $password,
            'status'    => 'required|in:'. implode(',', $status),
        );

        return $rules;
    }
}