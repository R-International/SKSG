<?php
include 'config.php';

session_start();
    // Collect form data
    $phoneNumber = $_POST["number"];
    $password = $_POST["password"];    
    // Retrieve user data based on phone number
    $sql = "SELECT * FROM register WHERE phone_number='$phoneNumber'";
    $result = $con->query($sql);
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            // Password is correct, redirect to index.html
            $_SESSION["phone_number"] = $row["phone_number"]; 
            header("Location: index.html");
            exit();
        } else {
            $login_error = "Invalid phone number or password";
        }
    } else {
        $login_error = "Invalid phone number or password";
    }
    
    $con->close();

?>