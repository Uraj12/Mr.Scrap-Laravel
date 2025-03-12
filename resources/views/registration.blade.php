<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
            max-width: 600px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        h1 {
            color: #28a745;
        }
        .register-form input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .register-form button {
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .register-form button:hover {
            background-color: #218838;
        }
        .message {
            margin-top: 10px;
            font-size: 16px;
            font-weight: bold;
        }
        .success {
            color: green;
        }
        .error {
            color: red;
        }
        .login-link {
            margin-top: 20px;
            font-size: 16px;
        }
        .login-link a {
            color: #007bff;
            text-decoration: none;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Register</h1>
        <form class="register-form">
            @csrf
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <input type="text" name="phno" placeholder="Phone Number" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>
        <p class="message"></p>
        <p class="login-link">Already have an account? <a href="/login">Click here to login</a></p>
    </div>

    <script>
        document.querySelector('.register-form').addEventListener('submit', function(event) {
            event.preventDefault();

            let formData = new FormData(this);
            let messageBox = document.querySelector('.message');
            messageBox.innerHTML = "Registering...";

            fetch('/register-user', {
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
                    document.querySelector('.register-form').reset();
                    setTimeout(() => {
                        window.location.href = "/login"; // Redirect to login page
                    }, 2000);
                } else {
                    messageBox.innerHTML = `<span class="error">Something went wrong!</span>`;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                messageBox.innerHTML = `<span class="error">Failed to register. Try again later.</span>`;
            });
        });
    </script>
</body>
</html>
