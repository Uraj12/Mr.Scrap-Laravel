<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Scrap Rate List</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .container {
      width: 90%;
      max-width: 1000px;
      margin-top: 20px;
      text-align: center;
    }
    .search-bar {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 5px;
      margin-bottom: 20px;
    }
    .card-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
    }
    .card {
      background: white;
      width: 45%;
      margin-bottom: 20px;
      padding: 15px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      text-align: left;
    }
    .card img {
      width: 100%;
      height: 150px;
      object-fit: cover;
      border-radius: 10px;
    }
    .card h2 {
      color: #28a745;
      margin: 10px 0;
    }
    .card p {
      color: #555;
    }
    .card .price {
      font-weight: bold;
      font-size: 18px;
      color: #333;
    }
  </style>
</head>
<body>

  <div class="container">
    
    <input type="text" class="search-bar" placeholder="Search for scrap type..." onkeyup="searchScrap()">
    <div class="card-container" id="scrapList">
    @foreach($scrapRates as $scrapRate)
<div class="card">
  <img src="{{ asset('images/'.$scrapRate->scrap.'.jpg') }}" alt="{{ $scrapRate->scrap }}">
  <h2>{{ $scrapRate->scrap }}</h2>
 
  <p class="price">Rate: ₹{{ number_format($scrapRate->priceperkg, 2) }}/kg</p>
</div>
@endforeach





    </div>
  </div>
  <div class="text-center mt-lg-5 my-8 my-lg-0 mb-lg-8">
    <span class="body-md">Note: For Bulk scrap (Commercial) prices may vary.</span>
    <a href="{{ route('contact.us') }}" class="title-md fg-success-2"> Contact us to know more <i class="icon-arrow-right"></i></a>
  </div>

  <script>
    function searchScrap() {
      let input = document.querySelector(".search-bar").value.toLowerCase();
      let cards = document.querySelectorAll(".card");
      cards.forEach(card => {
        let title = card.querySelector("h2").textContent.toLowerCase();
        if (title.includes(input)) {
          card.style.display = "block";
        } else {
          card.style.display = "none";
        }
      });
    }
  </script>
</body>
</html>
