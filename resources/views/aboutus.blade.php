<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - MrScrap</title>
    
    <!-- Bootstrap and Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Global Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f4f4;
            color: #333;
        }

        .hero {
            background: url('images/about-bg.jpg') no-repeat center center/cover;
            height: 70vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.6);
        }

        .section {
            padding: 60px 15px;
            text-align: center;
        }

        .team-member img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            transition: 0.3s;
        }

        .team-member:hover img {
            transform: scale(1.1);
        }

        .role-icon {
            font-size: 40px;
            color: #28a745;
            margin-bottom: 15px;
        }

        .footer {
            background: #343a40;
            color: #ffffff;
            text-align: center;
            padding: 20px;
        }

        .footer a {
            color: #17a2b8;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
        .green-text {
        color: #28a745; /* Bootstrap green color */
    }
    </style>
</head>
<body>

@extends('layouts.app')

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
    <div class="container">
        <a class="navbar-brand" href="http://127.0.0.1:8000">
            <img src="http://127.0.0.1:8000/images/logo.png" alt="Mr. Scrap" style="height: 50px;">
            MrScrap
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="http://127.0.0.1:8000/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://127.0.0.1:8000/scrapcollection">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://127.0.0.1:8000/about">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://127.0.0.1:8000/contact-us">Contact</a>
                </li>
            </ul>

            <div class="d-flex">
                @if(Auth::check())
                    <a href="http://127.0.0.1:8000/profile" class="btn btn-success me-2">Profile</a>
                @else
                    <a href="http://127.0.0.1:8000/login" class="btn btn-primary">Login</a>
                @endif
            </div>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<div class="hero">
    <div class="container">
        <h1 class="display-4 fw-bold">Empowering Sustainability with MrScrap</h1>
        <p class="lead">Join us in revolutionizing the scrap collection industry.</p>
    </div>
</div>

<!-- Content Section -->
<div class="container mt-5">

    <!-- Our Story -->
    <div class="row section">
        <div class="col-lg-6 mb-4">
            <h2>Our Story</h2>
            <p>MrScrap was born out of a vision to revolutionize the scrap collection industry. We eliminate middlemen, ensuring fair payments to hardworking individuals while promoting sustainability.</p>
        </div>
        <div class="col-lg-6">
        <img src="{{ asset('scrap_images/story.png') }}" class="img-fluid rounded shadow-sm" alt="Our Story">
        </div>
    </div>

    <!-- Our Scope -->
    <div class="row section bg-light">
    <div class="col-lg-6 d-flex justify-content-center align-items-center">
    <img src="{{ asset('scrap_images/scope.png') }}" 
         class="img-fluid rounded shadow-sm" 
         alt="Our Scope" 
         style="max-width: 100%; height: auto; max-height: 400px; object-fit: cover;">
</div>

        <div class="col-lg-6">
            <h2>Our Scope</h2>
            <p>We aim to create a seamless platform where individuals and businesses can sell recyclable materials, contributing to a greener future and fostering a circular economy.</p>
        </div>
    </div>

    <!-- Achievements -->
    <div class="row section">
        <div class="col-12 text-center">
            <h2>Our Achievements</h2>
            <p class="lead">✔ Processed 10,000+ scrap transactions<br>✔ Partnered with 50+ recycling units<br>✔ Built a community of 500+ eco-conscious individuals</p>
        </div>
    </div>

    <!-- Team Section -->
    <div class="row section bg-light">
        <div class="col-12 text-center mb-5">
            <h2>Meet Our Team</h2>
        </div>

        <div class="col-lg-3 col-md-6 mb-4 text-center">
            <div class="team-member">
                <i class="fas fa-user-tie role-icon"></i>
                <h4>Mr. Uraj Sahu</h4>
                <p>Founder & CEO</p>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4 text-center">
            <div class="team-member">
                <i class="fas fa-cogs role-icon"></i>
                <h4>Ms. Nakrani Shruti</h4>
                <p>Chief Technology Officer</p>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4 text-center">
            <div class="team-member">
                <i class="fas fa-bullhorn role-icon"></i>
                <h4>Ms. Aashetta Gajera</h4>
                <p>Marketing Head</p>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4 text-center">
            <div class="team-member">
                <i class="fas fa-chart-line role-icon"></i>
                <h4>Ms. Krishna Dhudhat</h4>
                <p>Operations Manager</p>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<div class="footer">
    <p>© 2025 MrScrap. All Rights Reserved. | <a href="http://127.0.0.1:8000/privacy">Privacy Policy</a></p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
