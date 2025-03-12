<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\Pickup; // ✅ Ensure this model exists and is correctly imported

class ProfileController extends Controller
{
    public function showProfile()
{
    $user = auth()->user();
    
    if (!$user) {
        abort(403, 'Unauthorized'); // Prevents access if user is not authenticated
    }

    $scheduledPickups = Pickup::where('email', $user->email)->get();

    return view('profile', compact('user', 'scheduledPickups'));
}

}

