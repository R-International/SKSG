<?php
// Start the session
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Clear cookies
$cookie_names = array("phone_number", "other_cookie"); // Add more cookie names if needed
foreach ($cookie_names as $cookie_name) {
    if (isset($_COOKIE[$cookie_name])) {
        setcookie($cookie_name, "", time() - 3600, "/");
    }
}

// Redirect to index.html
header("Location: ../index.html");
exit;
?>
