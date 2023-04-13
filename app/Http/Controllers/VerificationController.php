<?php

namespace App\Http\Controllers;

use App\Models\User;

class VerificationController extends Controller
{
    public function verify($token)
    {
        $user = User::where('remember_token', $token)->first();
        if (!is_null($user)) {
            $user->status = 1;
            $user->remember_token = NULL;
            $user->save();
            session()->flash('success', 'you are registered successfully !! Login now');
            return redirect('login');
        }

        else
        {
            session()->flash('errors', 'oops!! something went wrong with your token');
            return redirect('/');

        }

    }
}
