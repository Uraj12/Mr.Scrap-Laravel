<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class RegistrationController extends Controller
{
    // Send OTP with email existence check
    public function sendOtp(Request $request)
    {
        // Check if the email already exists
        if (User::where('email', $request->email)->exists()) {
            return response()->json(['error' => 'Email already registered!']);
        }

        $otp = rand(100000, 999999);
        
        // Store all user data in session temporarily
        Session::put('otp', $otp);
        Session::put('otp_expiry', Carbon::now()->addMinutes(5)); // OTP expiry
        Session::put('user_data', [
            'name' => $request->name,
            'email' => $request->email,
            'phno' => $request->phno,
            'password' => Hash::make($request->password)
        ]);

        // Send OTP email
        Mail::raw("Your OTP is: $otp", function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Your OTP for Registration');
        });

        return response()->json(['success' => 'OTP sent to your email.']);
    }

    // Verify OTP and register user
    public function verifyOtp(Request $request)
    {
        $storedOtp = Session::get('otp');
        $otpExpiry = Session::get('otp_expiry');
        $userData = Session::get('user_data');

        if (!$storedOtp || Carbon::now()->greaterThan($otpExpiry)) {
            return response()->json(['error' => 'OTP expired!']);
        }

        if ($request->otp == $storedOtp) {
            
            // Store all user fields in database
            User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'phno' => $userData['phno'],
                'password' => $userData['password']
            ]);

            // Clear session after successful registration
            Session::forget(['otp', 'otp_expiry', 'user_data']);

            return response()->json(['success' => 'Registration successful!']);
        }

        return response()->json(['error' => 'Invalid OTP!']);
    }
}
