<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="../bootstrap-5.0.2-dist/bootstrap-5.0.2-dist/css/bootstrap-grid.min.css" rel="stylesheet">
    <link href="../bootstrap-5.0.2-dist/bootstrap-5.0.2-dist//css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <title>Lab2 - Sign up</title>
</head>

<body class="">
    <?php
    $host = 'localhost';
    $username = 'root';
    $DBpassword = '';
    $database = 'car_dealership';

    // Create connection
    $conn = new mysqli($host, $username, $DBpassword, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $name = $conn->real_escape_string($_POST['username']); // Example name
    $email = $conn->real_escape_string($_POST['email']); // Example email
    $password = $conn->real_escape_string($_POST['password']); // Example password, should be securely hashed
    $fname = $conn->real_escape_string($_POST['fname']);
    $lname = $conn->real_escape_string($_POST['lname']);
    $hashedPassword = md5($password);

    $stmtInsert = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmtInsert->bind_param("s", $email);
    $stmtInsert->execute();
    $stmtInsert->store_result();
    if ($stmtInsert->num_rows > 0) {
        $message = urlencode('Email Already Exists');
        header("Location: ../Email.php?message={$message}");
        exit();
    } else {

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, FirstName, LastName) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $email, $hashedPassword, $fname, $lname);


        if ($stmt->execute()) {
            $message = urlencode('Successful');
            session_start();
            $_SESSION['user_email'] = $email;
            $_SESSION['user_id'] = 0;
            $_SESSION['FirstName'] = $fname;
            $_SESSION['username'] = $lname;
            header("Location: ../user.php");
            
        } else {
            $message = urlencode('An Error has occurred');
            header("Location: ../Email.php?message={$message}");
            exit();
        }

        $stmt->close();
    }
    $stmtInsert->close();
    $conn->close();
    ?>
</body>

</html>