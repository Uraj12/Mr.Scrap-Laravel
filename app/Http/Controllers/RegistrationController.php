<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{
    // ✅ Send OTP with phone duplication validation
    public function sendOtp(Request $request)
{
    // ✅ Check if the phone number already exists in the user table
    $exists = \DB::table('user')->where('phno', $request->phno)->exists();

    if ($exists) {
        return response()->json(['error' => 'Phone number already registered!'], 409);
    }

    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:user,email',
        'phno' => 'required|digits:10',
        'password' => 'required|min:8|same:confirm_password',
        'confirm_password' => 'required|min:8'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->errors()
        ], 422);
    }

    $otp = rand(100000, 999999);

    // Store user data in session temporarily
    Session::put('otp', $otp);
    Session::put('otp_expiry', Carbon::now()->addMinutes(5)); 
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


    // ✅ Verify OTP and Register User
    public function verifyOtp(Request $request)
    {
        $storedOtp = Session::get('otp');
        $otpExpiry = Session::get('otp_expiry');
        $userData = Session::get('user_data');
    
        if (!$storedOtp || Carbon::now()->greaterThan($otpExpiry)) {
            return response()->json(['error' => 'OTP expired!']);
        }
    
        if ($request->otp == $storedOtp) {
            
            // Store all user fields in the database
            User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'phno' => $userData['phno'],
                'password' => $userData['password']
            ]);
    
            // ✅ Clear session to prevent going back
            Session::flush();
    
            return response()->json(['success' => 'Registration successful!']);
        }
    
        return response()->json(['error' => 'Invalid OTP!']);
    }
    
}
