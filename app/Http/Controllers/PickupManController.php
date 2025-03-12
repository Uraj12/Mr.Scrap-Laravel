<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Pickup;

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

    // Function to update pickup details
    public function update(Request $request, $id)
    {
        // Validate input data
        $request->validate([
            'total_weight' => 'required|numeric|min:0',
            'amount_paid' => 'required|numeric|min:0',
        ]);

        // Find the pickup entry
        $pickup = Pickup::findOrFail($id);

        // Log the incoming request data for debugging
        Log::info('Updating Pickup ID: ' . $id, $request->all());

        // Update weight and payment
        $pickup->total_weight = (float) $request->input('total_weight', 0);
        $pickup->amount_paid = $request->input('amount_paid');

        // Change status to 'completed' if amount is entered
        if ($pickup->amount_paid > 0) {
            $pickup->status = 'completed';
        }

        $pickup->save();

        return redirect()->back()->with('success', 'Pickup updated successfully!');
    }
}
