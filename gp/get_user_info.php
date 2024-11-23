<?php
// Establish a MySQL connection
include "config.php"; // You need to create this file with your DB connection details
// Fetch all data from the register table
$sql = "SELECT * FROM register";
$result = $con->query($sql);
$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Close the MySQL connection
$con->close();

// Output data in JSON format
header('Content-Type: application/json');
echo json_encode($data);
?>
