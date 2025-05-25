<?php
session_start();
include('includes/db.php');

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Check if the candidate ID is passed via the URL
if (isset($_GET['id'])) {
    $candidate_id = $_GET['id'];

    // Delete candidate from the database
    $delete_query = "DELETE FROM candidates WHERE id = '$candidate_id'";
    if (mysqli_query($conn, $delete_query)) {
        header("Location: admin_panel.php");  // Redirect back to the candidates list
        exit();
    } else {
        echo "Error deleting candidate: " . mysqli_error($conn);
    }
} else {
    echo "Invalid candidate ID!";
}
?>
