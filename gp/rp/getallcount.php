<?php
// Connect to your database here
include "config.php";

// Fetch sum of prayCounter
$sql = "SELECT SUM(prayCounter) AS total FROM pray_counter1";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$totalPrayCounter = $row['total'];

// Close the database connection
mysqli_close($con);

// Return the total as JSON response
echo json_encode(['total' => $totalPrayCounter]);
?>
