<?php
// Establish a MySQL connection
include "config.php"; // Include your database connection configuration

// Get the GET parameters
$phone_number = $_POST["phone_number"];
$cur_date = $_POST["cur_date"];
$pray_count = $_POST["pray_count"]; // The new pray_count value

// Check if both phone_number and cur_date are provided
if (!empty($phone_number) && !empty($cur_date) && is_numeric($pray_count) && $pray_count<=421) {
    // Sanitize input
    $phone_number = mysqli_real_escape_string($con, $phone_number);
    $cur_date = mysqli_real_escape_string($con, $cur_date);

    // Check if a record exists for the given phone_number and cur_date
    $check_sql = "SELECT * FROM pray_counter WHERE phone_number = '$phone_number' AND cur_date = '$cur_date'";
    $result = mysqli_query($con, $check_sql);

    if (mysqli_num_rows($result) > 0) {
        // Update the existing record
        $update_sql = "UPDATE pray_counter SET prayCounter = $pray_count
                       WHERE phone_number = '$phone_number' AND cur_date = '$cur_date'";
        if (mysqli_query($con, $update_sql)) {
            echo "1"; // Successful update
           header("Location: ../errorPage.html");
        } else {
            echo "Error updating record: " . mysqli_error($con);
        }
    } else {
        // Insert a new record
        $insert_sql = "INSERT INTO pray_counter (phone_number, prayCounter, cur_date)
                       VALUES ('$phone_number',$pray_count, '$cur_date')";
        if (mysqli_query($con, $insert_sql)) {
            echo "1"; // Successful insert
            header("Location: ../errorPage.html");
        } else {
            echo "Error inserting record: " . mysqli_error($con);
        }
    }
} else {
    echo "Invalid input parameters"; // Handle missing or invalid parameters
}

// Close the MySQL connection
mysqli_close($con);
?>
