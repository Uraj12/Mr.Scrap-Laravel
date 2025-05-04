<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pickup Man Reports | Mr. Scrap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-light">
<div class="container py-5">
    <h1 class="fw-bold mb-4 text-primary">Pickup Man Reports</h1>
    <div class="row g-4 mb-4">
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow h-100 bg-gradient bg-primary text-white text-center">
                <div class="card-body">
                    <i class="fas fa-truck fa-2x mb-2"></i>
                    <h5 class="card-title">Total Pickups</h5>
                    <p class="display-6 fw-bold mb-0">{{ $totalPickups ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow h-100 bg-gradient bg-warning text-dark text-center">
                <div class="card-body">
                    <i class="fas fa-clock fa-2x mb-2"></i>
                    <h5 class="card-title">Pending Pickups</h5>
                    <p class="display-6 fw-bold mb-0">{{ $pendingPickups ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow h-100 bg-gradient bg-success text-white text-center">
                <div class="card-body">
                    <i class="fas fa-weight fa-2x mb-2"></i>
                    <h5 class="card-title">Total Weight</h5>
                    <p class="display-6 fw-bold mb-0">{{ number_format($totalWeight ?: 0, 2) }} kg</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow h-100 bg-gradient bg-info text-white text-center">
                <div class="card-body">
                    <i class="fas fa-rupee-sign fa-2x mb-2"></i>
                    <h5 class="card-title">Payments Made</h5>
                    <p class="display-6 fw-bold mb-0">₹{{ number_format($totalPayments, 2) }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end mb-3">
        <a href="#" class="btn btn-outline-primary"><i class="fas fa-file-csv me-1"></i>Export CSV</a>
        <a href="#" class="btn btn-outline-success ms-2"><i class="fas fa-file-excel me-1"></i>Export Excel</a>
    </div>
    <div class="table-responsive bg-white rounded shadow p-3">
        <h4 class="mb-3">Pickup Report Table</h4>
        <table class="table table-striped table-hover align-middle table-bordered border-primary" style="border-radius: 1rem; overflow: hidden;">
            <thead class="table-primary sticky-top">
                <tr>
                    <th>#</th>
                    <th>Category</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Address</th>
                    <th>Weight (kg)</th>
                    <th>Status</th>
                    <th>Payment (₹)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pickups as $index => $pickup)
                <tr>
                    <td class="fw-bold">{{ $index + 1 }}</td>
                    <td><span class="badge bg-secondary">{{ $pickup->category }}</span></td>
                    <td>{{ $pickup->date }}</td>
                    <td>{{ $pickup->time }}</td>
                    <td>{{ $pickup->address }}</td>
                    <td><span class="badge bg-success-subtle text-success fw-bold">{{ $pickup->weight }}</span></td>
                    <td>
                        <span class="badge {{ $pickup->status == 'completed' ? 'bg-success' : 'bg-warning text-dark' }}">
                            {{ ucfirst($pickup->status) }}
                        </span>
                    </td>
                    <td>₹{{ number_format($pickup->amount_paid, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 