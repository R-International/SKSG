<?php
if (isset($_FILES['image']) && isset($_COOKIE['phone_number'])) {
    $username = $_COOKIE['phone_number'];
    $uploadDir = 'assets/img/user/';
    $imageName = $username . '.jpeg'; // Change the extension if necessary

    $targetPath = $uploadDir . $imageName;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
        // Image uploaded successfully, update userPic column in register table
        include "config.php"; // Replace with your database connection code

        $phone_number = $_COOKIE['phone_number']; // Replace with your cookie name
        $updateQuery = "UPDATE register SET userPic = ? WHERE phone_number = ?";
        $stmt = $con->prepare($updateQuery);
        $stmt->bind_param("ss", $imageName, $phone_number);
        $stmt->execute();
        $stmt->close();
        $con->close();
        echo json_encode(array("status" => "success", "imagePath" => $targetPath));
    } else {
        echo json_encode(array("status" => "error"));
    }
} else {
    echo json_encode(array("status" => "error"));
}
?>
