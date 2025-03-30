@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <!-- Back Button -->
    <div class="back_icon_" onclick="window.history.back();" style="cursor: pointer;">
        <ion-icon name="arrow-back-outline" style="font-size: 24px; color: black;"></ion-icon>
    </div>

    <h2 class="text-center text-success">Schedule a Pickup</h2>

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

    <form action="{{ route('schedule.pickup.store') }}" method="POST" enctype="multipart/form-data" 
          style="background: #ffffff; padding: 30px; border-radius: 10px; box-shadow: 0 0 15px rgba(0, 128, 0, 0.2);">
        @csrf

        <!-- Scrap Category -->
        <div class="form-group d-flex align-items-center mb-3">
            <i class="fas fa-recycle me-2 text-success"></i>
            <input type="text" value="{{ request()->query('category_name', 'Not Selected') }}" readonly 
                   class="form-control border-success field-hover">
            <input type="hidden" name="category" value="{{ request()->query('category_name', '') }}">
        </div>

        <!-- Date & Time Selection -->
        <div class="row mt-3">
            <div class="col-md-6 form-group">
                <label class="text-success"><i class="fas fa-calendar-alt me-2"></i> Date</label>
                <input type="date" name="date" class="form-control border-success field-hover" required>
            </div>
            <div class="col-md-6 form-group">
                <label class="text-success"><i class="fas fa-clock me-2"></i> Time</label>
                <select name="time" class="form-control border-success field-hover" required>
                    <option value="9-11 AM">9-11 AM</option>
                    <option value="11-1 PM">11-1 PM</option>
                    <option value="2-4 PM">2-4 PM</option>
                    <option value="4-6 PM">4-6 PM</option>
                </select>
            </div>
        </div>

        <!-- Address Field -->
        <div class="form-group mt-3">
            <label class="text-success"><i class="fas fa-map-marker-alt me-2"></i> Pickup Address</label>
            <textarea name="address" rows="3" placeholder="Enter your pickup address" required 
                      class="form-control border-success field-hover"></textarea>
        </div>

        <!-- Estimated Weight -->
        <div class="form-group mt-3">
            <label class="text-success"><i class="fas fa-weight me-2"></i> Estimated Weight (kg)</label>
            <input type="number" name="weight" placeholder="Estimated Weight (kg)" required 
                   class="form-control border-success field-hover">
        </div>

        <!-- Remarks -->
        <div class="form-group mt-3">
            <label class="text-success"><i class="fas fa-comment me-2"></i> Remarks (Optional)</label>
            <textarea name="remark" rows="2" placeholder="Any remarks (Optional)" 
                      class="form-control border-success field-hover"></textarea>
        </div>

        <!-- Scrap Image Upload -->
        <div class="form-group mt-3">
            <label class="text-success"><i class="fas fa-image me-2"></i> Upload Scrap Image</label>
            <input type="file" name="image" accept="image/*" required 
                   class="form-control border-success field-hover">
        </div>

        <!-- Schedule Pickup Button -->
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-success mt-4 d-flex align-items-center" 
                    style="gap: 10px; padding: 12px 30px; border-radius: 8px; transition: 0.3s;">
                <i class="fas fa-truck"></i> 
                <span>Schedule a Pickup</span>
            </button>
        </div>
    </form>
</div>

<style>
    /* Hover Effect for Form Fields */
    .field-hover {
        transition: 0.3s;
    }
    .field-hover:hover, .field-hover:focus {
        background: #e9ffe9;  /* Light green hover */
        border-color: #28a745;
        box-shadow: 0 0 10px rgba(0, 128, 0, 0.3);
    }

    /* Hover Effect for Button */
    button:hover {
        background: #218838;  
        box-shadow: 0 0 15px rgba(0, 128, 0, 0.5);
    }
</style>

@endsection
