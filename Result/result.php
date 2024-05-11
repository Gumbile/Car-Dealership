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
    $username = 'FreePalestine';
    $passwordDB = 'FreePalestine';
    $database = 'registration';

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
    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $hashedPassword);

    $stmt->execute();


    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<h1> Welcome " . $row["name"] . "</h1";
    } else {
        $message = urlencode("Wrong Email or Password!");
        header("Location: ../Log-In Page/Login.php?message={$message}");
        exit();
    }

    $stmt->close();
    $conn->close();

    ?>
</body>

</html>