<?php

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    $userID = $_SESSION['user_id'];
    // echo $userID;
    // Get form data

    $carID = $_POST['carID'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $pickupLocationID = $_POST['locationID'];
    $dropoffLocationID = $_POST['dropoffLocationID'];
    $paymentMethod = $_POST['paymentMethod'];
    $amountPaid = $_POST['totalAmount'];


    // Connect to your database
    require 'config/db_connect.php';

    // Check if dropoffLocationID exists in Locations table
    $location_query = "SELECT LocationID FROM Locations WHERE LocationID = $dropoffLocationID";
    $location_result = $conn->query($location_query);

    if ($location_result->num_rows == 0) {
        echo "Error: Drop-off location ID does not exist.";
        exit(); // Exit if drop-off location ID does not exist
    }

    // Insert reservation into Reservations table
    $reservation_query = "INSERT INTO Reservations (CarID, UserID, StartDate, EndDate, PickupLocationID, DropOffLocationID, Status_) VALUES ($carID, $userID, '$startDate', '$endDate', '$pickupLocationID', '$dropoffLocationID', 'Active')";
    ;
    if ($conn->query($reservation_query) === TRUE) {
        $reservationID = $conn->insert_id;
        $paymentDate = date('Y-m-d');  // Current date as payment date
        echo "Payment Date: $paymentDate";
        $insert_payment_query = "INSERT INTO Payments (ReservationID, Amount, PaymentDate, PaymentMethod) VALUES ($reservationID, $amountPaid, '$paymentDate', '$paymentMethod')";

        $conn->query($insert_payment_query);
        // Update car status to 'Rented' in Cars table
        $update_car_query = "UPDATE Cars SET Status_ = 'Rented' WHERE CarID = '$carID'";
        if ($conn->query($update_car_query) === TRUE) {

            // Commit transaction
            $conn->commit();
            // Success message and redirect
            echo "<script type='text/javascript'>
                    alert('Reservation successfully created.');
                    window.location.href = 'user.php';
                </script>";
        } else {
            echo "Error updating car status: " . $conn->error;
        }
    } else {
        echo "Error creating reservation: " . $conn->error;
    }

    // Close database connection
    $conn->close();
} else {
    echo "Invalid request.";
}
?>