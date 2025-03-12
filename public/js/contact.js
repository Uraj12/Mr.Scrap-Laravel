document.querySelector('.contact-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent page reload

    let formData = new FormData(this);

    fetch('/send-contact', {  // ✅ Correct route
        method: 'POST',
        body: formData,
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content  // Add CSRF Token
        }
    })
    .then(response => response.json()) // Expect JSON response
    .then(data => {
        alert(data.success); // Show success message
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
