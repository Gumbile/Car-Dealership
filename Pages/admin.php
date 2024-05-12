<?php
session_start();

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'];

// Check for logout request
if (isset($_GET['logout'])) {
    // Perform logout operation
    $_SESSION['isLoggedIn'] = false;
    session_unset();
    session_destroy();
    header("Location: result.php");
    exit();
}

// Sample data for demonstration
$adminName = isset($_SESSION['adminName']) ? $_SESSION['adminName'] : "Admin";
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
    </style>
</head>
<body>
<?php if ($isLoggedIn): ?>
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Cars</a></li>
            <li><a href="#">Customers</a></li>
            <li><a href="#">Reservations</a></li>
            <li><a href="?logout">Logout</a></li>
        </ul>
    </div>
    <div class="content">
        <h2>Welcome, <?php echo $adminName; ?>!</h2>
        <p>This is your admin panel.</p>
        <!-- Admin panel content goes here -->
    </div>
<?php else: ?>
    <div class="content">
        <h2>Login</h2>
        <form method="post" action="result.php">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            <input type="submit" value="Login">
        </form>
    </div>
<?php endif; ?>
</body>
</html>
