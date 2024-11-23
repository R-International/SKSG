<?php
include 'config.php';
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $firstName = $_POST["first_name"];
    $lastName = $_POST["last_name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password
    $phoneNumber = $_POST["phone_number"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $pincode = $_POST["pin_code"];


    // Insert data into the 'register' table
    $sql = "INSERT INTO register (first_name, last_name, email, password, phone_number, city, state, pin_code)
            VALUES ('$firstName', '$lastName', '$email', '$password', '$phoneNumber', '$city','$state',$pincode)";
    
    if ($con->query($sql) === TRUE) {
        // Redirect to login page
        header("Location: login.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
    
    $con->close();
}
?>