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

                <h3>All Cars</h3>
                
                <a href="http://localhost/Car-Dealership/pages/add_car.php" class="btn btn-success mb-3">Add New Car</a>
                <table class="table table-striped">
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
                                    echo "<span class='badge bg-success'>$status</span>";
                                } elseif ($status == 'Rented') {
                                    echo "<span class='badge bg-warning text-dark'>$status</span>";
                                } elseif ($status == 'Out of Service') {
                                    echo "<span class='badge bg-danger'>$status</span>";
                                }
                        
                                echo "</td>";
                                echo "<td>{$row['BaseRate']}</td>";
                                echo "<td>{$row['LocationName']}</td>";
                                echo "<td>";
                        
                                // Check if the car is not reserved
                                if ($status != 'Rented') {
                                    echo "<a href='edit_car.php?carid={$row['CarID']}' class='btn btn-primary'>Update</a>";
                                    echo "<button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#confirmDeleteModal' data-carid='{$row['CarID']}'>Delete</button>";
                                }
                        
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='8'>No cars found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this car?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
            </div>
        </div>
    </div>
</div>
<script>
    // JavaScript to handle deletion
    document.addEventListener('DOMContentLoaded', function () {
        var confirmDeleteModal = document.getElementById('confirmDeleteModal');
        confirmDeleteModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var carID = button.getAttribute('data-carid');
            var confirmDeleteButton = confirmDeleteModal.querySelector('#confirmDeleteButton');
            confirmDeleteButton.addEventListener('click', function () {
                // Perform deletion
                window.location.href = 'delete_car.php?carid=' + carID;
            });
        });
    });
</script>

</body>

</html>