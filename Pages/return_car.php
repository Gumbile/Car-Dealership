<?php
// Start the session to access session variables
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit;
}

// Include the database connection
require 'config/db_connect.php';

if (isset($_GET['plateID'])) {
    // Update reservation status to "Ended"
    $sqlUpdateReservation = "UPDATE Reservations SET Status_ = 'Ended' WHERE UserID = " . $_SESSION['user_id'] . " AND CarID IN (SELECT CarID FROM Cars WHERE PlateID = '" . $_GET['plateID'] . "') AND Status_ = 'Active'";
    $conn->query($sqlUpdateReservation);

    // Update car status to "Available"
    $sqlUpdateCar = "UPDATE Cars SET Status_ = 'Available' WHERE PlateID = '" . $_GET['plateID'] . "'";
    $conn->query($sqlUpdateCar);

    // Redirect back to the reserved_cars.php page
    header("Location: payments.php");
    exit;
} else {
    // Redirect to the reserved_cars.php page if no plateID is provided
    header("Location: payments.php");
    exit;
}
?>
