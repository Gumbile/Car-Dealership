<?php
// Assume $conn is your database connection
require 'config/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userID = $_POST['userID'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $role = $_POST['role'];

    $sql = "UPDATE users SET FirstName=?, LastName=?, Email=?, Username=?, Role_=? WHERE UserID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $firstName, $lastName, $email, $username, $role, $userID);

    if ($stmt->execute()) {
        // User updated successfully
        header("Location: customer.php");
        exit();
    } else {
        // Failed to update user
        echo "Error: " . $conn->error;
    }
} else {
    // Invalid request method
    echo "Invalid request method";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Edit User</h2>
        <?php
        // Assume $conn is your database connection
        if (isset($_GET['id'])) {
            $userID = $_GET['id'];
            $query = "SELECT * FROM users WHERE UserID = $userID";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);
        ?>
                <form action="edit_user.php" method="post">
                    <input type="hidden" name="userID" value="<?php echo $user['UserID']; ?>">
                    <div class="form-group">
                        <label for="firstName">First Name:</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $user['FirstName']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name:</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $user['LastName']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['Email']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['Username']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="role">Role:</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="userRole" name="role" value="User" <?php echo ($user['Role_'] == 'User') ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="userRole">User</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="adminRole" name="role" value="Admin" <?php echo ($user['Role_'] == 'Admin') ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="adminRole">Admin</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
        <?php
            } else {
                echo "User not found.";
            }
        } else {
            echo "User ID not provided.";
        }
        ?>
    </div>
</body>

</html>
