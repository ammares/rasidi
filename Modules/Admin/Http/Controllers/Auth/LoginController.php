<?php

namespace Modules\Admin\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\LoginLog;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Login
    public function showLoginForm()
    {
        $pageConfigs = [
            'bodyClass' => "bg-full-screen-image",
            'blankPage' => true,
        ];

        return view('admin::/pages/auth/login', [
            'pageConfigs' => $pageConfigs,
        ]);
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $remember_me = $request->get('remember-me');

        $user = User::where('email', $email)->first();
        if (!$user) {
            LoginLog::record($request, LoginLog::FAILED, 'Email Not Found');
            return back()->withErrors([
                'email' => __('global.the_provided_credentials_do_not_match_our_records'),
            ]);
        }
        
        if (!$user->active) {
            LoginLog::record($request, LoginLog::BANNED, 'Banned User');
            return back()->withErrors([
                'email' => __('global.the_provided_credentials_do_not_match_our_records'),
            ]);
        }

        if (Auth::attempt(['email' => $email, 'password' => $password, 'active' => 1], $remember_me)) {
            $request->session()->regenerate();
            LoginLog::record($request, LoginLog::SUCCESS, 'Login');

            return redirect()->intended('dashboard');
        }
        
        LoginLog::record($request, LoginLog::FAILED, 'Invalid Password');
        return back()->withErrors([
            'email' => __('global.the_provided_credentials_do_not_match_our_records'),
        ]);
    }
}
