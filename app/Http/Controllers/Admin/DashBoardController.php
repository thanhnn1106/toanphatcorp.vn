<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class DashBoardController extends \App\Http\Controllers\Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        return view('admin.layout');
    }
}