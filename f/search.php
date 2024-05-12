<?php
// Assuming you have a database connection established

// Retrieve the search criteria from the URL parameters
$make = $_GET['make'];
$model = $_GET['model'];
$year = $_GET['year'];

// Prepare the SQL query based on the search criteria
$sql = "SELECT * FROM cars WHERE make = '$make' AND model = '$model' AND year = '$year'";

// Execute the query and fetch the results
$result = mysqli_query($connection, $sql);

// Check if any rows were returned
if (mysqli_num_rows($result) > 0) {
  // Loop through the rows and display the car specs
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<p>Make: " . $row['make'] . "</p>";
    echo "<p>Model: " . $row['model'] . "</p>";
    echo "<p>Year: " . $row['year'] . "</p>";
    // Add more car specs here as needed
    echo "<hr>";
  }
} else {
  echo "No cars found matching the search criteria.";
}

// Close the database connection
mysqli_close($connection);
?>