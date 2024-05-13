<?php
session_start();
include_once('db.php');
// Check if the user is logged in
$isLoggedIn = isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'];
if($_SESSION['role'] != "Admin"){
    header("Location: http://localhost/Car-Dealership/pages/user.php");
}
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


// make it natural join with cars and user
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
            background-color: #f4f4f4;
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

        input[type="text"],
        input[type="date"],
        select {
            padding: 8px;
            margin: 5px 0 20px;
            display: block;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 95%;
        }

        .button {
            background-color: #4CAF50;
            /* Green */
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        .button:hover {
            background-color: #45a049;
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
                <form action="" method="post">
                    <input type="date" name="startDate1" required>
                    <input type="date" name="endDate1" required>
                    <button class="button" type="submit">Fetch Report</button>
                </form>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['startDate1']) && isset($_POST['endDate1']) && !empty($_POST['startDate1'])) {
                    // Process the form submission and generate the report
                    $startDate = $_POST['startDate'];
                    $endDate = $_POST['endDate'];
                    $reservations = getAllReservations($startDate, $endDate);
                
                    // Display the report
                    echo "<div>";
                    foreach ($reservations as $reservation) {
                        echo "Reservation ID: {$reservation['ReservationID']}, Car ID: {$reservation['CarID']}, User ID: {$reservation['UserID']}, Start Date: {$reservation['StartDate']}, End Date: {$reservation['EndDate']}, Pickup Location ID: {$reservation['PickupLocationID']}, Drop-Off Location ID: {$reservation['DropOffLocationID']} <br>";
                    }
                    echo "</div>";
                    // echo "<meta http-equiv='refresh' content='0'>";
                } else {
                    // Display an empty div
                    echo "<div></div>";
                }
                $_SESSION["rand"] = rand();
                ?>
            </li>
            <li>
                <h4>All Reservations of a Car within a Specified Period</h4>
                <form action="" method="post">
                    <input type="text" name="carID" placeholder="Enter Car ID" required>
                    <input type="date" name="startDate" required>
                    <input type="date" name="endDate" required>
                    <button class="button" type="submit">Fetch Report</button>
                </form>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['carID']) && isset($_POST['startDate']) && isset($_POST['endDate'])) {
                    // Process the form submission and generate the report
                    $carID = $_POST['carID'];
                    $startDate = $_POST['startDate'];
                    $endDate = $_POST['endDate'];
                    $carReservations = getCarReservations($carID, $startDate, $endDate);

                    // Display the report
                    echo "<div>";
                    foreach ($carReservations as $reservation) {
                        echo "Reservation ID: {$reservation['ReservationID']}, Car ID: {$reservation['CarID']}, User ID: {$reservation['UserID']}, Start Date: {$reservation['StartDate']}, End Date: {$reservation['EndDate']}, Pickup Location ID: {$reservation['PickupLocationID']}, Drop-Off Location ID: {$reservation['DropOffLocationID']} <br>";
                    }
                    echo "</div>";
                }
                ?>
            </li>
            <li>
                <h4>Status of All Cars on a Specific Day</h4>
                <form action="" method="post">
                    <input type="date" name="date" required>
                    <button class="button" type="submit">Fetch Report</button>
                </form>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['date'])) {
                    // Process the form submission and generate the report
                    $date = $_POST['date'];
                    $carsStatus = getCarsStatus($date);

                    // Display the report
                    echo "<div>";
                    foreach ($carsStatus as $car) {
                        echo "Car ID: {$car['CarID']}, Model: {$car['Model']}, Year: {$car['Year_']}, Plate ID: {$car['PlateID']}, Status: {$car['Status_']} <br>";
                    }
                    echo "</div>";
                }
                ?>
            </li>
            <li>
                <h4>All Reservations of a Specific Customer</h4>
                <form action="" method="post">
                    <input type="text" name="customerID" placeholder="Enter Customer ID" required>
                    <button class="button" type="submit">Fetch Report</button>
                </form>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['customerID'])) {
                    // Process the form submission and generate the report
                    $customerID = $_POST['customerID'];
                    $customerReservations = getCustomerReservations($customerID);

                    // Display the report
                    echo "<div>";
                    foreach ($customerReservations as $reservation) {
                        echo "Reservation ID: {$reservation['ReservationID']}, Car ID: {$reservation['CarID']}, User ID: {$reservation['UserID']}, Start Date: {$reservation['StartDate']}, End Date: {$reservation['EndDate']}, Pickup Location ID: {$reservation['PickupLocationID']}, Drop-Off Location ID: {$reservation['DropOffLocationID']} <br>";
                    }
                    echo "</div>";
                }
                ?>
            </li>
            <li>
                <h4>Daily Payments within a Specific Period</h4>
                <form action="" method="post">
                    <input type="date" name="startDate" required>
                    <input type="date" name="endDate" required>
                    <button class="button" type="submit">Fetch Report</button>
                </form>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['startDate']) && isset($_POST['endDate'])) {
                    // Process the form submission and generate the report
                    $startDate = $_POST['startDate'];
                    $endDate = $_POST['endDate'];
                    $dailyPayments = getDailyPayments($startDate, $endDate);

                    // Display the report
                    echo "<div>";
                    foreach ($dailyPayments as $payment) {
                        echo "Payment ID: {$payment['PaymentID']}, Reservation ID: {$payment['ReservationID']}, Amount: {$payment['Amount']}, Payment Date: {$payment['PaymentDate']}, Payment Method: {$payment['PaymentMethod']} <br>";
                    }
                    echo "</div>";
                }
                ?>
            </li>
        </ul>
    </div>
    <script>
        if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
        }
    </script>
    </body>
</html>