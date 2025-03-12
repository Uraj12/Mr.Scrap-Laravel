<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Today's Pickups</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-4">
        <h2>Today's Pickup Schedule</h2>
        <button class="btn btn-primary mb-3" id="refreshBtn">Refresh</button>
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
            <tbody id="pickupTable">
                <tr><td colspan="9" class="text-center text-muted">Loading...</td></tr>
            </tbody>
        </table>
        <div id="errorMessage" class="alert alert-danger d-none"></div>
    </div>

    <script>
    $(document).ready(function () {
    function loadPickups() {
        console.log("🚀 Fetching data from API...");

        $.ajax({
            url: "http://127.0.0.1:80001/admin/pickups/today",
            type: "GET",
            dataType: "json",
            success: function (data) {
                console.log("✅ API Response:", data); // Debug Print

                if (!Array.isArray(data) || data.length === 0) {
                    console.warn("⚠️ No pickup data found!");
                    $("#pickupTable").html("<tr><td colspan='9' class='text-center text-danger'>No pickups available today</td></tr>");
                    return;
                }

                let rows = "";
                data.forEach(pickup => {
                    console.log("📌 Pickup Data:", pickup);

                    let amountPaid = pickup.amount_paid !== null ? `₹${pickup.amount_paid}` : "N/A";
                    let status = pickup.status ? pickup.status.toLowerCase() : "pending";

                    rows += `
                        <tr>
                            <td>${pickup.id}</td>
                            <td>${pickup.category}</td>
                            <td>${pickup.date}</td>
                            <td>${pickup.time}</td>
                            <td>${pickup.address}</td>
                            <td>${pickup.weight} kg</td>
                            <td>${amountPaid}</td>
                            <td>${status}</td>
                            <td>
                                ${status === 'pending'
                                    ? `<button class="btn btn-success complete-btn" data-id="${pickup.id}">Complete</button>`
                                    : `<span class="badge bg-success">Completed</span>`}
                            </td>
                        </tr>
                    `;
                });

                $("#pickupTable").html(rows);
            },
            error: function (xhr, status, error) {
                console.error("❌ API Fetch Error:", xhr.status, xhr.responseText, error);
                alert("API Error: " + xhr.responseText);
                $("#errorMessage").removeClass("d-none").text("Error: " + xhr.responseText);
            }
        });
    }

    loadPickups(); // Page load thay tyare data fetch karo
});

    </script>
</body>
</html>
