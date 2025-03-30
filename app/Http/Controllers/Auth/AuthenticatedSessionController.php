<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;

class AuthenticatedSessionController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            // ✅ Check if the user is verified
            if (!$user->hasVerifiedEmail()) {
                // Send verification email
                $user->sendEmailVerificationNotification();

                Auth::logout();  // Log out unverified user

                return back()->with('warning', 'Please verify your email. A verification link has been sent.');
            }

            return redirect()->intended(RouteServiceProvider::HOME);
        }

        return back()->withErrors([
            'email' => 'Invalid credentials. Please try again.',
        ]);
    }
}
