<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MrScrap</title>
    
    <!-- Bootstrap & Font Awesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
           
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .container {
            background: white;
            padding: 50px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            max-width: 450px;
            width: 100%;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .container:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.2);
        }

        h2 {
            font-size: 32px;
            color: #28a745;
            margin-bottom: 30px;
        }

        .form-control {
            border-radius: 8px;
            font-size: 16px;
            padding: 12px;
        }

        .btn {
            width: 100%;
            background: #28a745;
            color: white;
            padding: 12px;
            font-size: 18px;
            border: none;
            border-radius: 8px;
            transition: background 0.3s, transform 0.2s;
        }

        .btn:hover {
            background: #218838;
            transform: scale(1.05);
        }

        .message {
            margin-top: 15px;
            font-size: 16px;
            font-weight: bold;
        }

        .error {
            color: red;
        }

        .success {
            color: green;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }

        .footer a {
            color: #28a745;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 576px) {
            .container {
                padding: 30px;
            }
        }
    </style>
</head>

<body>

<div class="container">
    <h2><i class="fas fa-user-lock"></i> Login</h2>

    <form class="login-form">
        @csrf
        <div class="mb-3">
            <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
        </div>

        <div class="mb-3">
            <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
        </div>

        <button type="submit" class="btn">Login <i class="fas fa-sign-in-alt"></i></button>

        <p class="message mt-3"></p>

        <div class="footer">
        <p>Don't have an account? <a href="/registration">Sign Up</a></p>
        </div>
    </form>
</div>

<script>
    document.querySelector('.login-form').addEventListener('submit', function(event) {
        event.preventDefault();

        let email = document.getElementById('email').value.trim();
        let password = document.getElementById('password').value.trim();
        let messageBox = document.querySelector('.message');

        // Static Admin check
        if (email === "admin@gmail.com" && password === "admin") {
            messageBox.innerHTML = `<span class="success">Admin login successful! Redirecting...</span>`;
            setTimeout(() => {
                window.location.href = "{{ route('admin.dashboard') }}"; 
            }, 1500);
            return;
        }

        // Static Pickup Man check
        if (email === "pickup@gmail.com" && password === "pickup") {
            messageBox.innerHTML = `<span class="success">Pickup Man login successful! Redirecting...</span>`;
            setTimeout(() => {
                window.location.href = "{{ route('pickupMan.dashboard') }}"; 
            }, 1500);
            return;
        }

        // Regular login process
        let formData = new FormData(this);
        messageBox.innerHTML = "Logging in...";

        fetch('/login-user', {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                messageBox.innerHTML = `<span class="success">${data.success}</span>`;
                setTimeout(() => {
                    window.location.href = "/welcome"; 
                }, 2000);
            } else {
                messageBox.innerHTML = `<span class="error">${data.error}</span>`;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            messageBox.innerHTML = `<span class="error">Login failed. Try again later.</span>`;
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
