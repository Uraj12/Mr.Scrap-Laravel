<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function sendContactEmail(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'message' => 'required|string',
            ]);

            // Send email
            Mail::raw("Name: {$request->name}\nEmail: {$request->email}\nMessage: {$request->message}", function ($mail) use ($request) {
                $mail->to('sahuu5249@gmail.com') // Change this to your email
                    ->subject('New Contact Message from ' . $request->name);
            });

            return response()->json(['success' => 'Message sent successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong!', 'message' => $e->getMessage()], 500);
        }
    }
}
