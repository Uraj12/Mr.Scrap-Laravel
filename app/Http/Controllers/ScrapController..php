<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ScrapController extends Controller
{
    public function predictScrap(Request $request)
    {
        $client = new Client();
        $url = 'http://127.0.0.1:8000/api/predict/'; // Django API URL

        try {
            $response = $client->post($url, [
                'json' => [
                    'image' => $request->file('image') // Send image file
                ]
            ]);

            $body = json_decode($response->getBody(), true);
            return response()->json($body); // Return Django's response to Laravel frontend

        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to connect to Scrap API'], 500);
        }
    }
}
