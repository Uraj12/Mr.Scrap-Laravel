<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display the user list.
     */
    public function index()
    {
        $users = User::all(); // Fetch all users
        return view('users.index', compact('users'));
    }

    /**
     * Activate a user.
     */
    public function activate($id)
    {
        $user = User::findOrFail($id);
        $user->is_active = true; // Set user as active
        $user->save();

        return redirect()->back()->with('success', 'User activated successfully!');
    }

    /**
     * Deactivate a user.
     */
    public function deactivate($id)
    {
        $user = User::findOrFail($id);
        $user->is_active = false; // Set user as inactive
        $user->save();

        return redirect()->back()->with('success', 'User deactivated successfully!');
    }
}
