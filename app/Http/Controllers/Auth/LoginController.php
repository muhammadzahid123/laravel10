<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\VerifyNotification;
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

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|string',
             'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user->status == 1) {
            // login user here
            if (Auth::guard('web')->attempt(['email', $request->email, 'password', $request->password], $request->remember_token)) {
                return redirect()->intended(route('index'));
            }
        } else {
            if (!is_null($user)) {
                $user->notify(new VerifyNotification($user));
                session()->flash('success', 'confirmation email has been sent to your email please check your email');
                return redirect()->route('/');
            } else {
                session()->flash('errors', 'please login first');
                return redirect()->route('login');
            }
        }
    }
}
