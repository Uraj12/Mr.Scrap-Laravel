@extends('layouts.app')

@section('title', 'Commercial Scrap Pickup')

@section('content')

<div class="container mt-5 pt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <div class="card-body text-center">
                    <h1 class="card-title text-success">Commercial Scrap Pickup</h1>
                    <p class="card-text">
                        We provide pickup services for commercial scrap. Schedule a pickup now and let us help you recycle responsibly.
                    </p>
                    <a href="{{ route('contact.us') }}" class="btn btn-success mt-3 px-4 py-2">Contact Us</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
