<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Pickup;
use App\Mail\PickupUpdatedMail;


class PickupManController extends Controller
{
    // Function to display the Pickup Man Dashboard
    public function pickupManDashboard() {
        // Fetch all pickups
        $pickups = DB::table('schedule_pickup')->get();
    
        // Ensure default values to prevent NaN
        $totalPickups = DB::table('schedule_pickup')->count() ?? 0;
        $pendingPickups = DB::table('schedule_pickup')->where('status', 'pending')->count() ?? 0;
        $totalWeight = DB::table('schedule_pickup')->sum('weight') ?? 0;
        $totalPayments = DB::table('schedule_pickup')->sum('amount_paid') ?? 0;
    
        // Pass data to the view
        return view('admin.pickupManDashboard', compact('pickups', 'totalPickups', 'pendingPickups', 'totalWeight', 'totalPayments'));
    }

   

   
    
   
    public function update(Request $request, $id)
{
    $pickup = Pickup::findOrFail($id);

    // Update weight and payment first
    $pickup->total_weight = (float) $request->input('total_weight', 0);
    $pickup->amount_paid = $request->input('amount_paid');

    // Change status if amount is paid
    if ($pickup->amount_paid > 0) {
        $pickup->status = 'completed';
    }

    $pickup->save(); // Save changes before sending email

    // Send email only if email exists
    if (!empty($pickup->email)) {
        Mail::to($pickup->email)->send(new PickupUpdatedMail($pickup));
    }

    return redirect()->back()->with('success', 'Pickup updated and email sent successfully!');
}
    
    

    
}
