<?php


namespace App\Http\Controllers\Auth;

use App;
use App\Http\Controllers\Controller;
use Auth;
use Exception;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Socialite;
use App\Models\User;


class AuthController extends Controller
{
    /**
     * @var App|Application
     */
    protected $app;

    protected $redirectAfterLogout = '/';
    protected $redirectPath = '/';

    protected $mailer;

    /**
     * AuthController constructor.
     * @param Application $app
     * @param Mailer $mailer
     */
    public function __construct(Application $app, Mailer $mailer)
    {
        $this->app    = $app;
        $this->mailer = $mailer;

        $this->middleware('guest', ['except' => ['getLogout', 'activatedPage', 'reSendVerifyEmail']]);
    }


    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @param Request $request
     * @return Response
     */
    public function redirectToProvider(Request $request, $service)
    {
        $redirect = $request->input('redirect');
        $request->session()->flash('redirect', $redirect);

        $facebookProvider = Socialite::driver($service);
        if ($request->session()->pull($service.'_login_error') == 'email') {
            $facebookProvider->with(['auth_type' => 'rerequest']);
        }

        return $facebookProvider->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @param Request $request
     * @return Response
     * @throws \MongoDuplicateKeyException
     */
    public function handleProviderCallback(Request $request, $service)
    {
        $redirect = $request->session()->pull('redirect', null);
        if ( ! $redirect) {
            $redirect = route('front.home');
        }

        try {
            $socialInfo = Socialite::driver($service)->user();
        } catch (Exception $e) {
            \Log::error($e->getMessage());
            return redirect($redirect);
        }

        $email = strtolower($socialInfo->getEmail());

        $user = User::where('email', $email)->first();
        if ($user) {
            if ($user->provider_user_id == null) {
                $user->provider_user_id = $socialInfo->getId();
                $user->provider = $service;
                $user->full_name = $socialInfo->getName();
                $user->avatar  = $socialInfo->getAvatar();
                $user->save();
            }
        } else {
            if ($email != null) {
                $user = User::create([
                    'provider_user_id' => $socialInfo->getId(),
                    'provider'       => $service,
                    'email'        => $email,
                    'status'       => config('site.user_status.value.active'),
                    'password'     => bcrypt(str_random(6)),
                    'avatar'       => $socialInfo->getAvatar(),
                ]);

                $user->save();
            } else {
                $request->session()->flash('login_error', trans('login_popup.error_login'));
                $request->session()->put($service.'_login_error', 'email');

                return redirect($redirect);
            }
        }
        Auth::login($user);

        return redirect($redirect);
    }

    /**
     * @return string
     */
    public function redirectPath()
    {
        return redirect()->route('front.home');
    }
}
