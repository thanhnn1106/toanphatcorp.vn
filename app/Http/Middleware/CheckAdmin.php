<?php 
namespace App\Http\Middleware;

use Closure, Auth;
use Illuminate\Auth\AuthManager;

class CheckAdmin
{
    /**
     * The Guard implementation.
     *
     * @var AuthManager
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param AuthManager $auth
     */
    public function __construct(AuthManager $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->guard('admin')->guest()) {
            return redirect()->guest(route('admin.login'));
        }

        $admin = $this->auth->guard('admin')->user();
        \View::share('admin', $admin);

        return $next($request);
    }

}