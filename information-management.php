<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "database1";

// Create a connection
$connection = new mysqli($servername, $username, $password, $database);

// Check for connection errors
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Get current date
$currentDate = date('Y-m-d');

// Get the current date's week number and month
$currentWeek = date('W');
$currentMonth = date('m');

// Query to retrieve all clients
$clientsQuery = "SELECT * FROM clients ORDER BY date DESC";
$result = $connection->query($clientsQuery);

// Initialize arrays for sorting by day, week, and month
$daily = [];
$weekly = [];
$monthly = [];

while ($row = $result->fetch_assoc()) {
    $clientDate = $row['date'];
    $clientWeek = date('W', strtotime($clientDate));
    $clientMonth = date('m', strtotime($clientDate));

    // Sort by daily
    if ($clientDate === $currentDate) {
        $daily[] = $row;
    }

    // Sort by weekly
    if ($clientWeek == $currentWeek) {
        $weekly[] = $row;
    }

    // Sort by monthly
    if ($clientMonth == $currentMonth) {
        $monthly[] = $row;
    }
}

$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Information Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <style>

        .center-title {
            text-align: center;
            margin-top: 50px;
            margin-bottom: 50px;
        }
    </style>
</head>
<body>
<div class="container my-5">
    <h2 class="center-title">Clients Information Management</h2>

    <!-- Daily Records -->
    <h3>Daily Check-ins</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Vehicle Type</th>
                <th>Registration</th>
                <th>Slot Occupied</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($daily)) {
                foreach ($daily as $row) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['vehicle_type']}</td>
                            <td>{$row['registration']}</td>
                            <td>{$row['slot_occupied']}</td>
                            <td>{$row['date']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6' class='text-center'>No daily check-ins</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Weekly Records -->
    <h3>Weekly Check-ins</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Vehicle Type</th>
                <th>Registration</th>
                <th>Slot Occupied</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($weekly)) {
                foreach ($weekly as $row) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['vehicle_type']}</td>
                            <td>{$row['registration']}</td>
                            <td>{$row['slot_occupied']}</td>
                            <td>{$row['date']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6' class='text-center'>No weekly check-ins</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Monthly Records -->
    <h3>Monthly Check-ins</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Vehicle Type</th>
                <th>Registration</th>
                <th>Slot Occupied</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($monthly)) {
                foreach ($monthly as $row) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['vehicle_type']}</td>
                            <td>{$row['registration']}</td>
                            <td>{$row['slot_occupied']}</td>
                            <td>{$row['date']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6' class='text-center'>No monthly check-ins</td></tr>";
            }
            ?>
        </tbody>
    </table>

</div>

</body>
</html>
