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
    $username = 'FreePalestine';
    $DBpassword = 'FreePalestine';
    $database = 'registration';

    // Create connection
    $conn = new mysqli($host, $username, $DBpassword, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $name = $conn->real_escape_string($_POST['username']); // Example name
    $email = $conn->real_escape_string($_POST['email']); // Example email
    $password = $conn->real_escape_string($_POST['password']); // Example password, should be securely hashed
    $hashedPassword = md5($password);

    $stmtInsert = $conn->prepare("SELECT * FROM user WHERE email = ?");
    $stmtInsert->bind_param("s", $email);
    $stmtInsert->execute();
    $stmtInsert->store_result();

    if ($stmtInsert->num_rows > 0) {
        $message = urlencode('Email Already Exists');
        header("Location: ../Email.php?message={$message}");
        exit();
    } else {

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO user (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashedPassword);


        if ($stmt->execute()) {
            echo "<h1> Welcome " . $name . "</h1";
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