<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $user;
    public $isLogged;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user      = Auth::user();
            $this->isLogged  = ! empty ($this->user) ? true : false;

            view()->share('isLogged', $this->isLogged);
            view()->share('user', $this->user);

            return $next($request);
        });

    }
}
