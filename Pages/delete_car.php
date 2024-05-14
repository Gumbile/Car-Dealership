<?php
include_once('db.php');
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['carid'])) {
    $carID = $_GET['carid'];

    // Delete the car from the Cars table
    $query = "DELETE FROM Cars WHERE CarID = $carID";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo '<div class="alert alert-success" role="alert">Car deleted successfully.</div>';
        header("Location: http://localhost/car-dealership/pages/cars.php");
    } else {
        echo '<div class="alert alert-danger" role="alert">Error deleting car: ' . mysqli_error($conn) . '</div>';
    }
}
?>
