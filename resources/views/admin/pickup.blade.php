<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Today's Pickups</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Today's Pickup Schedule</h2>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Address</th>
                    <th>Weight (kg)</th>
                    <th>Amount Paid</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($pickups->isEmpty())
                    <tr><td colspan="9" class="text-center text-danger">No pickups available today</td></tr>
                @else
                    @foreach ($pickups as $pickup)
                        <tr>
                            <td>{{ $pickup->id }}</td>
                            <td>{{ $pickup->category }}</td>
                            <td>{{ $pickup->date }}</td>
                            <td>{{ $pickup->time }}</td>
                            <td>{{ $pickup->address }}</td>
                            <td>{{ $pickup->weight }} kg</td>
                            <td>{{ $pickup->amount_paid ? '₹' . $pickup->amount_paid : 'N/A' }}</td>
                            <td>{{ strtolower($pickup->status) }}</td>
                            <td>
                                @if (strtolower($pickup->status) === 'pending')
                                    <form action="{{ url('/admin/pickup/complete', $pickup->id) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-success">Complete</button>
                                    </form>
                                @else
                                    <span class="badge bg-success">Completed</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</body>
</html>
