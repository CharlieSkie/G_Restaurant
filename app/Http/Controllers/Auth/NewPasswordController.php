<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;

class NewPasswordController extends Controller
{
    /**
     * Show the Reset Password form.
     */
    public function create($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    /**
     * Handle the new password submission.
     */
    public function store(Request $request)
    {
        // Validate fields
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        // Try to reset password
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                // Set new password
                $user->forceFill([
                    'password' => Hash::make($request->password),
                ])->save();
            }
        );

        // Return response
        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }
}
