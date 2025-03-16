@extends('layouts.app')

@section('title', 'Scan Scrap')

@section('content')
<div class="container mt-5">
    <h2 class="text-center">Upload an Image for Scrap Prediction</h2>

    <!-- Display Prediction Result -->
    @if(session('result'))
        <div class="alert alert-info text-center">
            Predicted Category: <strong>{{ session('result') }}</strong>
        </div>
    @endif

    <!-- Image Upload Form -->
    <form action="/upload-image" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="image" class="form-label">Select an Image:</label>
            <input type="file" name="image" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Upload & Predict</button>
    </form>
</div>
@endsection
