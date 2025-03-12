<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Pickup - Scrap Uncle</title>

    <!-- FontAwesome Icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    
    <!-- Ionicons -->
    <script type="module" src="https://code.ionicframework.com/ionicons/5.5.2/ionicons.esm.js"></script>
    <script nomodule src="https://code.ionicframework.com/ionicons/5.5.2/ionicons.js"></script>
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            flex-direction: column;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 500px;
            position: relative;
        }
        .back_icon_ {
            position: absolute;
            top: 15px;
            left: 15px;
            cursor: pointer;
        }
        .back_icon_ ion-icon {
            font-size: 24px;
            color: black;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .form-group {
            display: flex;
            align-items: center;
            margin-top: 10px;
            width: 100%;
        }
        .form-group i {
            margin-right: 10px;
            color: #28a745;
            font-size: 18px;
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }
        input, textarea, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            flex: 1;
        }
        .date-time-container {
            display: flex;
            gap: 10px;
        }
        .date-time-container .form-group {
            flex: 1;
        }
        button {
            width: 100%;
            padding: 12px;
            margin-top: 15px;
            background-color: #28a745;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
        }
        button:hover {
            background-color: #218838;
        }
        /* Responsive Design */
        @media (max-width: 480px) {
            .date-time-container {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
@extends('layouts.app')

    <div class="container">
        <!-- Back Button -->
        <div class="back_icon_" onclick="window.history.back();">
            <ion-icon name="arrow-back-outline"></ion-icon>
        </div>

        <h2>Schedule a Pickup</h2>
        
        <!-- SweetAlert Success Message -->
        @if (session('success'))
            <script>
                Swal.fire({
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            </script>
        @endif

        <form action="{{ route('schedule.pickup.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Scrap Category -->
            <div class="form-group">
                <i class="fas fa-recycle"></i>
                <input type="text" value="{{ request()->query('category_name', 'Not Selected') }}" readonly>
                <input type="hidden" name="category" value="{{ request()->query('category_name', '') }}">
            </div>

            <!-- Date & Time Selection -->
            <div class="date-time-container">
                <div class="form-group">
                    <i class="fas fa-calendar-alt"></i>
                    <input type="date" name="date" required>
                </div>
                <div class="form-group">
                    <i class="fas fa-clock"></i>
                    <select name="time" required>
                        <option value="9-11 AM">9-11 AM</option>
                        <option value="11-1 PM">11-1 PM</option>
                        <option value="2-4 PM">2-4 PM</option>
                        <option value="4-6 PM">4-6 PM</option>
                    </select>
                </div>
            </div>

            <!-- Address Field -->
            <div class="form-group">
                <i class="fas fa-map-marker-alt"></i>
                <textarea name="address" rows="3" placeholder="Enter your pickup address" required></textarea>
            </div>

            <!-- Estimated Weight -->
            <div class="form-group">
                <i class="fas fa-weight"></i>
                <input type="number" name="weight" placeholder="Estimated Weight (kg)" required>
            </div>

            <!-- Remarks -->
            <div class="form-group">
                <i class="fas fa-comment"></i>
                <textarea name="remark" rows="2" placeholder="Any remarks (Optional)"></textarea>
            </div>

            <!-- Scrap Image Upload -->
            <div class="form-group">
                <i class="fas fa-image"></i>
                <input type="file" name="image" accept="image/*">
            </div>

            <!-- Schedule Pickup Button -->
            <button type="submit">
                <i class="fas fa-truck"></i> Schedule a Pickup
            </button>
        </form>
    </div>

</body>
</html>
