<?php
session_start();
include_once('db.php');

// Your admin panel code here
?>


<!DOCTYPE html>
<html>

<head>
    <title>Admin Panel</title>
    <link href="bootstrap-5.0.2-dist/bootstrap-5.0.2-dist/css/bootstrap-grid.min.css" rel="stylesheet">
    <link href="bootstrap-5.0.2-dist/bootstrap-5.0.2-dist//css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script></script>
    <link rel="stylesheet" href="../css/style.css">
    
</head>

<body>
    <div class="sidebar">
            <h2>Admin Panel</h2>
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link" href="admin.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Cars</a></li>
                <li class="nav-item"><a class="nav-link" href="Customer.php">Users</a></li>
                <li class="nav-item"><a class="nav-link" href="reservation.php">Reservations</a></li>
                <li class="nav-item"><a class="nav-link" href="?logout">Logout</a></li>
            </ul>
        </div>

        <style>
            body {
                font-family: Arial, sans-serif;
            }
        </style>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col">

                    <h3>All Reservations</h3>
                    <a href="#" class="btn btn-success mb-3">Add New Reservation</a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ReservationID</th>
                                <th>CarID</th>
                                <th>UserID</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Pickup LocationID</th>
                                <th>Drop-off LocationID</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Assume $conn is your database connection
                            $query = "SELECT * FROM reservations";
                            $result = mysqli_query($conn, $query);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>{$row['ReservationID']}</td>";
                                    echo "<td>{$row['CarID']}</td>";
                                    echo "<td>{$row['UserID']}</td>";
                                    echo "<td>{$row['StartDate']}</td>";
                                    echo "<td>{$row['EndDate']}</td>";
                                    echo "<td>{$row['PickupLocationID']}</td>";
                                    echo "<td>{$row['DropOffLocationID']}</td>";

                                    echo "<td>";
                                    echo "<a href='edit_reservation.php?reservationid={$row['ReservationID']}' class='btn btn-primary'>Update</a>";
                                    echo "<a href='delete_reservation.php?reservationid={$row['ReservationID']}' class='btn btn-danger'>Delete</a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='8'>No reservations found</td></tr>";
                            }
                            ?>
                        </tbody>

                    </table>
                </div>
            </div>

</html>