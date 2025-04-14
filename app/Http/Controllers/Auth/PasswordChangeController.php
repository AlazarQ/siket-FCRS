<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;

class PasswordChangeController extends Controller
{
    /**
     * Display the password change view.
     */
    public function create()
    {
        return view('auth.password.change');
    }

    /**
     * Handle the password change request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'password' => 'required|string|confirmed|min:8',
        ]);

        // update the password and set the userStatus to 'ACTIVE'
        User::where('id', Auth::id())->update([
            'password' => Hash::make($request->password),
            'userStatus' => 'ACTIVE'
        ]);
        

        //         $user = Auth::User();
        //         if (!$user) {
        //             return redirect()->route('login')->withErrors(['error' => 'User not authenticated']);
        //         }
        // // set the userStatus to 'ACTIVE' and update the password
        //         User::where('id', Auth::id())->update([
        //             'password' => Hash::make($request->password),
        //             'userStatus' => 'ACTIVE'
        //         ]);


        // $status = Password::reset(
        //     $request->only('password', 'password_confirmation'),
        //     function ($user) use ($request) {
        //         $user->forceFill([
        //             'password' => Hash::make($request->password),
        //             'remember_token' => Str::random(60),
        //         ])->save();

        //         event(new PasswordReset($user));
        //     }
        // );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        // return $status == Password::PASSWORD_RESET
        //     ? redirect()->route('login')->with('status', __($status))
        //     : back()->withInput($request->only('email'))
        //     ->withErrors(['email' => __($status)]);


        return redirect()->route('dashboard')->with('success', 'Password changed successfully!');
    }
}
