<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
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
        .contact-form input, .contact-form textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .contact-form button {
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .contact-form button:hover {
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Contact Us</h1>
        <form class="contact-form">
            @csrf
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <textarea name="message" placeholder="Your Message" rows="4" required></textarea>
            <button type="submit">Send Message</button>
        </form>
        <p class="message"></p> <!-- ✅ Message display area -->
    </div>

    <script>
       document.querySelector('.contact-form').addEventListener('submit', function(event) {
    event.preventDefault();

    let formData = new FormData(this);
    let messageBox = document.querySelector('.message');
    messageBox.innerHTML = "Sending message..."; // Show sending status

    fetch('/send-contact', {
        method: 'POST',
        body: formData,
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => {
        console.log("Raw Response:", response); // Log response before parsing
        return response.json();
    })
    .then(data => {
        console.log("Parsed JSON:", data); // Log parsed JSON data
        if (data.success) {
            messageBox.innerHTML = `<span class="success">${data.success}</span>`;
            document.querySelector('.contact-form').reset();
        } else {
            messageBox.innerHTML = `<span class="error">Something went wrong!</span>`;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        messageBox.innerHTML = `<span class="error">Failed to send message. Try again later.</span>`;
    });
});

    </script>

</body>
</html>
