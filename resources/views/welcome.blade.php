<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <title>ScrapUncle - Recycling Made Easy</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        /* Smooth animations */
        * {
            transition: all 0.3s ease-in-out;
        }

        /* Navbar fixed on top */
        .navbar {
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Navbar hover effect */
        .navbar-nav .nav-link {
            font-weight: 500;
            transition: color 0.3s ease-in-out;
        }

        .navbar-nav .nav-link:hover {
            color: #28a745 !important;
        }

        /* Dropdown menu animation */
        .dropdown-menu {
            display: none;
            opacity: 0;
            transform: translateY(10px);
            transition: opacity 0.3s, transform 0.3s;
        }

        .nav-item.dropdown:hover .dropdown-menu {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }

        /* Video background */
        .video-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            overflow: hidden;
            z-index: -1;
        }

        .video-container video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Overlay to improve text readability */
        .video-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: rgba(0, 0, 0, 0.5);
            z-index: -1;
        }

        /* Content Section */
        .content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
            animation: fadeInUp 1s ease-in-out;
        }

        /* Keyframe Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translate(-50%, -60%);
            }
            to {
                opacity: 1;
                transform: translate(-50%, -50%);
            }
        }

        /* Large heading */
        .big-heading {
            font-size: 4rem;
            font-weight: bold;
            text-transform: uppercase;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.6);
        }

        /* Button Container */
        .btn-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        /* Button styles */
        .btn-custom {
            padding: 15px 40px;
            font-size: 1.5rem;
            font-weight: bold;
            text-transform: uppercase;
            text-decoration: none;
            border-radius: 50px;
            transition: all 0.3s ease;
            border: 3px solid transparent;
        }

        /* Residential button */
        .residential {
            background-color: #28a745;
            color: white;
            border-color: #28a745;
        }

        .residential:hover {
            background-color: #1e7e34;
            transform: scale(1.1);
        }

        /* Commercial button */
        .commercial {
            background-color: transparent;
            color: white;
            border: 3px solid white;
        }

        .commercial:hover {
            background-color: rgba(255, 255, 255, 0.2);
            transform: scale(1.1);
        }
        .user-icon {
    width: 40px;
    height: 40px;
    background-color: #28a745;
    color: white;
    font-weight: bold;
    font-size: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    margin-left: 15px;
    cursor: pointer;
}

    </style>
</head>
<body>

    <!-- Video Background -->
    <div class="video-container">
        <video autoplay loop muted playsinline>
            <source src="{{ asset('assets/scrap.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

    <!-- Dark Overlay -->
    <div class="video-overlay"></div>
    @extends('layouts.app')

    <!-- Content Section -->
    <div class="content">
        <h1 class="big-heading">Got Scrap?</h1>
        <p class="sub-text">Sell it to us</p>
        <p>Sell us your recyclable waste and contribute to the circular economy.</p>

        <!-- Buttons -->
        <div class="btn-container">
            <a href="{{ route('residential.scrap') }}" class="btn-custom residential">Residential</a>
            <a href="{{ route('commercial.scrap', ['category' => 'commercial']) }}" class="btn-custom commercial">Commercial</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
