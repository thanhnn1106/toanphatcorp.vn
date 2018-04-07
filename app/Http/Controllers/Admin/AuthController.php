<?php


namespace App\Http\Controllers\Admin;

use App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    use AuthenticatesUsers;

    /**
     * @var App|Application
     */
    protected $app;
    protected $mailer;

    // Overwrite
    protected $redirectAfterLogout = '/cpanel/login';
    protected $redirectPath        = '/cpanel';

    /**
     * AuthController constructor.
     * @param Application $app
     * @param Mailer $mailer
     */
    public function __construct(Application $app, Mailer $mailer)
    {
        $this->app    = $app;
        $this->mailer = $mailer;

        $this->middleware('guest:admin', [
            'except' => [
                'logout',
            ],
        ]);
    }

    /**
     * Overwrite
     * 
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.admin.login');
    }

    /**
     * Log the user out of the application.
     * Overwrite
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect()->route('admin.login');
    }

    /**
     * @return string
     */
    public function redirectPath()
    {
        return route('admin.dashboard');
    }

    /**
     * Get the guard to be used during authentication.
     * Overwrite
     * 
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }

    /**
     * Get the needed authorization credentials from the request.
     * Overwrite
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        $credentials           = $request->only($this->username(), 'password', 'status');
        $credentials['status'] = config('site.user_status.value.active');

        return $credentials;
    }

    /**
     * Get the login username to be used by the controller.
     * Overwrite
     *
     * @return string
     */
    public function username()
    {
        return 'user_name';
    }
}
