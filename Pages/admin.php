<?php
session_start();
include_once('db.php');
// Check if the user is logged in
$isLoggedIn = isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'];

// Check for logout request
if (isset($_GET['logout'])) {
    // Perform logout operation
    $_SESSION['isLoggedIn'] = false;
    session_unset();
    session_destroy();
    header("Location: landing.php");
    exit();
}

// Sample data for demonstration
$adminName = $_SESSION['FirstName'];

// Database connection and other setup code

// Function to retrieve all reservations within a specified period



function getAllReservations($startDate, $endDate)
{
    global $conn;

    $query = "SELECT * FROM Reservations WHERE StartDate >= '$startDate' AND EndDate <= '$endDate'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die('Query failed: ' . mysqli_error($conn));
    }

    $reservations = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $reservations[] = $row;
    }

    return $reservations;
}

function getCarReservations($carID, $startDate, $endDate)
{
    global $conn;

    $query = "SELECT * FROM Reservations WHERE CarID = $carID AND StartDate >= '$startDate' AND EndDate <= '$endDate'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die('Query failed: ' . mysqli_error($conn));
    }

    $reservations = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $reservations[] = $row;
    }

    return $reservations;
}

function getCarsStatus($date)
{
    global $conn;

    $query = "SELECT * FROM Cars c LEFT JOIN Reservations r ON c.CarID = r.CarID WHERE '$date' BETWEEN r.StartDate AND r.EndDate";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die('Query failed: ' . mysqli_error($conn));
    }

    $carsStatus = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $carsStatus[] = $row;
    }

    return $carsStatus;
}

function getCustomerReservations($customerID)
{
    global $conn;

    $query = "SELECT * FROM Reservations r JOIN Users u ON r.UserID = u.UserID WHERE u.UserID = $customerID";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die('Query failed: ' . mysqli_error($conn));
    }

    $customerReservations = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $customerReservations[] = $row;
    }

    return $customerReservations;
}

function getDailyPayments($startDate, $endDate)
{
    global $conn;

    $query = "SELECT * FROM Payments WHERE PaymentDate BETWEEN '$startDate' AND '$endDate'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die('Query failed: ' . mysqli_error($conn));
    }

    $dailyPayments = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $dailyPayments[] = $row;
    }

    return $dailyPayments;
}


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

        .content h3 {
            margin-top: 30px;
        }

        .content ul {
            list-style-type: none;
            padding: 0;
        }

        .content ul li {
            margin-bottom: 20px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }

        .content ul li h4 {
            margin: 0;
        }

        .content ul li p {
            margin: 0;
            color: #888;
        }

        /* New styles for improved presentation */

        .content ul li .reservation-info {
            margin-top: 10px;
        }

        .content ul li .car-info {
            margin-top: 10px;
        }

        .content ul li .payment-info {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="#">Dashboard</a></li>
            <li><a href="cars.php">Cars</a></li>
            <li><a href="Customer.php">Users</a></li>
            <li><a href="reservation.php">Reservations</a></li>
            <li><a href="?logout">Logout</a></li>
        </ul>
    </div>

    <div class="content">
        <h2>Welcome, <?php echo $adminName; ?>!</h2>


        <h3>Reports</h3>
        <ul>
            <li>
                <h4>All Reservations within a Specified Period</h4>
                <div class="reservation-info">
                    <?php
                    // Specify the start date and end date for the report
                    $startDate = '2024-05-01';
                    $endDate = '2024-05-31';

                    // Call the function to retrieve all reservations within the specified period
                    $reservations = getAllReservations($startDate, $endDate);

                    // Display the reservation information
                    foreach ($reservations as $reservation) {
                        echo "Reservation ID: {$reservation['ReservationID']}, Car ID: {$reservation['CarID']}, User ID: {$reservation['UserID']}, Start Date: {$reservation['StartDate']}, End Date: {$reservation['EndDate']}, Pickup Location ID: {$reservation['PickupLocationID']}, Drop-Off Location ID: {$reservation['DropOffLocationID']}, Status: {$reservation['Status_']} <br>";
                    }
                    ?>
                </div>
            </li>
            <li>
                <h4>All Reservations of a Car within a Specified Period</h4>
                <div class="reservation-info">
                    <?php
                    // Specify the car ID, start date, and end date for the report
                    $carID = 1;
                    $startDate = '2024-05-01';
                    $endDate = '2024-05-31';

                    // Call the function to retrieve all reservations of the specified car within the specified period
                    $carReservations = getCarReservations($carID, $startDate, $endDate);

                    // Display the reservation information
                    foreach ($carReservations as $reservation) {
                        echo "Reservation ID: {$reservation['ReservationID']}, Car ID: {$reservation['CarID']}, User ID: {$reservation['UserID']}, Start Date: {$reservation['StartDate']}, End Date: {$reservation['EndDate']}, Pickup Location ID: {$reservation['PickupLocationID']}, Drop-Off Location ID: {$reservation['DropOffLocationID']}, Status: {$reservation['Status_']} <br>";
                    }
                    ?>
                </div>
            </li>
            <li>
                <h4>Status of All Cars on a Specific Day</h4>
                <div class="car-info">
                    <?php
                    // Specify the date for the report
                    $date = '2024-05-13';

                    // Call the function to retrieve the status of all cars on the specified day
                    $carStatus = getCarsStatus($date);

                    // Display the car status
                    foreach ($carStatus as $car) {
                        echo "Car ID: {$car['CarID']}, Model: {$car['Model']}, Year: {$car['Year_']}, Plate ID: {$car['PlateID']}, Status: {$car['Status_']} <br>";
                    }
                    ?>
                </div>
            </li>
            <li>
                <h4>All Reservations of a Specific Customer</h4>
                <div class="reservation-info">
                    <?php
                    // Specify the customer ID for the report
                    $customerID = 1;

                    // Call the function to retrieve all reservations of the specified customer
                    $customerReservations = getCustomerReservations($customerID);

                    // Display the reservation information
                    foreach ($customerReservations as $reservation) {
                        echo "Reservation ID: {$reservation['ReservationID']}, Car ID: {$reservation['CarID']}, User ID: {$reservation['UserID']}, Start Date: {$reservation['StartDate']}, End Date: {$reservation['EndDate']}, Pickup Location ID: {$reservation['PickupLocationID']}, Drop-Off Location ID: {$reservation['DropOffLocationID']}, Status: {$reservation['Status_']} <br>";
                    }
                    ?>
                </div>
            </li>
            <li>
                <h4>Daily Payments within a Specific Period</h4>
                <div class="payment-info">
                    <?php
                    // Specify the start date and end date for the report
                    $startDate = '2024-05-01';
                    $endDate = '2024-05-31';

                    // Call the function to retrieve the daily payments within the specified period
                    $dailyPayments = getDailyPayments($startDate, $endDate);

                    // Display the payment information
                    foreach ($dailyPayments as $payment) {
                        echo "Payment ID: {$payment['PaymentID']}, Reservation ID: {$payment['ReservationID']}, Amount: {$payment['Amount']}, Payment Date: {$payment['PaymentDate']}, Payment Method: {$payment['PaymentMethod']} <br>";
                    }
                    ?>
                </div>
            </li>
        </ul>

    </div>
</body>

</html>