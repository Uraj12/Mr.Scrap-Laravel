<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <title>Registration with OTP</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SweetAlert, Bootstrap, and Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            width: 100%;
            max-width: 500px;
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
        }

        .container:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2);
        }

        h1 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #28a745;
            text-align: center;
        }

        input, button {
            width: 100%;
            margin: 10px 0;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            transition: all 0.3s;
        }

        input:focus {
            border-color: #28a745;
            box-shadow: 0 0 8px rgba(40, 167, 69, 0.3);
        }

        button {
            background: #28a745;
            color: #fff;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background: #218838;
        }

        .btn-close {
            border: none;
            background: transparent;
            color: #ccc;
        }

        .btn-close:hover {
            color: red;
        }
    </style>
</head>

<body>

<div class="container">

    <!-- Registration Form -->
    <div id="registerSection">
        <h1><i class="fa-solid fa-user-plus"></i> Register</h1>
        <form id="registerForm">
            @csrf
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="text" name="phno" placeholder="Phone Number" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <button type="submit"><i class="fa-solid fa-paper-plane"></i> Register</button>
            <div class="text-center mt-3">
            <a href="/login" class="text-decoration-none" style="color: #28a745;">
                <i class="fa-solid fa-sign-in-alt"></i> Already registered? Login here
            </a>
        </div>
        </form>
    </div>

</div>

<!-- OTP Modal -->
<div class="modal fade" id="otpModal" tabindex="-1" aria-labelledby="otpModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fa-solid fa-key"></i> Enter OTP</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="otpForm">
          <input type="text" name="otp" placeholder="Enter OTP" required>
          <button type="submit"><i class="fa-solid fa-check"></i> Verify OTP</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const registerForm = document.querySelector('#registerForm');
const otpModal = new bootstrap.Modal(document.getElementById('otpModal'));

function showAlert(type, message) {
    Swal.fire({
        icon: type,
        title: message,
        confirmButtonColor: '#28a745'
    });
}

registerForm.addEventListener('submit', function(event) {
    event.preventDefault();
    let formData = new FormData(this);

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
        if (data.error) {
            // ✅ Show SweetAlert if phone number is already registered
            Swal.fire({
                icon: 'error',
                title: 'Phone Number Exists!',
                text: data.error,
                confirmButtonColor: '#dc3545'
            });
        } else if (data.errors) {
            let passwordErrors = [];
            let confirmPasswordErrors = [];
            let otherErrors = [];

            // Separate password and confirm password errors
            for (const field in data.errors) {
                data.errors[field].forEach(error => {
                    if (field === 'password') {
                        passwordErrors.push(error);
                    } else if (field === 'confirm_password') {
                        confirmPasswordErrors.push(error);
                    } else {
                        otherErrors.push(error);
                    }
                });
            }

            // Display password validation errors
            if (passwordErrors.length > 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Password!',
                    html: `<ul style="text-align: left;">${passwordErrors.map(e => `<li>${e}</li>`).join('')}</ul>`,
                    confirmButtonColor: '#dc3545'
                });
            }

            // Display confirm password validation errors
            if (confirmPasswordErrors.length > 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Confirm Password Mismatch!',
                    html: `<ul style="text-align: left;">${confirmPasswordErrors.map(e => `<li>${e}</li>`).join('')}</ul>`,
                    confirmButtonColor: '#dc3545'
                });
            }

            // Display other validation errors
            if (otherErrors.length > 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Failed!',
                    html: `<ul style="text-align: left;">${otherErrors.map(e => `<li>${e}</li>`).join('')}</ul>`,
                    confirmButtonColor: '#dc3545'
                });
            }

        } else if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'OTP Sent!',
                text: data.success,
                confirmButtonColor: '#28a745'
            });
            otpModal.show();
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Something went wrong!',
            text: 'Please try again later.',
            confirmButtonColor: '#dc3545'
        });
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
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')  // ✅ Add CSRF Token
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Registration Successful!',
                text: data.success,
                confirmButtonColor: '#28a745'
            }).then(() => {
                window.location.href = '/login';  // Redirect to login page
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Invalid OTP!',
                text: data.error,
                confirmButtonColor: '#dc3545'
            });
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Something went wrong!',
            text: 'Please try again later.',
            confirmButtonColor: '#dc3545'
        });
    });
});


</script>

</body>
</html>
