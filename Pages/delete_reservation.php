<?php
// Assume $conn is your database connection
require 'config/db_connect.php';
if(isset($_GET['reservationid'])) {
    $userID = $_GET['reservationid'];
    
    $sql = "DELETE FROM reservations WHERE reservationid = $userID";
    $stmt = $conn->prepare($sql);
    
    if($stmt->execute()) {
        // User deleted successfully
        header("Location: reservation.php");
        exit();
    } else {
        // Failed to delete user
        echo "Error: " . $conn->error;
    }
} else {
    // No user ID provided
    echo "Invalid user ID";
}
?>