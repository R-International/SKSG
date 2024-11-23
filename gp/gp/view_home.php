<?php
// Establish a MySQL connection
include "config.php"; // You need to create this file with your DB connection details

// Fetch data from the home_page table
$sql = "SELECT welcome, agenda, notice FROM home_page ORDER BY serial desc LIMIT 1";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $data = array(
        "welcome" => $row["welcome"],
        "agenda" => $row["agenda"],
        "notice" => $row["notice"]
    );

    // Convert the data array to JSON and output it
    echo json_encode($data);
} else {
    $data = array(
        "welcome" =>"",
        "agenda" => "",
        "notice" => ""
    );
    echo json_encode($data);
}

// Close the MySQL connection
$con->close();
?>
