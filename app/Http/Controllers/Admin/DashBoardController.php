<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class DashBoardController extends Controller
{

    /**
     * Redirect path
     */
    protected $redirectPath = 'admin/dashboard';

    /**
     * @var Account
     */
    protected $admin;


    /**
     * @var HasherContract
     */
    protected $hasher;

    /**
     * @var Request
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->admin   = $request->user('admin');
        $this->hasher  = $hasher;
        $this->request = $request;
    }

    public function getIndex()
    {
        if (Gate::forUser($this->admin)->check('view', User::class)) {
            return redirect()->route('admin.clients');
        } else {
            return redirect()->route('admin.articles.list');
        }

    }
} 