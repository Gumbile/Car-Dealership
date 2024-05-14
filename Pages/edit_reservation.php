<?php
// Check if reservation ID is provided
require 'config/db_connect.php';

if (!isset($_GET['reservationid'])) {
    header("Location: reservation.php"); // Redirect to reservations page if reservation ID is not provided
    exit();
}

// Assume $conn is your database connection
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process form submission
    $reservationID = $_GET['reservationid'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $pickupLocationID = $_POST['pickupLocationID'];
    $dropOffLocationID = $_POST['dropOffLocationID'];

    $query = "SELECT * FROM locations WHERE LocationID IN ('$pickupLocationID', '$dropOffLocationID')";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 2) { // Both IDs exist
        // Update the reservation in the database
        $updateQuery = "UPDATE reservations SET StartDate='$startDate', EndDate='$endDate', PickupLocationID='$pickupLocationID', DropOffLocationID='$dropOffLocationID' WHERE ReservationID='$reservationID'";
        if (mysqli_query($conn, $updateQuery)) {
            echo "<div class='alert alert-success'>Reservation updated successfully</div>";
            echo "Reservation updated successfully.";
            header("Location: reservation.php");
        } else {
            echo "<div class='alert alert-danger'>Error updating reservation: " . mysqli_error($conn) . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Invalid Pickup or Drop-off Location ID</div>";
    }

    
}

// Fetch reservation details
$reservationID = $_GET['reservationid'];
$query = "SELECT * FROM reservations WHERE ReservationID='$reservationID'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="bootstrap-5.0.2-dist/bootstrap-5.0.2-dist/css/bootstrap-grid.min.css" rel="stylesheet">
    <link href="bootstrap-5.0.2-dist/bootstrap-5.0.2-dist//css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

</head>
<body>
<div class="container">
    <h2>Edit Reservation</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="startDate">Start Date:</label>
                <input type="date" class="form-control" name="startDate" id="startDate" value="<?php echo $row['StartDate']; ?>" required>
            </div>
            <div class="form-group">
                <label for="endDate">End Date:</label>
                <input type="date" class="form-control" name="endDate" id="endDate" value="<?php echo $row['EndDate']; ?>" required>
            </div>
            <div class="form-group">
                <label for="pickupLocationID">Pickup Location ID:</label>
                <input type="text" class="form-control" name="pickupLocationID" id="pickupLocationID" value="<?php echo $row['PickupLocationID']; ?>" required>
        </div>
            <div class="form-group">
                <label for="dropOffLocationID">Drop-Off Location ID:</label>
                <input type="text" class="form-control" name="dropOffLocationID" id="dropOffLocationID" value="<?php echo $row['DropOffLocationID']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Reservation</button>
        </form>
    </div>

</body>
</html>
