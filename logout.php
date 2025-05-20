<?php
session_start();

// Check if the user or admin session is set and unset the session variables
if (isset($_SESSION['user_id'])) {
    unset($_SESSION['user_id']);
    unset($_SESSION['user_name']);
} elseif (isset($_SESSION['admin_id'])) {
    unset($_SESSION['admin_id']);
    unset($_SESSION['admin_username']);
}

// Destroy the session
session_destroy();

// Redirect to the index page after logout
header("Location: index.php");
exit();
?>
