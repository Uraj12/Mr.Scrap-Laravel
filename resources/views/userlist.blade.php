<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 30px;
        }
        .table {
            border-radius: 8px;
            overflow: hidden;
            background: white;
        }
        .table thead {
            background: linear-gradient(45deg, #007bff, #0056b3);
            color: white;
        }
        .table tbody tr {
            transition: all 0.3s ease-in-out;
        }
        .table tbody tr:hover {
            background-color: #eaf2ff;
            transform: scale(1.02);
        }
        .table td, .table th {
            padding: 15px;
            text-align: center;
        }
        .card {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 20px;
            background: white;
        }
        .icon {
            color: #007bff;
        }
        .btn-activate {
            background-color: #28a745;
            color: white;
        }
        .btn-deactivate {
            background-color: #dc3545;
            color: white;
        }
        .btn-activate:hover {
            background-color: #218838;
        }
        .btn-deactivate:hover {
            background-color: #c82333;
        }
        #searchInput {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="card">
            <h2 class="text-center mb-3"><i class="fa-solid fa-users icon"></i> User List</h2>

            <!-- Search Bar -->
            <input type="text" id="searchInput" placeholder="🔍 Search by Name..." class="form-control">
            
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th><i class="fa-solid fa-user"></i> Name</th>
                            <th><i class="fa-solid fa-envelope"></i> Email</th>
                            <th><i class="fa-solid fa-phone"></i> Phone</th>
                            <th><i class="fa-solid fa-toggle-on"></i> Action</th>
                        </tr>
                    </thead>
                    <tbody id="userTable">
                        @foreach ($users as $user)
                            <tr>
                                <td class="user-name">{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phno }}</td>
                                <td>
                                    @if ($user->is_active)
                                        <form action="{{ route('user.deactivate', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-deactivate btn-sm">
                                                <i class="fa-solid fa-ban"></i> Deactivate
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('user.activate', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-activate btn-sm">
                                                <i class="fa-solid fa-check"></i> Activate
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript for Search Functionality -->
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function () {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#userTable tr');

            rows.forEach(row => {
                let name = row.querySelector('.user-name').textContent.toLowerCase();
                row.style.display = name.includes(filter) ? '' : 'none';
            });
        });
    </script>

</body>
</html>
