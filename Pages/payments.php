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

// Fetch reserved cars for the current user
$sql = "SELECT Model, Year_, PlateID, BaseRate FROM Cars
        INNER JOIN Reservations ON Cars.CarID = Reservations.CarID
        INNER JOIN Locations ON Cars.LocationID = Locations.LocationID
        WHERE Reservations.UserID = " . $_SESSION['user_id'] . "
        ORDER BY Reservations.StartDate DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserved Cars</title>
    <!-- Include Bootstrap CSS -->
    <link href="bootstrap-5.0.2-dist/bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include("templates/header.php"); ?>
    <div class="container">
        <h2>Reserved Cars</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Model</th>
                    <th>Year</th>
                    <th>Plate ID</th>
                    <th>Base Rate</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Check if the user is logged in
                if (!isset($_SESSION['user_id'])) {
                    // Redirect to the login page if not logged in
                    header("Location: login.php");
                    exit;
                }

                // Include the database connection
                require 'config/db_connect.php';

                // Fetch reserved cars for the current user
                $sql = "SELECT Model, Year_, PlateID, BaseRate FROM Cars
                INNER JOIN Reservations ON Cars.CarID = Reservations.CarID
                WHERE Reservations.UserID = " . $_SESSION['user_id'] . "
                AND Reservations.Status_ = 'Active'
                ORDER BY Reservations.StartDate DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
echo "<tr><td>" . $row["Model"] . "</td><td>" . $row["Year_"] . "</td><td>" . $row["PlateID"] . "</td><td>" . $row["BaseRate"]  . "</td><td><a href='return_car.php?plateID=" . $row["PlateID"] . "' class='btn btn-primary'>Return</a></td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No reserved cars found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>

<?php
// Close the database connection
$conn->close();
?>
