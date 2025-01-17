<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="bootstrap-5.0.2-dist/bootstrap-5.0.2-dist/css/bootstrap-grid.min.css" rel="stylesheet">
    <link href="bootstrap-5.0.2-dist/bootstrap-5.0.2-dist//css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <title>Lab2 - Sign up</title>
</head>

<body class="">
    <?php
    $host = 'localhost';
    $username = "root";
    $passwordDB = "";
    $database = 'car_dealership';

    // Create connection
    $conn = new mysqli($host, $username, $passwordDB, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    $hashedPassword = md5($password);

    // Prepare statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND (password = ? or password = ?)");
    $stmt->bind_param("sss", $email, $password, $hashedPassword);

    $stmt->execute();


    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        session_start();
        $_SESSION['user_email'] = $row["Email"];
        $_SESSION['user_id'] = $row["UserID"];
        $_SESSION['FirstName'] = $row["FirstName"];
        $_SESSION['username'] = $row["Username"];
        if ($row["Role_"] == "Admin") {
            $_SESSION['role'] = "Admin";
            header("Location: ../admin.php");
        } else {
            $_SESSION['role'] = "User";
            header("Location: ../user.php");
        }
    } else {
        $message = urlencode("Wrong Email or Password!");
        header("Location: ../Login.php?message={$message}");
        exit();
    }

    $stmt->close();
    $conn->close();

    ?>
</body>

</html>