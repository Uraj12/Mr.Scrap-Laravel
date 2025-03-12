<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell Your Scrap - ScrapUncle</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            overflow-x: hidden;
        }
        .navbar {
            background: rgba(255, 255, 255, 0.9) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .step-section {
            text-align: center;
            padding: 80px 20px;
        }
        .step-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s;
        }
        .step-card:hover {
            transform: scale(1.05);
        }
        .step-icon {
            font-size: 50px;
            color: #28a745;
            margin-bottom: 15px;
        }
        .video-container {
            position: relative;
            text-align: center;
        }
        .video-container video {
            width: 100%;
            border-radius: 10px;
        }
        .sell-btn {
            background-color: #28a745;
            color: white;
            padding: 15px 30px;
            font-size: 1.2rem;
            border-radius: 50px;
            text-transform: uppercase;
            font-weight: bold;
        }
        .sell-btn:hover {
            background-color: #1e7e34;
        }
    </style>
</head>
<body>
@extends('layouts.app')
    
    <div class="container mt-5 pt-5 text-center">
        <h1 class="mb-4">Sell Your Scrap in 3 Easy Steps</h1>
        <div class="row">
            <div class="col-md-4 step-section">
                <div class="step-card">
                    <i class="fas fa-calendar-check step-icon"></i>
                    <h3>Step 1: Schedule a Pickup</h3>
                    <p>Book an appointment online or via our app for a doorstep pickup.</p>
                </div>
            </div>
            <div class="col-md-4 step-section">
                <div class="step-card">
                    <i class="fas fa-weight-hanging step-icon"></i>
                    <h3>Step 2: Weigh & Evaluate</h3>
                    <p>Our agent will weigh the scrap and offer the best market price.</p>
                </div>
            </div>
            <div class="col-md-4 step-section">
                <div class="step-card">
                    <i class="fas fa-hand-holding-usd step-icon"></i>
                    <h3>Step 3: Instant Payment</h3>
                    <p>Receive instant payment through your preferred payment method.</p>
                </div>
            </div>
        </div>
        <a  href="{{ route('residential.scrap') }}" class="btn sell-btn mt-4">Sell Scrap Now</a>
    </div>
    
    <div class="container mt-5">
        <div class="video-container">
            <video autoplay loop muted>
                <source src="scrap_process.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>
    
</body>
</html>
