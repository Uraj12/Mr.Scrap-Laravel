<?php

namespace App\Http\Controllers\Auth;  // ✅ Ensure this is correct

use App\Http\Controllers\Controller;
use App\Mail\VerifyEmail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;  // ✅ Add this import

class RegisterController extends Controller
{
    /**
     * Show registration form.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Send the verification email with a token.
     */
   

public function sendVerificationEmail(Request $request)
{
    try {       
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email',
            'phno' => 'required|string|max:15',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $token = Str::random(64);

        // ✅ Store data in session temporarily
        Session::put('register_data', [
            'name' => $request->name,
            'email' => $request->email,
            'phno' => $request->phno,
            'password' => bcrypt($request->password),
            'verification_token' => $token,
        ]);
      
        // ✅ Send email
        Mail::to($request->email)->send(new VerifyEmail($token));

        // ✅ Check for failures
        if (Mail::failures()) {
            return response()->json(['error' => 'Failed to send email.'], 500);
        }

        return response()->json(['message' => 'Verification email sent. Check your inbox.']);

    } catch (\Exception $e) {
        Log::error('Error in sending email: ' . $e->getMessage());
        return response()->json(['error' => 'Failed to send email. ' . $e->getMessage()], 500);
    }
}



    /**
     * Handle email verification link click.
     */
    public function verifyEmail($token)
    {
        // ✅ Check if the token matches the session token
        $sessionData = Session::get('register_data');

        if (!$sessionData || $sessionData['verification_token'] !== $token) {
            return redirect('/register')->with('error', 'Invalid or expired verification link.');
        }

        // ✅ Register the user
        $user = User::create([
            'name' => $sessionData['name'],
            'phno' => $sessionData['phno'],
            'email' => $sessionData['email'],
            'password' => $sessionData['password'],
            'is_active' => true,
            'verification_token' => null,   // Clear the token after verification
            'email_verified_at' => now(),
        ]);

        // ✅ Clear session after successful registration
        Session::forget('register_data');

        return redirect('/login')->with('success', 'Registration successful! You can now log in.');
    }

    
}
