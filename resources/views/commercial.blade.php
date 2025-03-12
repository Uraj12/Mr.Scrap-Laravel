<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Commercial Scrap Pickup</title>
   
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;  /* Centers horizontally */
            align-items: center;      /* Centers vertically */
            min-height: 100vh;        /* Makes it take full screen height */
            margin: 0;                /* Removes default margin */
        }
        .container {
            max-width: 600px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            text-align: center;
        }
        h1 {
            color: #28a745;
        }
        p {
            font-size: 18px;
            color: #555;
        }
        .contact-btn {
            display: inline-block;
            background: #28a745;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            margin-top: 20px;
            transition: background 0.3s;
        }
        .contact-btn:hover {
            background: #1e7e34;
        }
    </style>
</head>

<body>
@extends('layouts.app')
    <div class="container">
        <h1>Commercial Scrap Pickup</h1>
        <p>For commercial scrap pickup, please contact us to schedule a pickup.</p>
        <a href="{{ route('contact.us') }}" class="contact-btn">Contact Us</a>
    </div>
</body>
</html>
