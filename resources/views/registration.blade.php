<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">

    <style>
        /* General Styling */
        body {
            font-family: 'Roboto', sans-serif;
            background: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 500px;
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s;
        }

        .container:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        }

        h1 {
            color: #28a745;
            font-size: 28px;
            margin-bottom: 20px;
        }

        .register-form input, .otp-form input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
            transition: border 0.3s;
        }

        .register-form input:focus, .otp-form input:focus {
            border: 1px solid #28a745;
            outline: none;
            box-shadow: 0 0 8px rgba(40, 167, 69, 0.3);
        }

        .register-form button, .otp-form button {
            width: 100%;
            background: linear-gradient(135deg, #28a745, #218838);
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
        }

        .register-form button:hover, .otp-form button:hover {
            background: linear-gradient(135deg, #218838, #1e7e34);
            transform: translateY(-5px);
        }

        .message {
            margin-top: 15px;
            font-size: 16px;
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
            transition: 0.3s;
        }

        .login-link a:hover {
            text-decoration: underline;
            color: #0056b3;
        }
    </style>
</head>

<body>

<div class="container">

    <!-- Registration Form -->
    <div id="registerSection">
        <h1>Create an Account</h1>
        <form class="register-form" id="registerForm">
            @csrf
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="text" name="phno" placeholder="Phone Number" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <button type="submit">Register</button>
        </form>

        <p class="login-link">
            Already registered? <a href="/login">Click here to login</a>
        </p>
    </div>

    <!-- OTP Verification Form -->
    <div id="otpSection" style="display: none;">
        <h1>Enter OTP</h1>
        <form class="otp-form" id="otpForm">
            <input type="text" name="otp" placeholder="Enter OTP" required>
            <button type="submit">Verify OTP</button>
        </form>

        <p class="login-link">
            Already registered? <a href="/login">Click here to login</a>
        </p>
    </div>

    <p class="message"></p>

</div>

<script>
    const registerSection = document.getElementById('registerSection');
    const otpSection = document.getElementById('otpSection');

    document.querySelector('#registerForm').addEventListener('submit', function(event) {
        event.preventDefault();

        let formData = new FormData(this);
        let messageBox = document.querySelector('.message');

        fetch('/send-otp', {
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
                registerSection.style.display = 'none';
                otpSection.style.display = 'block';
                messageBox.innerHTML = `<span class="success">OTP sent to your phone!</span>`;
            } else {
                messageBox.innerHTML = `<span class="error">${data.error}</span>`;
            }
        });
    });

    document.querySelector('#otpForm').addEventListener('submit', function(event) {
        event.preventDefault();

        let formData = new FormData(this);

        fetch('/verify-otp', {
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
                window.location.href = "/login";
            } else {
                document.querySelector('.message').innerHTML = `<span class="error">${data.error}</span>`;
            }
        });
    });
</script>

</body>
</html>
