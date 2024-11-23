<?php
// Establish a MySQL connection
include "config.php";

// Get the phone number and current date
$phone_number = $_POST['phone_number']; // Replace with the desired phone number
$cur_date = $_POST['cur_date']; // Get the current date in the format YYYY-MM-DD

// Prepare and execute the SQL statement using prepared statement
$stmt = $con->prepare("SELECT prayCounter FROM pray_counter WHERE phone_number = ? AND cur_date = ?");
$stmt->bind_param("ss", $phone_number, $cur_date);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Data found, fetch the result
    $row = $result->fetch_assoc();
    $prayCounter = $row["prayCounter"];
    echo "$prayCounter";
} else {
    echo "0";
}

// Close the prepared statement and MySQL connection
$stmt->close();
$con->close();
?>

