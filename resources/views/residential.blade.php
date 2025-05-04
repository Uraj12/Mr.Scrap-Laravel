@extends('layouts.app')

@section('title', 'Sell Scrap')

@section('content')
<div class="container py-5">
    <h1 class="text-success text-center mb-5 fw-bold display-5">Sell Your Scrap with Ease</h1>
    <div class="row g-4 justify-content-center">
        @foreach($scrapCategories as $category)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <div class="display-3 mb-3">
                            @if($category->category == 'Paper') 📄
                            @elseif($category->category == 'Metal') 🔩
                            @elseif($category->category == 'Plastic') 🛍️
                            @elseif($category->category == 'Glass') 🍾
                            @elseif($category->category == 'E-Waste') 💻
                            @elseif($category->category == 'Rubber') 🛞
                            @endif
                        </div>
                        <h2 class="h5 fw-bold mb-2">{{ $category->category }}</h2>
                        <p class="text-muted small mb-3">
                            @php
                                $categoryScrap = $scrapRates->where('category', $category->id);
                                $scrapNames = $categoryScrap->pluck('scrap')->implode(', '); 
                            @endphp
                            {{ $scrapNames ?: 'No scrap items available' }}
                        </p>
                        <form action="{{ route('sell.scrap') }}" method="get">
                            @csrf
                            <input type="hidden" name="category_id" value="{{ $category->id }}">
                            <input type="hidden" name="category_name" value="{{ $category->category }}">
                            <button type="submit" class="btn btn-success w-100 rounded-pill fw-bold">Schedule a Pickup</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<footer class="bg-success text-white text-center py-3 mt-5">
    <div class="container">
        <small>© 2025 Scrap Uncle. All rights reserved.</small>
    </div>
</footer>
@endsection
