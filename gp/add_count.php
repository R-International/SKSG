<?php
// Establish a MySQL connection
include "config.php";

// Get the POST parameters
$phone_number = $_POST["phone_number"];
$pray_count = $_POST["pray_count"];
$cur_date = $_POST["cur_date"];
$cur_datetime = $_POST["cur_datetime"];

// Step 1: Select prayCounter and cur_date from the last row of pray_counter based on phone_number
$select_sql = "SELECT prayCounter, cur_date FROM pray_counter WHERE phone_number = '$phone_number' ORDER BY serial DESC LIMIT 1";
$result = $con->query($select_sql);

if ($result->num_rows > 0) {
    // Record found, get the data
    $row = $result->fetch_assoc();
    $existing_prayCounter = $row["prayCounter"];
    $existing_cur_date = $row["cur_date"];
    // Step 2: Compare cur_date with $cur_date
    if ($existing_cur_date == $cur_date) {
        if($existing_prayCounter>=421){
            echo '421';
        }
        else{
        // cur_date matches, update prayCounter
        $update_sql = "UPDATE pray_counter SET prayCounter = $pray_count WHERE phone_number = '$phone_number' AND cur_date = '$cur_date'";
        
        if ($con->query($update_sql) === TRUE) {
            echo "1";
        } else {
            echo "Error updating record: " . $con->error;
        }
    }
    } else {
        // cur_date does not match, subtract prayCounter - $pray_count and insert a new record
        $new_prayCounter =$pray_count - $existing_prayCounter;
        if($new_prayCounter<=0){
            $new_prayCounter=$pray_count;
        }
        $insert_sql = "INSERT INTO pray_counter (phone_number, prayCounter, cur_date, updated_timestamp) 
                       VALUES ('$phone_number', $new_prayCounter, '$cur_date', '$cur_datetime')";

        if ($con->query($insert_sql) === TRUE) {
            echo "1";
        } else {
            echo "Error inserting record: " . $con->error;
        }
    }
}
else {
    // No record found, insert a new record
    $insert_sql = "INSERT INTO pray_counter (phone_number, prayCounter, cur_date, updated_timestamp) 
                   VALUES ('$phone_number', $pray_count, '$cur_date', '$cur_datetime')";

    if ($con->query($insert_sql) === TRUE) {
        echo "1";
    } else {
        echo "Error inserting record: " . $con->error;
    }
}

// Close the MySQL connection
$con->close();
?>
