<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserve Car</title>
    <link rel="stylesheet" href="bootstrap5/css/bootstrap.min.css">
</head>
<body>
    <?php include("templates/header.php");?>
    <div class="container">
        <h2>Reserve Car</h2>
        <?php
        if(isset($_GET['model']) && isset($_GET['year']) && isset($_GET['plateID']) && isset($_GET['baseRate']) && isset($_GET['location']) && isset($_GET['status'])) {
            echo "<p><strong>Model:</strong> ".$_GET['model']."</p>";
            echo "<p><strong>Year:</strong> ".$_GET['year']."</p>";
            echo "<p><strong>Plate ID:</strong> ".$_GET['plateID']."</p>";
            echo "<p><strong>Base Rate:</strong> ".$_GET['baseRate']."</p>";
            echo "<p><strong>Location:</strong> ".$_GET['location']."</p>";
            echo "<p><strong>Status:</strong> ".$_GET['status']."</p>";

            // Connect to your database
            require 'config/db_connect.php';

            // Query to get CarID and LocationID
            $plateID = $_GET['plateID'];
            $car_query = "SELECT CarID, LocationID FROM Cars WHERE PlateID = '$plateID'";
            $car_result = $conn->query($car_query);

            if ($car_result->num_rows > 0) {
                $car_row = $car_result->fetch_assoc();
                $carID = $car_row['CarID'];
                $locationID = $car_row['LocationID'];
            } else {
                echo "<p>Error: Car not found.</p>";
                exit(); // Exit if car not found
            }
            ?>
            <form method="POST" action="reserve_submit.php">
            <input type="hidden" name="carID" value="<?php echo $carID; ?>">
                <input type="hidden" name="locationID" value="<?php echo $locationID; ?>">
                <div class="mb-3">
                    <label for="startDate" class="form-label">Pick-up Date</label>
                    <input type="date" class="form-control" id="startDate" name="startDate" required>
                </div>
                <div class="mb-3">
                    <label for="endDate" class="form-label">Drop-off Date</label>
                    <input type="date" class="form-control" id="endDate" name="endDate" required onchange="calculateTotal()">
                </div>
                <div class="mb-3">
                    <label for="totalAmount" class="form-label">Total Amount</label>
                    <input type="text" class="form-control" id="totalAmount" name="totalAmount" readonly>
                </div>
                <div class="mb-3">
                    <label for="dropoffLocation" class="form-label">Drop-off Location</label>
                    <select class="form-control" id="dropoffLocation" name="dropoffLocationID" required>
                        <?php
                        // Query to get all locations
                        $locations_query = "SELECT LocationID, LocationName FROM Locations";
                        $locations_result = $conn->query($locations_query);

                        if ($locations_result->num_rows > 0) {
                            while($location_row = $locations_result->fetch_assoc()) {
                                echo "<option value='".$location_row['LocationID']."'>".$location_row['LocationName']."</option>";
                            }
                        } else {
                            echo "<option>Error: No locations found.</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="paymentMethod" class="form-label">Payment Method</label>
                    <select class="form-control" id="paymentMethod" name="paymentMethod" required>
                        <option value="creditCard">Credit Card</option>
                        <option value="paypal">PayPal</option>
                        <option value="debitCard">Debit Card</option>
                        <option value="cash">Cash</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit Reservation</button>
            </form>
            <script>
                function calculateTotal() {
                    var startDate = new Date(document.getElementById('startDate').value);
                    var endDate = new Date(document.getElementById('endDate').value);
                    var baseRate = <?php echo $_GET['baseRate']; ?>;
                    var days = (endDate - startDate) / (1000 * 60 * 60 * 24);
                    document.getElementById('totalAmount').value = days * baseRate;
                }
            </script>
            <?php
        } else {
            echo "<p>Invalid request. Please go back and try again.</p>";
        }
        ?>
    </div>
</body>
</html>




