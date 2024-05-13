<?php
    require 'config/db_connect.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $model = $_POST['model'];
        $year = $_POST['year'];
        $plateID = $_POST['plateID'];
        $status = $_POST['status'];
        $baseRate = $_POST['baseRate'];
        $locationID = $_POST['locationID'];
    
        $errors = [];
    
        // Check if the plate ID is unique
        $plateQuery = "SELECT * FROM Cars WHERE PlateID = '$plateID'";
        $plateResult = mysqli_query($conn, $plateQuery);
    
        if (mysqli_num_rows($plateResult) > 0) {
            $errors[] = "Plate ID '$plateID' is already in use.";
        }
    
        // Validate the year format
        if (!preg_match('/^\d{4}$/', $year)) {
            $errors[] = "Invalid year format. Please enter a 4-digit year.";
        }
    
        // Display errors
        if (!empty($errors)) {
            echo '<div class="alert alert-danger" role="alert">';
            foreach ($errors as $error) {
                echo $error . '<br>';
            }
            echo '</div>';
        } else {
            // Insert the new car into the Cars table
            $query = "INSERT INTO Cars (Model, Year_, PlateID, Status_, BaseRate, LocationID) VALUES ('$model', $year, '$plateID', '$status', $baseRate, $locationID)";
            $result = mysqli_query($conn, $query);
    
            if ($result) {
                echo '<div class="alert alert-success" role="alert">Car added successfully.</div>';
                echo '<script>
                    setTimeout(function() {
                        window.location.href = "http://localhost/car-dealership/pages/cars.php";
                    }, 1000); // 3000 milliseconds = 3 seconds
                  </script>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Error adding car: ' . mysqli_error($conn) . '</div>';
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    
</head>
<body>
    <?php include("templates/header.php");?>
    <link href="bootstrap-5.0.2-dist/bootstrap-5.0.2-dist/css/bootstrap-grid.min.css" rel="stylesheet">
    <link href="bootstrap-5.0.2-dist/bootstrap-5.0.2-dist//css/bootstrap.min.css" rel="stylesheet">
    <script src="http://localhost/Car-Dealership/js/login.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center">Add New Car</h2>
                <form action="/car-dealership/pages/add_car.php" method="post" class="text-center">
                    <div class="form-group" style="margin: 20px;">
                        <input type="text" class="form-control" placeholder="Model" name="model" required>
                    </div>
                    <div class="form-group" style="margin: 20px;">
                        <input type="number" class="form-control" placeholder="Year" name="year" required>
                    </div>
                    <div class="form-group" style="margin: 20px;">
                        <input type="text" class="form-control" placeholder="Plate ID" name="plateID" required>
                    </div>
                    <div class="form-group" style="margin: 20px;">
                        <label for="status">Status:</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="available" value="Available" checked>
                            <label class="form-check-label" for="available">Available</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="out-of-service" value="Out of Service">
                            <label class="form-check-label" for="out-of-service">Out of Service</label>
                        </div>
                    </div>
                    <div class="form-group" style="margin: 20px;">
                        <input type="number" class="form-control" step="0.01" placeholder="Base Rate" name="baseRate" required>
                    </div>
                    <div class="form-group" style="margin: 20px;">
                        <label for="location">Location:</label>
                        <select class="form-control" id="location" name="locationID">
                            <?php
                            // Assume $conn is your database connection
                            $query = "SELECT LocationID, LocationName FROM Locations";
                            $result = mysqli_query($conn, $query);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='{$row['LocationID']}'>{$row['LocationName']}</option>";
                                }
                            } else {
                                echo "<option value=''>No locations found</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group" style="margin: 20px;">
                        <button type="submit" class="btn btn-primary">Add Car</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>
</html>