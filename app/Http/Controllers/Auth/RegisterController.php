<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\District;
use App\Models\Division;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use App\Notifications\VerifyNotification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    public function showRegistrationForm()
    {
        $division = Division::orderBy('priority', 'DESC')->get();
        $district = District::orderBy('name', 'DESC')->get();
        return view('auth.register', compact('division', 'district'));
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'division_id' => ['required', 'numeric'],
            'district_id' => ['required', 'numeric'],
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone_no' => ['required', 'string', 'max:15'],
            'street_address' => ['required', 'string', 'max:255'],

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function register(Request $request)
    {

        $user = User::create([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => Str::slug($request['first_name'].$request['last_name']),
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_no' => $request->phone_no,
            'street_address' => $request->street_address,
            'ip_address' => request()->ip(),
            'remember_token' => Str::random(50),
            'status' => 0,

        ]);

        $user->notify(new VerifyNotification($user));
        session()->flash('success', 'confirmation email has been sent to your email please check your email');
        return back();
    }
}
