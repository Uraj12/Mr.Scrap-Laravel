@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <!-- Custom CSS for Animations -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        
        .profile-container {
            max-width: 600px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        .profile-icon {
            font-size: 80px;
            color: #007bff;
            margin-bottom: 15px;
        }

        .pickup-card {
            background: #ffcc00;
            padding: 15px;
            border-radius: 10px;
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
            color: #333;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            animation: slideIn 1s ease-in-out;
            border: none;
            cursor: pointer;
        }

        .logout-btn {
            margin-top: 20px;
            animation: bounce 1.5s infinite;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateX(-50px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }
    </style>
</head>
<body>

<div class="profile-container">
    <i class="fas fa-user-circle profile-icon"></i>
    
    <h1>Welcome, {{ $user->name }}</h1>
    <p><i class="fas fa-envelope"></i> Email: {{ $user->email }}</p>
   

    <!-- Button to Open Modal -->
    <button type="button" class="pickup-card" data-bs-toggle="modal" data-bs-target="#pickupModal">
        <i class="fas fa-truck"></i> Scheduled Pickups: {{ is_countable($scheduledPickups) ? count($scheduledPickups) : 0 }}
    </button>

    <!-- Logout Form -->
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger logout-btn">
            <i class="fas fa-sign-out-alt"></i> Logout
        </button>
    </form>
</div>

<!-- Modal Structure -->
<div class="modal fade" id="pickupModal" tabindex="-1" aria-labelledby="pickupModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Make modal wider for better readability -->
        <div class="modal-content shadow-lg">
            <div class="modal-header bg-success text-white"> <!-- Green header -->
                <h5 class="modal-title" id="pickupModalLabel">Your Scheduled Pickups</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3" style="max-height: 500px; overflow-y: auto;">
                @if(!empty($scheduledPickups) && is_countable($scheduledPickups) && count($scheduledPickups) > 0)
                    <div class="list-group">
                        @foreach($scheduledPickups as $pickup)
                            <div class="list-group-item rounded mb-3 shadow-sm border-0">
                                <h6 class="mb-2"><strong>Pickup ID:</strong> {{ $pickup->id }}</h6>
                                <p class="mb-1"><strong>Scrap Type:</strong> {{ $pickup->scrap_type }}</p>
                                <p class="mb-1"><strong>Pickup Date:</strong> {{ \Carbon\Carbon::parse($pickup->pickup_date)->format('d M Y') }}</p>
                                <p class="mb-1"><strong>Pickup Time:</strong> {{ $pickup->pickup_time }}</p>
                                <p class="mb-1"><strong>Address:</strong> {{ $pickup->address }}</p>
                                <p class="mb-1"><strong>Status:</strong> 






                                
                                    @if($pickup->status === 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($pickup->status === 'completed')
                                        <span class="badge bg-success">Completed</span>
                                    @else
                                        <span class="badge bg-secondary">Unknown</span>
                                    @endif
                                </p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-center text-muted">No scheduled pickups found.</p>
                @endif
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button> <!-- Green button -->
            </div>
        </div>
    </div>
</div>




@push('scripts')
<!-- Bootstrap JS (Ensure it's included at the bottom) -->
@endpush

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var myModal = new bootstrap.Modal(document.getElementById("pickupModal"));

        document.querySelector(".pickup-card").addEventListener("click", function() {
            myModal.show();
        });
    });
</script>

</body>
</html>
@endsection
