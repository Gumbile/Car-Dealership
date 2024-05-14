<?php
// Assume $conn is your database connection
require 'config/db_connect.php';
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $userID = $_GET['id'];
    
    $sql = "DELETE FROM users WHERE UserID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userID);
    
    if($stmt->execute()) {
        // User deleted successfully
        header("Location: customer.php");
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
