<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Carbon\Carbon;

class PasswordResetCodeController extends Controller
{
    // Show email input form
    public function requestCode()
    {
        return view('auth.forgot-password-code');
    }

    // Send verification code to email
    public function sendCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'Email not found']);
        }

        $code = rand(100000, 999999); // 6-digit code

        // Store code in DB
        DB::table('password_reset_codes')->updateOrInsert(
            ['email' => $request->email],
            ['code' => $code, 'created_at' => now()]
        );

        // Send email
        Mail::raw("Your password reset code is: $code", function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Password Reset Code');
        });

        // Redirect to reset form with email in query
        return redirect()->route('password.verify-code-form', ['email' => $request->email])
            ->with('success', 'Verification code sent to your email');
    }

    // Show verification code + new password form
    public function showVerifyCodeForm(Request $request)
    {
        $email = $request->query('email'); // Get email from URL
        if (!$email) {
            return redirect()->route('password.request-code')
                ->withErrors(['email' => 'Email is required']);
        }

        return view('auth.reset-password-code', ['email' => $email]);
    }

    // Verify code and reset password
    public function resetWithCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        // Find the code record (valid for 10 minutes)
        $record = DB::table('password_reset_codes')
            ->where('email', $request->email)
            ->where('code', $request->code)
            ->where('created_at', '>=', Carbon::now()->subMinutes(10))
            ->first();

        if (!$record) {
            return back()->withErrors(['code' => 'Invalid or expired code']);
        }

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'User not found']);
        }

        // Update password (User model will auto-hash)
        $user->password = $request->password;
        $user->save();

        // Remove the used code
        DB::table('password_reset_codes')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('success', 'Password reset successfully!');
    }
}
