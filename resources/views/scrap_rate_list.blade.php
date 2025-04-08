@extends('layouts.app')

@section('title', 'Scrap Rate List')

@section('content')

<!-- Scrap Rate List -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <!-- Stylish Search Bar with Space Between Bar and Button -->
            <div class="d-flex align-items-center mb-4">
                <input type="text" id="search-bar" class="form-control form-control-lg shadow-sm me-3" placeholder="🔍 Search for scrap type..." onkeyup="searchScrap()">
                <button class="btn btn-success btn-lg shadow-sm px-4" type="button" onclick="clearSearch()">
                    Clear
                </button>
            </div>

            <!-- Scrap Cards -->
            <div class="row" id="scrapList">
                @foreach($scrapRates as $scrapRate)
                <div class="col-md-6 mb-4 scrap-card">
                    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                        <div class="card-body text-center p-4">
                            <h5 class="card-title text-success">{{ $scrapRate->scrap }}</h5>
                            <p class="card-text">Rate: <span class="badge bg-primary fs-6">₹{{ number_format($scrapRate->priceperkg, 2) }}/kg</span></p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
    
            <!-- Note Section -->
            <div class="text-center mt-5">
                <p class="text-muted">💡 <strong>Note:</strong> For Bulk scrap (Commercial) prices may vary.</p>
                <a href="{{ route('contact.us') }}" class="btn btn-success btn-lg">📞 Contact us to know more</a>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Search -->
<script>
    function searchScrap() {
        let input = document.getElementById("search-bar").value.toLowerCase();
        let cards = document.querySelectorAll(".scrap-card");

        cards.forEach(card => {
            let title = card.querySelector(".card-title").textContent.toLowerCase();
            if (title.includes(input)) {
                card.style.display = "block";
            } else {
                card.style.display = "none";
            }
        });
    }

    function clearSearch() {
        document.getElementById("search-bar").value = "";
        searchScrap();
    }
</script>

@endsection
