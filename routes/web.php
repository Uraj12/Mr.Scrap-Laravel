<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ScrapRateController;
use App\Http\Controllers\SchedulePickupController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController; // Ensure this is imported
use App\Models\User;
use App\Models\Pickup; // Assuming you have a Pickup model
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PickupManController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PickupController;


// ✅ Home Route (Public)
Route::get('/', function () {
    return view('registration');
})->name('home');

// ✅ Welcome Page (Public)
Route::get('/welcome', function () {
    if (!Session::has('user_email')) {
        return redirect('/login'); // Redirect if session is missing
    }
    return view('welcome');
})->name('welcome');

// ✅ User Registration
Route::post('/register-user', [RegistrationController::class, 'register'])->name('register');

// ✅ Login Page (Public)
Route::get('/login', function () {
    return view('login'); // Ensure you have login.blade.php
})->name('login');

// ✅ User Login
Route::post('/login-user', [AuthController::class, 'login'])->name('login.user');

// ✅ Dashboard (Requires Authentication)
Route::get('/dashboard', function () {
    return view('welcome'); // Update this with your actual dashboard view
})->middleware('auth')->name('dashboard');

// ✅ Scrap Routes (Public)
Route::get('/commercial-scrap', [ScrapRateController::class, 'commercialScrap'])->name('commercial.scrap');
Route::get('/residential-scrap', [ScrapRateController::class, 'residentialScrap'])->name('residential.scrap');
Route::get('/scrap-rate-list', [ScrapRateController::class, 'index'])->name('scrap.rate.list');

// ✅ Contact Us (Public)
Route::get('/contact-us', function () {
    return view('emails.contact_mail');
})->name('contact.us');
Route::post('/send-contact', [ContactController::class, 'sendContactEmail'])->name('send.contact');

// ✅ Get Scrap Items by Category (Public)
Route::get('/get-scrap-items/{category}', [ScrapRateController::class, 'getScrapItems']);

// ✅ Sell Scrap (Public)
Route::get('/sell-scrap', [ScrapRateController::class, 'sellScrap'])->name('sell.scrap');

// ✅ Schedule Pickup Routes (Public)
Route::get('/schedule-pickup', [SchedulePickupController::class, 'showForm'])->name('schedule.pickup');
Route::post('/schedule-pickup', [SchedulePickupController::class, 'store'])->name('schedule.pickup.store');

// ✅ Thank You Page (Public)
Route::get('/thankyou', function () {
    return view('thankyou');
})->name('thankyou');

// ✅ About Us (Public)
Route::get('/about', function () {
    return view('aboutus');
})->name('about');

// ✅ Scrap Collection (Public)
Route::get('/scrapcollection', function () {
    return view('scrapcollection');
})->name('scrapcollection');

// ✅ Profile (Requires Authentication)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile');
});

// ✅ Logout Route (POST)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');




Route::get('/admin-dashboard', function () {
    $totalUsers = DB::table('user')->count();
    $scheduledPickups = DB::table('schedule_pickup')->where('status', 'scheduled')->count();
    $completedPickups = DB::table('schedule_pickup')->where('status', 'completed')->count();
    $totalWeight = DB::table('schedule_pickup')->sum('weight') ?? 0;

    // Fetch scrap pickup data grouped by category
    $scrapData = DB::table('schedule_pickup')
        ->select('category', DB::raw('COUNT(*) as total'))
        ->groupBy('category')
        ->get();

    $scrapLabels = $scrapData->pluck('category')->toArray();
    $scrapValues = $scrapData->pluck('total')->toArray();

    return view('admin.dashboard', compact(
        'totalUsers',
        'scheduledPickups',
        'completedPickups',
        'totalWeight',
        'scrapLabels',
        'scrapValues'
    ));
})->name('admin.dashboard');

Route::get('/scrap-data', function () {
    $scrapData = DB::table('schedule_pickup')
        ->select('category', DB::raw('COUNT(*) as total'))
        ->groupBy('category')
        ->get();

    return response()->json($scrapData);
})->name('scrap.data');

Route::get('/pickupman-dashboard', function () {
    $totalPickups = DB::table('schedule_pickup')->count(); // Total pickups
    $pendingPickups = DB::table('schedule_pickup')->where('status', 'pending')->count(); // Pending pickups
    $totalWeight = DB::table('schedule_pickup')->sum('total_weight');
$totalPayments = DB::table('schedule_pickup')->sum('amount_paid');


    return view('admin.pickupManDashboard', compact('totalPickups', 'pendingPickups', 'totalWeight', 'totalPayments'));
})->name('pickupMan.dashboard');



Route::get('/pickupman-dashboard', [PickupManController::class, 'pickupManDashboard'])->name('pickupMan.dashboard');


Route::put('/pickup/update/{id}', [PickupManController::class, 'update'])->name('updatePickup');



Route::get('/users', function () {
    $users = User::all();  // Fetches all users
    return view('userlist', compact('users'));
    
});

Route::patch('/users/{id}/activate', [UserController::class, 'activate'])->name('user.activate');
Route::patch('/users/{id}/deactivate', [UserController::class, 'deactivate'])->name('user.deactivate');

Route::get('/admin/pickups', function () {
    return view('admin.pickup'); // ✅ Load the Blade view correctly
});


Route::get('/admin/pickups/today', [PickupController::class, 'getTodayPickups']);
Route::post('/admin/pickup/complete/{id}', [PickupController::class, 'completePickup']);

Route::get('/admin/pickups/today', function () {
    $pickups = Pickup::whereDate('date', today())->get();
    return response()->json([
        'sql' => Pickup::whereDate('date', today())->toSql(),
        'bindings' => Pickup::whereDate('date', today())->getBindings(),
        'data' => $pickups
    ]);
});


Route::get('/scrap-data', function () {
    // Fetch scrap pickup data grouped by category
    $scrapData = DB::table('schedule_pickup')
        ->select('category', DB::raw('COUNT(*) as total'))
        ->groupBy('category')
        ->get();

    return response()->json($scrapData);
})->name('scrap.data');
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile');
});

Route::middleware(['api'])->group(function () {
    Route::get('/test', function () {
        return response()->json(['message' => 'CORS enabled!'])
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
    });
});

Route::get('/admin/pickups', [PickupController::class, 'showPickups'])->name('admin.pickups');
