<?php
session_start();
include_once ('db.php');

if (isset($_GET['carid'])) {
    $carID = $_GET['carid'];

    // Retrieve car information based on CarID
    $query = "SELECT * FROM Cars WHERE CarID = $carID";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $car = mysqli_fetch_assoc($result);
    } else {
        echo "Car not found.";
        exit();
    }
} else {
    echo "Car ID not provided.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process the form data
    // For example, update the car information in the database
    $model = $_POST['model'];
    $year = $_POST['year'];
    $plateID = $_POST['plateid'];
    $status = $_POST['status'];
    $baseRate = $_POST['baserate'];
    $locationID = $_POST['locationid'];

    $updateQuery = "UPDATE Cars SET Model = '$model', Year_ = '$year', PlateID = '$plateID', Status_ = '$status', BaseRate = '$baseRate', LocationID = '$locationID' WHERE CarID = $carID";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        echo "<script>alert('Car updated successfully'); window.location.href = 'cars.php';</script>";
    } else {
        echo "Error updating car: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Car</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            margin: 20px;
        }

        h2 {
            margin-bottom: 20px;
        }

        form {
            width: 50%;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"] {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #337ab7;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        /* Buttons */
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
    <h2>Edit Car</h2>
    <form method="POST">
        <label>Model:</label><br>
        <input type="text" name="model" value="<?php echo $car['Model']; ?>"><br><br>
        <label>Year:</label><br>
        <input type="text" name="year" value="<?php echo $car['Year_']; ?>"><br><br>
        <label>Plate ID:</label><br>
        <input type="text" name="plateid" value="<?php echo $car['PlateID']; ?>"><br><br>
        <label>Status:</label><br>
        <select name="status" class="form-control">
            <option value="Available" <?php echo ($car['Status_'] == 'Available') ? 'selected' : ''; ?>>Available</option>
            <option value="Rented" <?php echo ($car['Status_'] == 'Rented') ? 'selected' : ''; ?>>Rented</option>
            <option value="Out of Service" <?php echo ($car['Status_'] == 'Out of Service') ? 'selected' : ''; ?>>Out of
                Service</option>
        </select><br><br>
        <label>Base Rate:</label><br>
        <input type="text" name="baserate" value="<?php echo $car['BaseRate']; ?>"><br><br>
        <label>Location ID:</label><br>
        <input type="text" name="locationid" value="<?php echo $car['LocationID']; ?>"><br><br>
        <input type="submit" value="Update">
    </form>
</body>

</html>