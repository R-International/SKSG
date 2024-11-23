<?php
// Establish a MySQL connection
include "config.php"; // Make sure to replace this with your DB connection code


// Query to retrieve data and join tables
$sql = "SELECT pc.phone_number, pc.prayCounter, pc.updated_timestamp, 
u.first_name, u.last_name, u.city, u.state, u.pin_code
FROM pray_counter1 pc
INNER JOIN register u ON pc.phone_number = u.phone_number";

$result = $con->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Close the database connection
$con->close();

// Convert data to JSON format
$jsonData = json_encode($data);

// Output JSON data
header('Content-Type: application/json');
echo $jsonData;
?>
