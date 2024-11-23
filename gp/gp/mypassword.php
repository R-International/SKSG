<?php
include "config.php";
// Assuming you have established a database connection
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phoneNumber = $_POST['phone_number'];
    $secretKey = $_POST['secret_key'];
    $newPassword = $_POST['newpassword'];

    // Validate input
    if (empty($phoneNumber) || !is_numeric($phoneNumber) || empty($secretKey) || !is_numeric($secretKey)) {
        die("Invalid input data.");
    }

    // Hash the new password
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Check if the phone number and secret key match a record in the database
    $sql = "SELECT * FROM register WHERE phone_number = '$phoneNumber' AND secret_key = '$secretKey'";
    $result = $con->query($sql);

    if (!$result) {
        die("Error: " . $con->error);
    }

    if ($result->num_rows === 1) {
        // Update the password
        $updateSql = "UPDATE register SET password = '$hashedPassword' WHERE phone_number = '$phoneNumber' AND secret_key = '$secretKey'";
        $updateResult = $con->query($updateSql);

        if (!$updateResult) {
            die("Error: " . $con->error);
        }

        echo "<script>alert('Password updated successfully');
        location.href='index.html';
        </script>";
        exit();
    } else {
        echo "<script>alert('Phone number and secret key do not match');</script>";
    }

    // Close the database connection
    $con->close();
}
?>
