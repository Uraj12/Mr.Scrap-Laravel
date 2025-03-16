<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pickup;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB; // ✅ Correct placement

class PickupController extends Controller
{
    // Fetch today's pickups
    public function getTodayPickups()
    {
        $today = Carbon::today()->format('Y-m-d'); // Ensures correct date format

        // Use RAW SQL for varchar date comparison
        $pickups = DB::table('schedule_pickup')
            ->whereRaw("STR_TO_DATE(date, '%Y-%m-%d') = ?", [$today])
            ->get();

        if ($pickups->isEmpty()) {
            return response()->json(['message' => 'No pickups scheduled today.'], 404);
        }

        return response()->json($pickups ?? []);
    }

    // Mark a pickup as completed
    public function completePickup($id)
    {
        $pickup = Pickup::find($id);
        if ($pickup) {
            $pickup->status = 'Completed';
            $pickup->save();
            return response()->json(['message' => 'Pickup marked as completed.']);
        }
        return response()->json(['message' => 'Pickup not found.'], 404);
    }

    public function showPickups()
    {
        $pickups = Pickup::paginate(10); // ✅ Fetch only 10 records per page
        return view('admin.pickup', compact('pickups'));
    }
    
}
