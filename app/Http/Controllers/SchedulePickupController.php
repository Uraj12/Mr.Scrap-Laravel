<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchedulePickup;
use Illuminate\Support\Facades\Auth; // Import Auth facade

class SchedulePickupController extends Controller
{
    // Show the schedule pickup form
    public function showForm(Request $request)
    {
        $categoryId = $request->query('category_id');  
        $categoryName = $request->query('category_name');

        return view('sellscrap', compact('categoryId', 'categoryName'));
    }

    // Handle storing the pickup schedule in the database
    public function store(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'category' => 'required|string|max:45',
            'date' => 'required|string|max:45',
            'time' => 'required|string|max:45',
            'address' => 'required|string|max:255',
            'weight' => 'required|string|max:45',
            'remark' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
            'latitude' => 'required|numeric', // Validate latitude
            'longitude' => 'required|numeric', // Validate longitude
        ]);
    
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('scrap_images', $imageName, 'public'); // Save in storage/app/public/scrap_images
        } else {
            $imagePath = null;
        }
    
        // Get logged-in user's email (Adjust as needed)
        $email = Auth::check() ? Auth::user()->email : session('email');
    
        // Store the data in the schedule_pickup table
        $pickup = new SchedulePickup();
        $pickup->category = $validated['category'];
        $pickup->date = $validated['date'];
        $pickup->time = $validated['time'];
        $pickup->address = $validated['address'];
        $pickup->weight = $validated['weight'];
        $pickup->remark = $validated['remark'] ?? '';
        $pickup->image = $imagePath; // Store image path
        $pickup->email = $email; // Store user email
        $pickup->latitude = $validated['latitude']; // Store latitude
        $pickup->longitude = $validated['longitude']; // Store longitude
    
        // Save to database
        $pickup->save();
    
        // Redirect back with a success message
        return redirect()->route('schedule.pickup')->with('success', 'Pickup scheduled successfully!');
    }
}

