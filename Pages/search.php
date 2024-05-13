<?php
session_start();
include_once('db.php');
// Check if the user is logged in
$isLoggedIn = isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'];
if ($_SESSION['role'] != "Admin") {
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
?>
<!DOCTYPE html>
<html>

<head>
    <title>Admin Panel</title>
    <link href="bootstrap-5.0.2-dist/bootstrap-5.0.2-dist/css/bootstrap-grid.min.css" rel="stylesheet">
    <link href="bootstrap-5.0.2-dist/bootstrap-5.0.2-dist//css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script></script>
    <link rel="stylesheet" href="../css/style.css">
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
    </style>
</head>

<body>
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="admin.php">Dashboard</a></li>
            <li><a href="cars.php">Cars</a></li>
            <li><a href="Customer.php">Users</a></li>
            <li><a href="reservation.php">Reservations</a></li>
            <li><a href="#">Search</a></li>
            <li><a href="?logout">Logout</a></li>
        </ul>
    </div>
    <div class="content">


        <h3>Advanced Search</h3>
        <form action="" method="get">
            <label for="searchType">Search By:</label>
            <select name="searchType" id="searchType" required>
                <option value="car">Car</option>
                <option value="user">User</option>
                <option value="reservation">Reservation</option>
            </select>
            <br><br>
            <label for="searchTerm">Search Term:</label>
            <input type="text" name="searchTerm" id="searchTerm" required>
            <button class="btn btn-primary" type="submit">Search</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['searchType']) && isset($_GET['searchTerm'])) {
            $searchType = $_GET['searchType'];
            $searchTerm = $_GET['searchTerm'];

            switch ($searchType) {
                case 'car':
                    $query = "SELECT car.Model, car.Year_, car.PlateID, car.BaseRate, user.FirstName, user.LastName, user.Email, user.Username, reservations.StartDate, reservations.EndDate,  locations.LocationName
                              FROM Cars car
                              JOIN Reservations reservations ON car.CarID = reservations.CarID
                              JOIN Users user ON reservations.UserID = user.UserID
                              JOIN Locations locations ON car.LocationID = locations.LocationID
                              WHERE car.Model LIKE '%$searchTerm%'
                              OR car.Year_ LIKE '%$searchTerm%'
                              OR car.PlateID LIKE '%$searchTerm%'
                              OR car.BaseRate LIKE '%$searchTerm%'";
                    break;

                case 'user':
                    $query = "SELECT car.Model, car.Year_, car.PlateID, car.BaseRate, user.FirstName, user.LastName, user.Email, user.Username, reservations.StartDate, reservations.EndDate, locations.LocationName
                              FROM Cars car
                              JOIN Reservations reservations ON car.CarID = reservations.CarID
                              JOIN Users user ON reservations.UserID = user.UserID
                              JOIN Locations locations ON car.LocationID = locations.LocationID
                              WHERE user.FirstName LIKE '%$searchTerm%'
                              OR user.LastName LIKE '%$searchTerm%'
                              OR user.Email LIKE '%$searchTerm%'
                              OR user.Username LIKE '%$searchTerm%'";
                    break;

                case 'reservation':
                    $query = "SELECT car.Model, car.Year_, car.PlateID, car.BaseRate, user.FirstName, user.LastName, user.Email, user.Username, reservations.StartDate, reservations.EndDate,  locations.LocationName
                              FROM Cars car
                              JOIN Reservations reservations ON car.CarID = reservations.CarID
                              JOIN Users user ON reservations.UserID = user.UserID
                              JOIN Locations locations ON car.LocationID = locations.LocationID
                              WHERE reservations.StartDate LIKE '%$searchTerm%'";
                    break;

                default:
                    echo "Invalid search type";
                    break;
            }


            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                echo "<h4>Search Results</h4>";
                echo "<table class='table'>";
                echo "<thead><tr><th>Model</th><th>Year</th><th>Plate ID</th><th>Base Rate</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Username</th><th>Start Date</th><th>End Date</th><th>LocationName</th></tr></thead>";
                echo "<tbody>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['Model']}</td>";
                    echo "<td>{$row['Year_']}</td>";
                    echo "<td>{$row['PlateID']}</td>";
                    echo "<td>{$row['BaseRate']}</td>";
                    echo "<td>{$row['FirstName']}</td>";
                    echo "<td>{$row['LastName']}</td>";
                    echo "<td>{$row['Email']}</td>";
                    echo "<td>{$row['Username']}</td>";
                    echo "<td>{$row['StartDate']}</td>";
                    echo "<td>{$row['EndDate']}</td>";
                    echo "<td>{$row['LocationName']}</td>";
                    echo "</tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<p>No results found.</p>";
            }
        }
        ?>
    </div>

</body>

</html>