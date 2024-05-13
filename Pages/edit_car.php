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
    <link href="bootstrap-5.0.2-dist/bootstrap-5.0.2-dist/css/bootstrap-grid.min.css" rel="stylesheet">
    <link href="bootstrap-5.0.2-dist/bootstrap-5.0.2-dist//css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script></script>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="container">
        <h2>Edit Car</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Model:</label>
                <input type="text" class="form-control" name="model" value="<?php echo $car['Model']; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Year:</label>
                <input type="text" class="form-control" name="year" value="<?php echo $car['Year_']; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Plate ID:</label>
                <input type="text" class="form-control" name="plateid" value="<?php echo $car['PlateID']; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Status:</label>
                <select name="status" class="form-select">
                    <option value="Available" <?php echo ($car['Status_'] == 'Available') ? 'selected' : ''; ?>>Available</option>
                    <option value="Out of Service" <?php echo ($car['Status_'] == 'Out of Service') ? 'selected' : ''; ?>>Out of Service</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Base Rate:</label>
                <input type="text" class="form-control" name="baserate" value="<?php echo $car['BaseRate']; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Location ID:</label>
                <input type="text" class="form-control" name="locationid" value="<?php echo $car['LocationID']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>


</html>