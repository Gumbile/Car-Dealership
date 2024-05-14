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
    <link href="bootstrap-5.0.2-dist/bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">
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

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .search-form {
            margin-bottom: 20px;
        }

        .search-form label {
            font-weight: bold;
        }

        .search-form select,
        .search-form input {
            margin-bottom: 10px;
        }

        .search-results {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link" href="admin.php">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="cars.php">Cars</a></li>
            <li class="nav-item"><a class="nav-link" href="Customer.php">Users</a></li>
            <li class="nav-item"><a class="nav-link" href="reservation.php">Reservations</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Search</a></li>
            <li class="nav-item"><a class="nav-link" href="?logout">Logout</a></li>
        </ul>
    </div>
    <div class="content">
        <h3>Advanced Search</h3>
        <form action="search.php" method="get" id="searchForm" class="search-form">
            <label for="searchType" class="form-label">Search By:</label>
            <select name="searchType" id="searchType" onchange="showFormFields()" class="form-select" required>
                <option value="car">Car</option>
                <option value="user">User</option>
                <option value="reservation">Reservation</option>
            </select>
            <div id="carFields" style="display: none;">
                <label for="carModel" class="form-label">Model:</label>
                <input type="text" name="carModel" id="carModel" class="form-control">
                <label for="carYear" class="form-label">Year:</label>
                <input type="text" name="carYear" id="carYear" class="form-control">
                <label for="carPlateID" class="form-label">Plate ID:</label>
                <input type="text" name="carPlateID" id="carPlateID" class="form-control">
                <label for="carBaseRate" class="form-label">Base Rate:</label>
                <input type="text" name="carBaseRate" id="carBaseRate" class="form-control">
            </div>
            <div id="userFields" style="display: none;">
                <label for="userFirstName" class="form-label">First Name:</label>
                <input type="text" name="userFirstName" id="userFirstName" class="form-control">
                <label for="userLastName" class="form-label">Last Name:</label>
                <input type="text" name="userLastName" id="userLastName" class="form-control">
                <label for="userEmail" class="form-label">Email:</label>
                <input type="text" name="userEmail" id="userEmail" class="form-control">
                <label for="userUsername" class="form-label">Username:</label>
                <input type="text" name="userUsername" id="userUsername" class="form-control">
            </div>
            <div id="reservationFields" style="display: none;">
                <label for="reservationStartDate" class="form-label">Start Date:</label>
                <input type="date" name="reservationStartDate" id="reservationStartDate" class="form-control">
            </div>
            <button class="btn btn-primary" type="submit">Search</button>
        </form>
        <div class="search-results">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['searchType'])) {
                $searchType = $_GET['searchType'];

                $query = "SELECT car.Model, car.Year_, car.PlateID, car.BaseRate, user.FirstName, user.LastName, user.Email, user.Username, reservations.StartDate, reservations.EndDate, locations.LocationName
                      FROM Cars car
                      JOIN Reservations reservations ON car.CarID = reservations.CarID
                      JOIN Users user ON reservations.UserID = user.UserID
                      JOIN Locations locations ON car.LocationID = locations.LocationID
                      WHERE 1=1"; // Always true to start building the WHERE clause

                switch ($searchType) {
                    case 'car':
                        if (!empty($_GET["carModel"])) {
                            $query .= " AND car.Model LIKE '%" . trim($_GET["carModel"]) . "%'";
                        }
                        if (!empty($_GET["carBaseRate"])) {
                            $query .= " AND car.BaseRate = " . trim($_GET["carBaseRate"]);
                        }
                        if (!empty($_GET["carYear"])) {
                            $query .= " AND car.Year_ = " . trim($_GET["carYear"]);
                        }

                        break;

                    case 'user':
                        if (!empty($_GET["userFirstName"])) {
                            $query .= " AND user.FirstName LIKE '%" . trim($_GET["userFirstName"]) . "%'";
                        }
                        if (!empty($_GET["userLastName"])) {
                            $query .= " AND user.LastName LIKE '%" . trim($_GET["userLastName"]) . "%'";
                        }
                        if (!empty($_GET["userEmail"])) {
                            $query .= " AND user.Email LIKE '%" . trim($_GET["userEmail"]) . "%'";
                        }
                        if (!empty($_GET["userUsername"])) {
                            $query .= " AND user.Username LIKE '%" . trim($_GET["userUsername"]) . "%'";
                        }
                        // Add conditions for other user attributes
                        break;

                    case 'reservation':
                        if (!empty($_GET["reservationStartDate"])) {
                            $query .= " AND reservations.StartDate LIKE '%" . trim($_GET["reservationStartDate"]) . "%'";
                        }
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
    </div>
    <script src="bootstrap-5.0.2-dist/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
    <script>
        carFields.style.display = "block";

        function showFormFields() {
            var selectedValue = document.getElementById("searchType").value;
            var carFields = document.getElementById("carFields");
            var userFields = document.getElementById("userFields");
            var reservationFields = document.getElementById("reservationFields");

            carFields.style.display = "none";
            userFields.style.display = "none";
            reservationFields.style.display = "none";

            if (selectedValue === "car") {
                carFields.style.display = "block";
            } else if (selectedValue === "user") {
                userFields.style.display = "block";
            } else if (selectedValue === "reservation") {
                reservationFields.style.display = "block";
            }
        }
    </script>





    </div>

</body>

</html>