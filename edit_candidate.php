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

    // Fetch candidate data from the database
    $query = "SELECT * FROM candidates WHERE id = '$candidate_id'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $candidate = mysqli_fetch_assoc($result);
    } else {
        echo "Candidate not found!";
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get new candidate data from form
    $name = mysqli_real_escape_string($conn, $_POST['name']);

    // Update candidate in the database
    $update_query = "UPDATE candidates SET name = '$name' WHERE id = '$candidate_id'";
    if (mysqli_query($conn, $update_query)) {
        header("Location: admin_panel.php");  // Redirect back to the candidates list
        exit();
    } else {
        echo "Error updating candidate: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Candidate - Voting System</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* General Styling */
body {
    font-family: 'Arial', sans-serif;
    background: url('images/vote.png') no-repeat center center fixed;
    background-size: cover;
    color: #333;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

h2 {
    color: rgb(22, 193, 215);
    font-size: 36px;
    font-weight: 700;
    margin-bottom: 20px;
}

/* Form Container */
form {
    background-color: rgba(255, 255, 255, 0.9); /* Slight opacity */
    padding: 40px;
    border-radius: 16px;
    width: 80%;
    max-width: 600px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
    text-align: center;
}

label {
    font-size: 18px;
    margin-bottom: 10px;
    display: block;
    text-align: left;
}

input[type="text"] {
    width: 100%;
    padding: 12px;
    font-size: 18px;
    margin: 10px 0;
    border: 2px solid #ccc;
    border-radius: 8px;
}

button {
    padding: 15px 30px;
    background-color: #22C6D7;
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #00a7b2;
}

/* Back Link Styling */
a {
    text-decoration: none;
    color: #00BFFF;
    font-size: 18px;
    margin-top: 15px;
    display: inline-block;
}

a:hover {
    color: #007bb5;
}

    </style>
</head>
<body>
    <h2>Edit Candidate</h2>
    <form method="POST">
        <label for="name">Candidate Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($candidate['name']); ?>" required><br><br>
        <button type="submit">Update Candidate</button>
    </form>

    <p><a href="manage_candidates.php">Back to Candidate List</a></p>
</body>
</html>
