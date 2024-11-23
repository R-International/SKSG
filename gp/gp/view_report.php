<?php
// Establish a MySQL connection
include "config.php";

// Get the phone number from the GET request
$phone_number = $_GET['phoneNumber']; // Make sure you sanitize this input

// Prepare and execute the SQL statement using prepared statement
$stmt = $con->prepare("SELECT * FROM pray_counter WHERE phone_number = ?");
$stmt->bind_param("s", $phone_number);
$stmt->execute();
$result = $stmt->get_result();

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Close the prepared statement
$stmt->close();

// Close the MySQL connection
$con->close();

// Output data in JSON format
header('Content-Type: application/json');
echo json_encode($data);
?>
