<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class DashBoardController extends Controller
{
    /**
     * Redirect path
     */
    protected $redirectPath = 'admin/dashboard';

    public function index(Request $request)
    {
        return view('admin.layout');
    }
}