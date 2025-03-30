@extends('layouts.app')

@section('title', 'Sell Scrap')

@section('content')

<!-- Inline CSS -->
<style>
    /* General Styling */
    body {
        font-family: 'Roboto', sans-serif;
        background: #f4f4f4;
        color: #333;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 1300px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    /* Title Styling */
    h1 {
        color: #2e7d32;
        text-align: center;
        margin-bottom: 30px;
        font-size: 40px;
        font-weight: bold;
    }

    /* Scrap Grid */
    .scrap-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 30px;
    }

    /* Scrap Card */
    .scrap-card {
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s, box-shadow 0.3s;
        border: 1px solid #ddd;
        text-align: center;
    }

    .scrap-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
    }

    /* Scrap Icon */
    .scrap-icon {
        font-size: 60px;
        margin-bottom: 20px;
        color: #2e7d32;
        transition: color 0.3s;
    }

    .scrap-card:hover .scrap-icon {
        color: #1b5e20;
    }

    /* Card Title */
    .scrap-card h2 {
        font-size: 1.8rem;
        color: #333;
        margin: 10px 0;
    }

    /* Card Description */
    .scrap-card p {
        font-size: 1.1rem;
        color: #666;
        margin: 10px 0;
    }

    /* Sell Button */
    .sell-btn {
        display: inline-block;
        background: #2e7d32;
        color: white;
        padding: 12px 25px;
        border-radius: 8px;
        text-decoration: none;
        margin-top: 15px;
        transition: background 0.3s, transform 0.2s;
        border: none;
        cursor: pointer;
        font-size: 16px;
    }

    .sell-btn:hover {
        background: #1b5e20;
        transform: translateY(-5px);
    }

    /* Footer */
    footer {
        background: #2e7d32;
        color: #fff;
        text-align: center;
        padding: 15px;
        margin-top: 40px;
    }
</style>

<!-- Scrap Selling Container -->
<div class="container">
    <h1>Sell Your Scrap with Ease</h1>

    <!-- Scrap Grid -->
    <div class="scrap-grid">

        @foreach($scrapCategories as $category)
            <div class="scrap-card">

                <!-- Scrap Icon -->
                <div class="scrap-icon">
                    @if($category->category == 'Paper') 📄
                    @elseif($category->category == 'Metal') 🔩
                    @elseif($category->category == 'Plastic') 🛍️
                    @elseif($category->category == 'Glass') 🍾
                    @elseif($category->category == 'E-Waste') 💻
                    @elseif($category->category == 'Rubber') 🛞
                    @endif
                </div>

                <!-- Scrap Title -->
                <h2>{{ $category->category }}</h2>

                <!-- Scrap Description -->
                <p>
                    @php
                        $categoryScrap = $scrapRates->where('category', $category->id);
                        $scrapNames = $categoryScrap->pluck('scrap')->implode(', '); 
                    @endphp
                    {{ $scrapNames ?: 'No scrap items available' }}
                </p>

                <!-- Schedule Pickup Form -->
                <form action="{{ route('sell.scrap') }}" method="get">
                    @csrf
                    <input type="hidden" name="category_id" value="{{ $category->id }}">
                    <input type="hidden" name="category_name" value="{{ $category->category }}">
                    <button type="submit" class="sell-btn">Schedule a Pickup</button>
                </form>
            </div>
        @endforeach

    </div>
</div>

<!-- Footer -->
<footer>
    <p>© 2025 Scrap Uncle. All rights reserved.</p>
</footer>

@endsection
