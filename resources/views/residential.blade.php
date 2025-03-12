<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell Scrap</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            color: #2e7d32;
            margin-bottom: 20px;
        }
        .scrap-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }
        .scrap-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid #ddd;
        }
        .scrap-card:hover {
            transform: scale(1.03);
            box-shadow: 0 6px 15px rgba(0,0,0,0.15);
        }
        .scrap-icon {
            font-size: 50px;
            margin-bottom: 10px;
        }
        .scrap-card h2 {
            font-size: 1.5rem;
            margin: 10px 0;
            color: #2e7d32;
        }
        .scrap-card p {
            font-size: 1rem;
            color: #666;
        }
        .sell-btn {
            display: inline-block;
            background: #2e7d32;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 10px;
            transition: background 0.3s ease;
            border: none;
            cursor: pointer;
        }
        .sell-btn:hover {
            background: #1b5e20;
        }
    </style>
</head>
<body>
@extends('layouts.app')
    <div class="container">
        <h1>Sell Your Scrap</h1>
        <div class="scrap-grid">
            
        @foreach($scrapCategories as $category)
            <div class="scrap-card">
                <div class="scrap-icon">
                    @if($category->category == 'Paper') 📄
                    @elseif($category->category == 'Metal') 🔩
                    @elseif($category->category == 'Plastic') 🛍️
                    @elseif($category->category == 'Glass') 🍾
                    @elseif($category->category == 'E-Waste') 💻
                    @elseif($category->category == 'Rubber') 🛞
                    @endif
                </div>
                <h2>{{ $category->category }}</h2>
                <p>
                    @php
                        // Fetch scrap items under this category
                        $categoryScrap = $scrapRates->where('category', $category->id);
                        $scrapNames = $categoryScrap->pluck('scrap')->implode(', '); 
                    @endphp
                    {{ $scrapNames ?: 'No scrap items available' }}
                </p>

                <form action="{{ route('sell.scrap') }}" method="get">
                    @csrf
                    <input type="hidden" name="category_id" value="{{ $category->id }}">
                    <input type="hidden" name="category_name" value="{{ $category->category }}">
                    <button type="submit" class="sell-btn">Schedule a pickup</button>
                </form>
            </div>
        @endforeach

        </div>
    </div>
</body>
</html>
