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
    $secKey = $_POST["secretKey"];
    if (isset($_POST['phone_number'])) {
        $phoneNumber = $_POST['phone_number'];
        // Check if the phone number exists in the database
        $query = "SELECT * FROM register WHERE phone_number = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $phoneNumber);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            echo "<script>
            alert('Phone number already exists, Please Login');
            window.location.href='index.html';
            </script>";
            $con->close();
            //exit();
        } else {
    // Insert data into the 'register' table
    $sql = "INSERT INTO register (first_name, last_name, email, password, phone_number, city, state, pin_code,secret_key)
            VALUES ('$firstName', '$lastName', '$email', '$password', '$phoneNumber', '$city','$state',$pincode,$secKey)";
    
    if ($con->query($sql) === TRUE) {
        // Redirect to login page
        header("Location: index.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
        echo "
        <script>
        alert('Registration Error! Try Again');
        window.location.href='register.html';
        </script>
        ";
    }
    
}
    $con->close();
}
}
?>