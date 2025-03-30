<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Mr. Scrap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="https://bfintal.github.io/Counter-Up/jquery.counterup.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* General Styling */
        body {
            display: flex;
            background: #f4f4f4;
            font-family: 'Arial', sans-serif;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            height: 100vh;
            background: linear-gradient(135deg, #28a745, #1d7c32);
            color: white;
            padding: 20px;
            position: fixed;
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease-in-out;
        }

        .sidebar:hover {
            width: 270px;
        }

        .sidebar h3 {
            font-size: 24px;
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 12px;
            border-radius: 5px;
            font-size: 16px;
            transition: all 0.3s ease-in-out;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateX(10px);
        }

        /* Content */
        .content {
            margin-left: 270px;
            padding: 20px;
            width: 100%;
            transition: all 0.3s ease-in-out;
        }

        /* Dashboard Cards */
        .card {
            border: none;
            border-radius: 15px;
            padding: 20px;
            transition: all 0.3s ease-in-out;
            box-shadow: 2px 2px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card h5 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .card p {
            font-size: 30px;
            font-weight: bold;
        }

        /* Card Colors */
        .bg-primary { background: #007bff !important; }
        .bg-warning { background: #ffc107 !important; color: black !important; }
        .bg-success { background: #28a745 !important; }
        .bg-info { background: #17a2b8 !important; }

        /* Chart Container */
        .chart-container {
    width: 80%; /* Set width */
    max-width: 800px; /* Restrict maximum width */
    height: 400px; /* Set fixed height */
    margin: auto; /* Center align */
}
.nav-link {
        display: block;
        padding: 12px;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-size: 16px;
        transition: all 0.3s ease-in-out;
    }

    .nav-link:hover, .nav-link.active {
        background: rgba(255, 255, 255, 0.2);
        transform: translateX(10px);
    }

    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
    <h3>Mr. Scrap Admin</h3>
   <a href="#" class="nav-link active" >Dashboard</a>
<a href="javascript:void(0);" class="nav-link" data-target="users">Users</a>
<a href="javascript:void(0);" class="nav-link" data-target="pickups">Pickups</a>
<a href="javascript:void(0);" class="nav-link" data-target="scrap_dealers">Scrap Dealers</a>
<a href="javascript:void(0);" class="nav-link" data-target="reports">Reports</a>
<a href="javascript:void(0);" class="nav-link" data-target="settings">Settings</a>

</div>



    <!-- Content -->
    <div class="content" id="mainContent">
    <h2>Dashboard</h2>


        <div class="row g-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <h5>Total Users</h5>
                    <p class="counter">{{ $totalUsers }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-dark">
                    <h5>pending Pickups </h5>
                    <p class="counter">{{ $pendingPickups }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <h5>Completed Pickups</h5>
                    <p class="counter">{{ $completedPickups }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <h5>Total Weight Picked Up</h5>
                    <p><span class="counter">{{ $totalWeight }}</span> kg</p>
                </div>
            </div>
        </div>

        <!-- Scrap Pickup Chart -->
<!-- Scrap Pickup Chart -->
<div class="chart-container">
    <h4>Scrap Category Pickup Status</h4>
    <canvas id="scrapPickupChart"></canvas>
</div>

<script>
    $(document).ready(function () {
        $.ajax({
            url: "{{ route('scrap.data') }}",  // Use Laravel's named route
            type: "GET",
            success: function (data) {
                let labels = [];
                let values = [];

                data.forEach(function (item) {
                    labels.push(item.category);
                    values.push(item.total);
                });

                renderChart(labels, values);
            },
            error: function (xhr, status, error) {
                console.error("Error fetching scrap data:", status, error);
            }
        });
    });

    function renderChart(labels, values) {
        var ctx = document.getElementById("scrapPickupChart").getContext("2d");

        // Creating a gradient for a 3D effect
        var gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, "rgba(54, 162, 235, 1)");  // Dark Blue
        gradient.addColorStop(1, "rgba(75, 192, 192, 0.6)"); // Light Blue

        new Chart(ctx, {
            type: "bar",
            data: {
                labels: labels,
                datasets: [{
                    label: "Scrap Collection by Category",
                    data: values,
                    backgroundColor: [
                        "rgba(255, 99, 132, 0.8)",  // Red
                        "rgba(54, 162, 235, 0.8)",  // Blue
                        "rgba(255, 206, 86, 0.8)",  // Yellow
                        "rgba(75, 192, 192, 0.8)",  // Green
                        "rgba(153, 102, 255, 0.8)", // Purple
                        "rgba(255, 159, 64, 0.8)"   // Orange
                    ],
                    borderColor: "rgba(0, 0, 0, 0.2)",
                    borderWidth: 3,  // Thicker border for a 3D effect
                    hoverBackgroundColor: "rgba(0, 0, 0, 0.3)",
                    borderSkipped: false, // Makes bars look more solid
                    barThickness: 50,
                    borderRadius: 10, // Rounded edges for a smooth 3D feel
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            color: "#333",
                            font: {
                                size: 14,
                                weight: "bold"
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: "#333",
                            font: {
                                size: 14
                            }
                        },
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        ticks: {
                            color: "#333",
                            font: {
                                size: 14
                            }
                        },
                        grid: {
                            color: "rgba(0, 0, 0, 0.1)"
                        }
                    }
                },
                animation: {
                    duration: 2500,
                    easing: "easeOutBounce"
                }
            }
        });
    }

   
    document.addEventListener("DOMContentLoaded", function () {
    const navLinks = document.querySelectorAll(".nav-link");
    const contentSection = document.getElementById("mainContent");

    if (!contentSection) {
        console.error("Error: Element with ID 'mainContent' not found.");
        return;
    }

    navLinks.forEach(link => {
        link.addEventListener("click", function (event) {
            event.preventDefault(); // Prevent page reload

            // Remove active class from all links
            navLinks.forEach(l => l.classList.remove("active"));

            // Add active class to clicked link
            this.classList.add("active");

            // Get the target section from data attribute
            const target = this.getAttribute("data-target");

            // Fetch corresponding page content
            let url = "";
            switch (target) {
                case "dashboard":
                    url = "/dashboard"; // Laravel route for dashboard
                    break;
                case "users":
                    url = "/users";
                    break;
                case "pickups":
                    url = "admin/pickups";
                    break;
                case "scrap_dealers":
                    url = "/scrap-dealers";
                    break;
                case "reports":
                    url = "/reports";
                    break;
                case "settings":
                    url = "/settings";
                    break;
                default:
                    contentSection.innerHTML = `<h2>Not Found</h2><p>The requested section is not available.</p>`;
                    return;
            }

            // Fetch page content dynamically
            fetch(url)
                .then(response => response.text())
                .then(html => {
                    contentSection.innerHTML = html;
                })
                .catch(error => console.error('Error loading page:', error));
        });
    });
});




</script>

<canvas id="scrapChart"></canvas>


</body>
</html>
