<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class PasswordResetLinkController extends Controller
{
    /**
     * Show the Forgot Password form.
     */
    public function create()
    {
        return view('auth.forgot-password');
    }

    /**
     * Send the password reset link to the user's email.
     */
    public function store(Request $request)
    {
        // Validate email
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // Attempt to send reset link
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // If sent successfully
        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }
}
