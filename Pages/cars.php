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

        .search-form {
            margin-bottom: 20px;
        }

        .search-form input[type="text"] {
            padding: 5px;
            width: 200px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .search-form input[type="submit"] {
            padding: 5px 10px;
            background-color: #337ab7;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="admin.php">Dashboard</a></li>
            <li><a href="#">Cars</a></li>
            <li><a href="Customer.php">Users</a></li>
            <li><a href="reservation.php">Reservations</a></li>
            <li><a href="?logout">Logout</a></li>
        </ul>
    </div>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col">

                    <h3>All Cars</h3>
                    <form class="search-form" method="GET">
                        <input type="text" name="search" placeholder="Search...">
                        <input type="submit" value="Search">
                    </form>
                    <a href="#" class="btn btn-success mb-3">Add New Car</a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>CarID</th>
                                <th>Model</th>
                                <th>Year</th>
                                <th>Plate ID</th>
                                <th>Status</th>
                                <th>Base Rate</th>
                                <th>Location Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Assume $conn is your database connection
                            $query = "SELECT Cars.CarID,Cars.Model, Cars.Year_, Cars.PlateID, Cars.Status_, Cars.BaseRate, Locations.LocationName FROM Cars NATURAL JOIN Locations";
                            $result = mysqli_query($conn, $query);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>{$row['CarID']}</td>";
                                    echo "<td>{$row['Model']}</td>";
                                    echo "<td>{$row['Year_']}</td>";
                                    echo "<td>{$row['PlateID']}</td>";
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
                                    echo "<td>{$row['BaseRate']}</td>";
                                    echo "<td>{$row['LocationName']}</td>";
                                    echo "<td>";
                                    echo "<a href='edit_car.php?carid={$row['CarID']}' class='btn btn-primary'>Update</a>";
                                    echo "<a href='delete_car.php?carid={$row['CarID']}' class='btn btn-danger'>Delete</a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='7'>No cars found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

</html>