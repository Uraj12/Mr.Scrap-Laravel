<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - MrScrap</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f4f4;
            color: #333;
            overflow-x: hidden;
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
            animation: fadeIn 2s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .content {
            text-align: center;
            padding: 60px 10%;
        }
        .section {
            margin: 50px 0;
            opacity: 0;
            transform: translateY(30px);
            animation: slideUp 1.5s ease-in-out forwards;
        }
        @keyframes slideUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .team {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 30px;
            margin-top: 40px;
        }
        .team-member {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.4s ease-in-out, box-shadow 0.4s ease-in-out;
        }
        .team-member:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }
        .team-member img {
            width: 160px;
            height: 160px;
            border-radius: 50%;
            object-fit: cover;
            transition: transform 0.3s ease-in-out;
        }
        .team-member:hover img {
            transform: rotate(5deg);
        }
    </style>
</head>
<body>
@extends('layouts.app')
    <div class="hero">
        <h1>Empowering Sustainability with MrScrap</h1>
    </div>

    <div class="content">
        <div class="section">
            <h2>Our Story</h2>
            <p>MrScrap was born out of a vision to revolutionize the scrap collection industry. We eliminate middlemen, ensuring fair payments to hardworking individuals while promoting sustainability.</p>
        </div>
        
        <div class="section">
            <h2>Our Scope</h2>
            <p>We aim to create a seamless platform where individuals and businesses can sell recyclable materials, contributing to a greener future and fostering a circular economy.</p>
        </div>

        <div class="section">
            <h2>Achievements</h2>
            <p>✔ Processed 10,000+ scrap transactions<br>✔ Partnered with 50+ recycling units<br>✔ Built a community of 500+ eco-conscious individuals</p>
        </div>

        <div class="section">
            <h2>Meet Our Team</h2>
            <div class="team">
                <div class="team-member">
                    <img src="images/team1.jpg" alt="Shubham">
                    <h3>Shubham</h3>
                    <p>Founder & CEO</p>
                </div>
                <div class="team-member">
                    <img src="images/team2.jpg" alt="Aryan">
                    <h3>Aryan</h3>
                    <p>Chief Technology Officer</p>
                </div>
                <div class="team-member">
                    <img src="images/team3.jpg" alt="Neha">
                    <h3>Neha</h3>
                    <p>Marketing Head</p>
                </div>
                <div class="team-member">
                    <img src="images/team4.jpg" alt="Rohan">
                    <h3>Rohan</h3>
                    <p>Operations Manager</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
