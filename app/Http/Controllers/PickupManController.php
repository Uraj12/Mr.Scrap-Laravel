<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pickup;
use App\Mail\PickupUpdatedMail;

class PickupManController extends Controller
{
    // Function to display the Pickup Man Dashboard
    public function pickupManDashboard() {
        // Fetch only pending pickups
        $pickups = DB::table('schedule_pickup')->where('status', 'pending')->get();
    
        // Ensure default values
        $totalPickups = DB::table('schedule_pickup')->count() ?? 0; 
        $pendingPickups = DB::table('schedule_pickup')->where('status', 'pending')->count() ?? 0;
    
        // Fetch total weight of only completed pickups
        $totalWeight = DB::table('schedule_pickup')
            ->where('status', 'completed')
            ->sum(DB::raw('COALESCE(total_weight, 0)')) ?? 0;
    
        // ✅ Sum the `amount_paid` column (handling NULL values)
        $totalPayments = DB::table('schedule_pickup')
            ->sum(DB::raw('COALESCE(amount_paid, 0)')) ?? 0;
    
        // Pass data to the view
        return view('admin.pickupManDashboard', compact('pickups', 'totalPickups', 'pendingPickups', 'totalWeight', 'totalPayments'));
    }
    
    // Function to update pickup details
    public function update(Request $request, $id)
    {
        $pickup = Pickup::findOrFail($id);

        // Update weight and payment first
        $pickup->total_weight = (float) $request->input('total_weight', 0);
        $pickup->amount_paid = (float) $request->input('amount_paid');

        // Change status to completed if payment is made
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

    // Function to display the Pickup Man Report page
    public function pickupManReport() {
        $pickups = DB::table('schedule_pickup')->get();
        $totalPickups = DB::table('schedule_pickup')->count() ?? 0;
        $pendingPickups = DB::table('schedule_pickup')->where('status', 'pending')->count() ?? 0;
        $totalWeight = DB::table('schedule_pickup')
            ->where('status', 'completed')
            ->sum(DB::raw('COALESCE(total_weight, 0)')) ?? 0;
        $totalPayments = DB::table('schedule_pickup')
            ->sum(DB::raw('COALESCE(amount_paid, 0)')) ?? 0;
        return view('admin.pickupManReport', compact('pickups', 'totalPickups', 'pendingPickups', 'totalWeight', 'totalPayments'));
    }
}
