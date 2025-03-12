<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 350px;
            margin: 100px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        h2 {
            color: #28a745;
        }
        .login-form input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .login-form button {
            width: 100%;
            background-color: #28a745;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .login-form button:hover {
            background-color: #218838;
        }
        .message {
            margin-top: 10px;
            font-size: 16px;
            font-weight: bold;
        }
        .error {
            color: red;
        }
        .success {
            color: green;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form class="login-form">
            @csrf
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
            <button type="submit">Login</button>
        </form>
        <p class="message"></p>
    </div>

    <script>
    document.querySelector('.login-form').addEventListener('submit', function(event) {
        event.preventDefault();

        let email = document.getElementById('email').value.trim();
        let password = document.getElementById('password').value.trim();
        let messageBox = document.querySelector('.message');

        // Static admin check
        if (email === "admin@gmail.com" && password === "admin") {
            messageBox.innerHTML = `<span class="success">Admin login successful! Redirecting...</span>`;
            setTimeout(() => {
                window.location.href = "{{ route('admin.dashboard') }}"; // Redirect to admin panel
            }, 1500);
            return;
        }

        // Static pickup man check
        if (email === "pickup@gmail.com" && password === "pickup") {
            messageBox.innerHTML = `<span class="success">Pickup Man login successful! Redirecting...</span>`;
            setTimeout(() => {
                window.location.href = "{{ route('pickupMan.dashboard') }}"; // Redirect to pickup dashboard
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
                    window.location.href = "/welcome"; // Redirect for regular users
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

</body>
</html>
