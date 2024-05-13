<?php 
require 'config/db_connect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit;
    }

    // Check if email is already registered
    $checkEmailQuery = "SELECT * FROM Users WHERE Email = '$email'";
    $emailResult = mysqli_query($conn, $checkEmailQuery);
    if (mysqli_num_rows($emailResult) > 0) {
        echo "Email already exists";
        exit;
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert new user into the database
    $insertQuery = "INSERT INTO Users (FirstName, LastName, Email, Username, Password, Role_) 
                    VALUES ('$firstName', '$lastName', '$email', '$username', '$hashedPassword', '$role')";
    if (mysqli_query($conn, $insertQuery)) {
        echo '<div class="alert alert-success" role="alert">User added successfully.</div>';
                echo '<script>
                    setTimeout(function() {
                        window.location.href = "http://localhost/car-dealership/pages/customer.php";
                    }, 1000);
                  </script>';
    } else {
        echo "Error: " . mysqli_error($conn);
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
                <h2 class="text-center">Add New User</h2>
                <form action="/car-dealership/pages/add_user.php" method="post" class="text-center">
                    <div class="form-group" style="margin: 20px;">
                        <input type="text" class="form-control" placeholder="First Name" name="firstName" required>
                    </div>
                    <div class="form-group" style="margin: 20px;">
                        <input type="text" class="form-control" placeholder="Last Name" name="lastName" required>
                    </div>
                    <div class="form-group" style="margin: 20px;">
                        <input type="email" class="form-control" placeholder="Email" name="email" required>
                    </div>
                    <div class="form-group" style="margin: 20px;">
                        <input type="text" class="form-control" placeholder="Username" name="username" required>
                    </div>
                    <div class="form-group" style="margin: 20px;">
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                    </div>
                    <div class="form-group" style="margin: 20px;">
                        <label for="role">Role:</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="role" id="user" value="User" checked>
                            <label class="form-check-label" for="user">User</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="role" id="admin" value="Admin">
                            <label class="form-check-label" for="admin">Admin</label>
                        </div>
                    </div>
                    <div class="form-group" style="margin: 20px;">
                        <button type="submit" class="btn btn-primary">Add User</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>
</html>