<?php
session_start();
include_once('db.php');

// Your admin panel code here
?>


<!DOCTYPE html>
<html>

<head>
    <title>Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .sidebar {
            width: 250px;
            height: 100%;
            background-color: #333;
            padding-top: 20px;
            position: fixed;
            top: 0;
            left: 0;
        }

        .sidebar h2 {
            color: #fff;
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 10px;
        }

        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
            display: block;
        }

        .sidebar ul li a:hover {
            background-color: #555;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        /* Improved styling for table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Styling for buttons */
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .btn-primary {
            background-color: #337ab7;
        }

        .btn-danger {
            background-color: #d9534f;
        }

        .btn-success {
            background-color: #5cb85c;
        }

        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="admin.php">Dashboard</a></li>
            <li><a href="cars.php">Cars</a></li>
            <li><a href="Customer.php">Users</a></li>
            <li><a href="#">Reservations</a></li>
            <li><a href="?logout">Logout</a></li>
        </ul>
    </div>
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
                                <th>Status</th>
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

                                    // Add conditional statements to vary colors based on status
                                    $status = $row['Status_'];
                                    if ($status == 'Available') {
                                        echo "<span style='background-color: green; color: white; padding: 5px;'>$status</span>";
                                    } elseif ($status == 'Rented') {
                                        echo "<span style='background-color: orange; color: white; padding: 5px;'>$status</span>";
                                    } elseif ($status == 'Out of Service') {
                                        echo "<span style='background-color: red; color: white; padding: 5px;'>$status</span>";
                                    }

                                    echo "</td>";
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