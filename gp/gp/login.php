<?php
include 'config.php';
session_start();
    // Collect form data
    $phoneNumber = $_POST["phone_number"];
    $password = $_POST["password"];    
    // Retrieve user data based on phone number
    $sql = "SELECT * FROM register WHERE phone_number='$phoneNumber'";
    $result = $con->query($sql);
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            // Password is correct, redirect to index.html
            $_SESSION["phone_number"] = $row["phone_number"]; 
            // Set the cookie with the phone number value
            $cookie_name = "phone_number";
            $cookie_value = $phoneNumber;
            $cookie_expiry = time() + (86400 * 1); // Cookie expires in 30 days
            // Set the cookie
            setcookie($cookie_name, $cookie_value, $cookie_expiry, "/"); // "/" means the cookie is available across the entire website
            header("Location: ../menu.html");
            exit();
        } else {
            $login_error = "Invalid phone number or password";
            echo "
            <script>
            alert('$login_error');
            window.location.href='../index.html';
            </script>
            ";
        }
    } else {
        $login_error = "Invalid phone number or password";
        echo "
        <script>
        alert('$login_error');
        window.location.href='../index.html';
        </script>
        ";
    }
    
    $con->close();

?>