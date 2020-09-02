<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use MichaelDzjap\TwoFactorAuth\Contracts\TwoFactorProvider;
use App\Jobs\SendSMSToken;
use App\User;
use Illuminate\Http\Request;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    protected function authenticated(Request $request, $user)
    {
        if (resolve(TwoFactorProvider::class)->enabled($user)) {
            return self::startTwoFactorAuthProcess($request, $user);
        }

        return redirect()->intended($this->redirectPath());
    }
    private function startTwoFactorAuthProcess(Request $request, $user)
    {
        // Logout user, but remember user id
        auth()->logout();
        $request->session()->put(
            'two-factor:auth', array_merge(['id' => $user->id], $request->only('email', 'remember'))
        );

        self::registerUserAndSendToken($user);

        return redirect()->route('auth.token');
    }
    private function registerUserAndSendToken(User $user)
    {
        // Custom, provider dependend logic for sending an authentication token
        // to the user. In the case of MessageBird Verify this could simply be
        // resolve(TwoFactorProvider::class)->sendSMSToken($this->user)
        // Here we assume this function is called from a queue'd job
        dispatch(new SendSMSToken($user));
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

}
