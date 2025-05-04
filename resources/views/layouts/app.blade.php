<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <title>@yield('title', 'Mr.Scrap')</title>
    <link rel="stylesheet" href="http://127.0.0.1:8000/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://127.0.0.1:8000/css/navbar.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    
</head>
<body>  

    <!-- Navbar (Accessible on Every Page) -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top shadow-sm py-2">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="/welcome">
                <img src="{{ asset('scrap_images/Mr.scrap.png') }}" alt="ScrapUncle" class="img-fluid" style="max-height: 48px;">
                <span class="fw-bold text-primary d-none d-md-inline">Mr.Scrap</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Services
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
                            <li><a class="dropdown-item" href="/scrapcollection">Scrap Collection</a></li>
                            <li><a class="dropdown-item" href="#">Recycling</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="companyDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Company
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="companyDropdown">
                            <li><a class="dropdown-item" href="/about">About Us</a></li>
                            <li><a class="dropdown-item" href="/contact-us">Contact</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="d-flex align-items-center gap-2 mt-3 mt-lg-0">
                    <a href="/scrap-rate-list" class="btn btn-outline-primary me-2">Check Rate List</a>
                    @if(Auth::check())
                        <!-- Profile Icon -->
                        <a href="/profile" class="user-icon text-decoration-none" title="Profile">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </a>
                        <!-- Camera Button for Scanning Scrap -->
                        <button class="btn btn-outline-success ms-2" onclick="openCamera()" title="Scan Scrap">
                            <span class="d-none d-md-inline">Scan</span> 📷
                        </button>
                    @else
                        <a href="/login" class="btn btn-primary">Login</a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="container mt-5 pt-5">
        @yield('content')  <!-- Ensure content from child views is loaded here -->
    </div>
    <script>
    function openCamera() {
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(function (stream) {
                let videoElement = document.createElement("video");
                videoElement.srcObject = stream;
                videoElement.autoplay = true;
                videoElement.style.width = "100%";
                videoElement.style.height = "auto";
                
                // Create a container for the video
                let videoContainer = document.createElement("div");
                videoContainer.style.position = "fixed";
                videoContainer.style.top = "0";
                videoContainer.style.left = "0";
                videoContainer.style.width = "100vw";
                videoContainer.style.height = "100vh";
                videoContainer.style.background = "rgba(0,0,0,0.8)";
                videoContainer.style.display = "flex";
                videoContainer.style.justifyContent = "center";
                videoContainer.style.alignItems = "center";
                videoContainer.appendChild(videoElement);
                
                // Create a capture button
                let captureButton = document.createElement("button");
                captureButton.innerText = "Capture";
                captureButton.style.position = "absolute";
                captureButton.style.bottom = "20px";
                captureButton.style.padding = "10px 20px";
                captureButton.style.background = "#28a745";
                captureButton.style.color = "#fff";
                captureButton.style.border = "none";
                captureButton.style.cursor = "pointer";
                captureButton.onclick = function () {
                    captureImage(videoElement);
                    stream.getTracks().forEach(track => track.stop()); // Stop the camera
                    document.body.removeChild(videoContainer); // Remove video container
                };

                videoContainer.appendChild(captureButton);
                document.body.appendChild(videoContainer);
            })
            .catch(function (err) {
                alert("Camera access denied! Please allow camera permissions.");
                console.error(err);
            });
    }

    function captureImage(video) {
        let canvas = document.createElement("canvas");
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        let context = canvas.getContext("2d");
        context.drawImage(video, 0, 0, canvas.width, canvas.height);

        let imageData = canvas.toDataURL("image/png");

        // Send image to your Django API
        uploadImage(imageData);
    }

    function uploadImage(imageData) {
    fetch("http://127.0.0.1:8080/api/predict/", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ image: imageData }),
        mode: "cors",  // ✅ Ensure cross-origin requests work
    })
    .then(response => {
        if (!response.ok) {
            throw new Error("Bad request: " + response.status);
        }
        return response.json();
    })
    .then(data => {
        alert("Prediction: " + data.result);
    })
    .catch(error => console.error("Error:", error));
}


</script>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
