<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Completed Pickups | Mr. Scrap</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- jQuery & CounterUp -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="https://bfintal.github.io/Counter-Up/jquery.counterup.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body { display: flex; background: #f8f9fa; font-family: 'Arial', sans-serif; }
        .sidebar { width: 250px; height: 100vh; background: linear-gradient(135deg, #007bff, #0056b3); color: white; padding: 20px; position: fixed; box-shadow: 4px 0 10px rgba(0, 0, 0, 0.2); }
        .sidebar h3 { text-align: center; font-weight: bold; margin-bottom: 30px; }
        .sidebar a { color: white; text-decoration: none; display: block; padding: 12px; border-radius: 5px; transition: all 0.3s ease-in-out; }
        .sidebar a:hover, .sidebar a.active { background: rgba(255, 255, 255, 0.2); transform: translateX(10px); }
        .content { margin-left: 270px; padding: 20px; width: 100%; }
        .card { border-radius: 15px; padding: 20px; text-align: center; transition: 0.3s; box-shadow: 2px 2px 15px rgba(0, 0, 0, 0.1); }
        .card:hover { transform: scale(1.05); }
        .table-container { background: white; padding: 15px; border-radius: 10px; box-shadow: 2px 2px 15px rgba(0, 0, 0, 0.1); }
        .img-thumbnail { width: 60px; height: 60px; object-fit: cover; }
        .form-control-sm { max-width: 80px; display: inline-block; }
        .btn-save { padding: 5px 12px; min-width: 70px; }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h3>Pickup Man Dashboard</h3>
        <a href="{{ route('pickupman.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a>
        <a href="{{ route('pickupman.completed') }}" class="active"><i class="fas fa-check-circle"></i> Completed Pickups</a>
        <a href="#"><i class="fas fa-map-marker-alt"></i> Pickup Locations</a>
        <a href="#"><i class="fas fa-weight"></i> Scrap Collected</a>
        <a href="#"><i class="fas fa-money-bill"></i> Payments</a>
        <a href="#"><i class="fas fa-history"></i> History</a>
        <a href="/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <!-- Content -->
    <div class="content">
        <h2>Completed Pickups</h2>
        
        <!-- Quick Stats Cards -->
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">Total Completed</h5>
                        <p class="card-text display-6">{{ $completedPickups->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5 class="card-title">Total Weight</h5>
                        <p class="card-text display-6">{{ number_format($totalWeight ?? 0, 2) }} kg</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">Total Payments</h5>
                        <p class="card-text display-6">₹{{ number_format($totalPayments ?? 0, 2) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-dark">
                    <div class="card-body">
                        <h5 class="card-title">Average Rating</h5>
                        <p class="card-text display-6">{{ number_format($averageRating ?? 0, 1) }} <i class="fas fa-star"></i></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Completed Pickups Table -->
        <div class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Completed Pickups List</h4>
                <div class="input-group" style="width: 300px;">
                    <input type="text" class="form-control" id="searchInput" placeholder="Search pickups...">
                    <button class="btn btn-outline-secondary" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Address</th>
                            <th>Weight (kg)</th>
                            <th>Payment (₹)</th>
                            <th>Image</th>
                            <th>Customer</th>
                            <th>Rating</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($completedPickups as $index => $pickup)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $pickup->category }}</td>
                            <td>{{ $pickup->date }}</td>
                            <td>{{ $pickup->time }}</td>
                            <td>
                                {{ $pickup->address }}
                                <button class="btn btn-sm btn-info view-map" 
                                    data-lat="{{ $pickup->latitude }}" 
                                    data-lng="{{ $pickup->longitude }}">
                                    <i class="fas fa-map-marker-alt"></i> View Map
                                </button>
                            </td>
                            <td>{{ number_format($pickup->total_weight, 2) }}</td>
                            <td>₹{{ number_format($pickup->amount_paid, 2) }}</td>
                            <td>
                                <img src="{{ asset($pickup->image) }}" 
                                     alt="Scrap Image" 
                                     class="img-thumbnail magnify-image" 
                                     data-bs-toggle="modal" 
                                     data-bs-target="#imageModal">
                            </td>
                            <td>{{ $pickup->email }}</td>
                            <td>
                                @if($pickup->rating)
                                    <span class="badge bg-success">
                                        {{ $pickup->rating }} <i class="fas fa-star"></i>
                                    </span>
                                @else
                                    <span class="badge bg-secondary">Not Rated</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-sm btn-primary view-details" 
                                        data-pickup="{{ json_encode($pickup) }}">
                                    <i class="fas fa-eye"></i> Details
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="11" class="text-center">No completed pickups found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Map Modal -->
    <div class="modal fade" id="mapModal" tabindex="-1" aria-labelledby="mapModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mapModalLabel">Location Map</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <iframe id="mapFrame" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Scrap Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" class="img-fluid" alt="Scrap Image">
                </div>
            </div>
        </div>
    </div>

    <!-- Details Modal -->
    <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel">Pickup Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Category:</strong> <span id="detailCategory"></span></p>
                            <p><strong>Date:</strong> <span id="detailDate"></span></p>
                            <p><strong>Time:</strong> <span id="detailTime"></span></p>
                            <p><strong>Weight:</strong> <span id="detailWeight"></span> kg</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Payment:</strong> ₹<span id="detailPayment"></span></p>
                            <p><strong>Customer:</strong> <span id="detailCustomer"></span></p>
                            <p><strong>Rating:</strong> <span id="detailRating"></span></p>
                            <p><strong>Remark:</strong> <span id="detailRemark"></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Handle map view
            $('.view-map').click(function() {
                const lat = $(this).data('lat');
                const lng = $(this).data('lng');
                const mapUrl = `https://www.google.com/maps/embed/v1/view?key=YOUR_API_KEY&center=${lat},${lng}&zoom=14`;
                $('#mapFrame').attr('src', mapUrl);
                $('#mapModal').modal('show');
            });

            // Handle image view
            $('.magnify-image').click(function() {
                const imgSrc = $(this).attr('src');
                $('#modalImage').attr('src', imgSrc);
            });

            // Handle details view
            $('.view-details').click(function() {
                const pickup = JSON.parse($(this).data('pickup'));
                $('#detailCategory').text(pickup.category);
                $('#detailDate').text(pickup.date);
                $('#detailTime').text(pickup.time);
                $('#detailWeight').text(pickup.total_weight);
                $('#detailPayment').text(pickup.amount_paid);
                $('#detailCustomer').text(pickup.email);
                $('#detailRating').text(pickup.rating ? pickup.rating + ' ★' : 'Not Rated');
                $('#detailRemark').text(pickup.remark || 'No remarks');
                $('#detailsModal').modal('show');
            });

            // Search functionality
            $('#searchInput').on('keyup', function() {
                const value = $(this).val().toLowerCase();
                $('tbody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</body>
</html> 