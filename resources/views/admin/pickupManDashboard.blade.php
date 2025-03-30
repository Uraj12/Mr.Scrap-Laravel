<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pickup Man Dashboard | Mr. Scrap</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- jQuery & CounterUp -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="https://bfintal.github.io/Counter-Up/jquery.counterup.min.js"></script>

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
        <a href="#" class="active"><i class="fas fa-home"></i> Dashboard</a>
        <a href="#"><i class="fas fa-map-marker-alt"></i> Pickup Locations</a>
        <a href="#"><i class="fas fa-weight"></i> Scrap Collected</a>
        <a href="#"><i class="fas fa-money-bill"></i> Payments</a>
        <a href="#"><i class="fas fa-history"></i> History</a>
        <a href="/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <!-- Content -->
    <div class="content">
        <h2>Dashboard</h2>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <h5>Total Pickups</h5>
                    <p class="counter">{{ $totalPickups ?? 0 }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-dark">
                    <h5>Pending Pickups</h5>
                    <p class="counter">{{ $pendingPickups ?? 0 }}</p>
                </div>
            </div>
            <div class="col-md-3">
    <div class="card bg-success text-white">
        <h5>Total Weight Collected</h5>
        <p class="counter">{{ number_format($totalWeight ?: 0, 2) }} kg</p>
        </div>
</div>
<div class="col-md-3">
    <div class="card bg-info text-white">
        <h5>Total Payments Made</h5>
        <p class="counter">₹{{ number_format($totalPayments, 2) }}</p>
        </div>
</div>

        </div>

       <!-- Pickup Locations Table -->
        <div class="mt-4 table-container">
            <h4>Recent Pickups</h4>
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Category</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Address</th>
                        <th>Weight (kg)</th>
                        <th>Remark</th>
                        <th>Image</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Total Weight (kg)</th>
                        <th>Payment (₹)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pickups as $index => $pickup)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $pickup->category }}</td>
                        <td>{{ $pickup->date }}</td>
                        <td>{{ $pickup->time }}</td>
                        <td>{{ $pickup->address }}</td>
                        <td>{{ $pickup->weight }}</td>
                        <td>{{ $pickup->remark }}</td>
                       <!-- Scrap Image Modal -->
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

<!-- Modify Image Tag in the Table -->
<td>
    <img src="{{ asset($pickup->image) }}" alt="Scrap Image" class="img-thumbnail magnify-image" data-bs-toggle="modal" data-bs-target="#imageModal">
</td>

<!-- JavaScript to Handle Image Click -->


                        <td>{{ $pickup->email }}</td>
                        <td>
                            <span class="badge {{ $pickup->status == 'completed' ? 'bg-success' : 'bg-warning text-dark' }}">
                                {{ ucfirst($pickup->status) }}
                            </span>
                        </td>
                        <td>
                            <form action="{{ route('updatePickup', $pickup->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="number" name="total_weight" value="{{ $pickup->total_weight }}" class="form-control form-control-sm">
                        </td>
                        <td>
                                <input type="number" name="amount_paid" value="{{ $pickup->amount_paid }}" class="form-control form-control-sm">
                        </td>
                        <td>
                                <button type="submit" class="btn btn-sm btn-primary btn-save">Save</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Counter-Up Animation -->
    <!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function () {
    // Initialize counter animation
    $(".counter").each(function () {
        let value = $(this).text().trim();

        // Convert empty or NaN values to "0.00"
        if (value === "" || isNaN(parseFloat(value))) {
            $(this).text("0.00");
        }
    });

    $(".counter").counterUp({ delay: 10, time: 1000 });

    // Handle save button click event
    $(".btn-save").click(function (event) {
        event.preventDefault();

        let row = $(this).closest("tr");
        let totalWeight = row.find("input[name='total_weight']").val().trim();
        let amountPaid = row.find("input[name='amount_paid']").val().trim();
        let form = row.find("form");

        // Validate inputs
        if (totalWeight === "" || amountPaid === "") {
            Swal.fire({
                icon: "error",
                title: "Missing Input",
                text: "Please enter total weight and amount before saving.",
            });
            return;
        }

        // Ensure inputs are numeric
        if (isNaN(totalWeight) || isNaN(amountPaid)) {
            Swal.fire({
                icon: "error",
                title: "Invalid Input",
                text: "Total weight and amount must be valid numbers.",
            });
            return;
        }

        Swal.fire({
            title: "Are you sure?",
            text: "You want to save the entered weight and payment details?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Save it!"
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});


</script>

</body>
</html>
