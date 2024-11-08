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

// Check if id is set in the URL
if (isset($_GET['id'])) {
    $clientId = intval($_GET['id']);

    // Delete the client record from the clients table
    $deleteClientSQL = "DELETE FROM clients WHERE id = ?";
    if ($stmt = $connection->prepare($deleteClientSQL)) {
        $stmt->bind_param("i", $clientId);
        if ($stmt->execute()) {
            $stmt->close();
            
            // Display a success message before redirecting
            echo "<script>
                alert('Check-out successful. You will be redirected to the information management page.');
                window.location.href = 'information-management.php';
            </script>";
        } else {
            echo "<script>alert('Error executing the statement: " . $stmt->error . "');</script>";
        }
    } else {
        die("Error preparing statement: " . $connection->error);
    }
} else {
    echo "Invalid request. Missing parameters.";
}

$connection->close();
?>
