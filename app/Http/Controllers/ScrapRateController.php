<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScrapRate;
use App\Models\ScrapCategory;

class ScrapRateController extends Controller
{
    public function residentialScrap(Request $request)
    {
        $categoryName = $request->query('category');

        // Fetch categories
        $scrapCategories = ScrapCategory::all();

        // Fetch scrap rates filtered by category
        $scrapRates = ScrapRate::with('category')
            ->when($categoryName, function ($query) use ($categoryName) {
                return $query->whereHas('category', function ($q) use ($categoryName) {
                    $q->where('category', $categoryName);
                });
            })
            ->get();

        return view('residential', compact('scrapCategories', 'scrapRates'));
    }
    public function index()
{
    $scrapRates = ScrapRate::all(); // Fetch all scrap rates from the database
    return view('scrap_rate_list    ', compact('scrapRates')); // Pass to the view
}

 public function sellScrap()
    {
        return view('sellscrap'); // Make sure 'sellscrap' matches your Blade file
    }

    public function commercialScrap()
    {
        return view('commercial'); // Ensure the view file exists
    }

}
