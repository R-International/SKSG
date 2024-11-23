<?php
// Establish a MySQL connection
include "config.php"; // You need to create this file with your DB connection details

// Get data from AJAX request
$welcome = $_POST['welcome'];
$agenda = $_POST['agenda'];
$notice = $_POST['notice'];

// Prepare and execute the SQL statement
$sql = "INSERT INTO home_page1 (welcome, agenda, notice) VALUES ('$welcome', '$agenda', '$notice')";
if ($con->query($sql) === TRUE) {
    echo "Data stored successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the MySQL connection
$con->close();
?>