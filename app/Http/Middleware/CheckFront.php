<?php 
namespace App\Http\Middleware;

use Closure, Auth;
use Illuminate\Auth\AuthManager;

class CheckFront
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
        return $next($request);
    }

}