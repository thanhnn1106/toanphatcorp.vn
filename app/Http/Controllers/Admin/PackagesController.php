<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Packages;
use Illuminate\Http\Request;
use Validator;

class PackagesController extends Controller
{

    public function index(Request $request)
    {
        $packageList = Packages::getAllPackage();

        return view('admin.packages.index', ['packageList' => $packageList]);
    }

    public function add(Request $request)
    {
        $data = [
            'actionForm' => route('admin.package_add')
        ];
        if ($request->isMethod('POST')) {
            $rules =  array(
                'name'         => 'required|max:255',
                'number_month' => 'required|in:1,3,12',
                'price'        => 'required|numeric',
                'description'  => 'required',
                'status'       => 'required|in:0,1',
            );

            // run the validation rules on the inputs from the form
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect()->route('admin.package_add')
                            ->withErrors($validator)
                            ->withInput();
            }
            Packages::insert([
                'name' => $request->name,
                'number_month' => $request->number_month,
                'price' => $request->price,
                'description' => $request->description,
                'status' => $request->status,
            ]);

            $request->session()->flash('success', trans('common.msg_update_success'));

            return redirect(route('admin.package'));
        }

        return view('admin.packages.form', $data);
    }

    public function view(Request $request)
    {
        return view('admin.packages.form');
    }

    public function edit(Request $request, $id)
    {
        $data = [
            'actionForm' => route('admin.package_edit', ['id' => $id])
        ];
        $packageInfo = Packages::getPackageById($id);
        if ($packageInfo == NULL) {
            $request->session()->flash('error', trans('common.msg_data_not_found'));

            return redirect(route('admin.package'));
        }

        if ($request->isMethod('POST')) {
            $rules =  array(
                'name'         => 'required|max:255',
                'number_month' => 'required|in:1,3,12',
                'price'        => 'required|numeric',
                'description'  => 'required',
                'status'       => 'required|in:0,1',
            );

            // run the validation rules on the inputs from the form
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect()->route('admin.package_edit', ['id' => $id])
                            ->withErrors($validator)
                            ->withInput();
            }
            $packageInfo->name = $request->name;
            $packageInfo->number_month = $request->number_month;
            $packageInfo->price = $request->price;
            $packageInfo->description = $request->description;
            $packageInfo->status = $request->status;
            $packageInfo->save();
            $request->session()->flash('success', trans('common.msg_update_success'));

            return redirect(route('admin.package'));
        }
        $data['packageInfo'] = $packageInfo;

        return view('admin.packages.form', $data);
    }

    public function delete(Request $request, $id)
    {
        Packages::find($id)->delete();
        $request->session()->flash('success', trans('common.msg_delete_success'));

        return redirect(route('admin.package'));
    }
}