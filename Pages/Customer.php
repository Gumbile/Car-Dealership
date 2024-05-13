<?php
session_start();
include_once ('db.php');

// Your admin panel code here
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
            margin-left: 270px;
            padding: 20px;
        }

        /* Add these styles to your existing CSS */

        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Button styles */
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .btn-primary {
            background-color: #337ab7;
        }

        .btn-danger {
            background-color: #d9534f;
        }

        .btn-success {
            background-color: #5cb85c;
        }

        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="admin.php">Dashboard</a></li>
            <li><a href="cars.php">Cars</a></li>
            <li><a href="#">Users</a></li>
            <li><a href="reservation.php">Reservations</a></li>
            <li><a href="?logout">Logout</a></li>
        </ul>
    </div>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h3>All Users</h3>
                    <div>
                        <a class="btn btn-primary" href="add_user.php">Add New User</a>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Actions</th> <!-- Added column for actions -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Assume $conn is your database connection
                            $query = "SELECT * FROM users";
                            $result = mysqli_query($conn, $query);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>{$row['FirstName']}</td>";
                                    echo "<td>{$row['LastName']}</td>";
                                    echo "<td>{$row['Email']}</td>";
                                    echo "<td>{$row['Username']}</td>";
                            
                                    echo "<td>{$row['Role_']}</td>";
                                    echo "<td>";

                                    echo "<a class='btn btn-success' href='edit_user.php?id={$row['UserID']}'>Update</a>";
                                    echo "<a class='btn btn-danger' href='delete_user.php?id={$row['UserID']}'>Delete</a>";

                                    echo "</td>"; // Added action buttons
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6'>No customers found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>