<?php
// Set connection variables
    $servername = "localhost";
    $username = "gproot001";
    $password = "mysql";
    $db_name = "gp_data";

    // Create a database connection
    $con = mysqli_connect($servername, $username, $password, $db_name);

    // Check for connection success
    if (!$con) {
        die("connection failed" . mysqli_connect_error());
    }
?>