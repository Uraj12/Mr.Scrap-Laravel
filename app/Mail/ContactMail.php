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
            Mail::send([], [], function ($mail) use ($request) {
                $mail->to('your-email@example.com') // Change this to your email
                    ->subject('New Contact Message from ' . $request->name)
                    ->setBody("<p><strong>Name:</strong> {$request->name}</p>
                               <p><strong>Email:</strong> {$request->email}</p>
                               <p><strong>Message:</strong> {$request->message}</p>", 'text/html');
            });

            return response()->json(['success' => 'Message sent successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong! ' . $e->getMessage()], 500);
        }
    }
}
