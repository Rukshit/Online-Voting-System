<?php
session_start();
include('includes/db.php');

// Check if the admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Initialize variables
$error_msg = '';
$success_msg = '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $party = mysqli_real_escape_string($conn, $_POST['party']);
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];

    // Image upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image);

    if (move_uploaded_file($image_tmp, $target_file)) {
        // Insert candidate into the database
        $query = "INSERT INTO candidates (name, description, party, image) VALUES ('$name', '$description', '$party', '$target_file')";

        if (mysqli_query($conn, $query)) {
            $success_msg = "Candidate added successfully!";
        } else {
            $error_msg = "Error adding candidate: " . mysqli_error($conn);
        }
    } else {
        $error_msg = "Sorry, there was an error uploading your file.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Candidate - Admin Panel</title>
    <style>
        body {
            background: url('images/vote.png') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #fff;
            text-align: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: rgba(0, 0, 0, 0.7); /* Semi-transparent background */
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
            width: 80%;
            max-width: 900px;
            text-align: center;
        }

        h2 {
            font-size: 36px;
            margin-bottom: 40px;
            color: #00BFFF; /* Neon blue */
            text-shadow: 2px 2px 8px #0077b6;
        }

        p {
            font-size: 18px;
            color: #fff;
        }

        .error {
            font-size: 18px;
            color: #e74c3c;
        }

        .success {
            font-size: 18px;
            color: #27ae60;
        }

        form {
            font-size: 18px;
            margin-top: 20px;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input[type="text"], input[type="file"], textarea {
            width: 100%;
            padding: 10px;
            border: 2px solid #00BFFF;
            border-radius: 8px;
            margin-bottom: 15px;
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        button {
            display: inline-block;
            padding: 15px 30px;
            background-color: #00BFFF;
            color: #fff;
            border-radius: 10px;
            font-size: 20px;
            margin-top: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 0 10px #00BFFF;
        }

        button:hover {
            background-color: #0077b6;
            box-shadow: 0 0 20px #00BFFF;
            transform: scale(1.05);
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
                width: 90%;
            }

            h2 {
                font-size: 28px;
            }

            form {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Add New Candidate</h2>

        <?php if ($error_msg): ?>
            <p class="error"><?php echo $error_msg; ?></p>
        <?php endif; ?>

        <?php if ($success_msg): ?>
            <p class="success"><?php echo $success_msg; ?></p>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <label for="name">Candidate Name:</label>
            <input type="text" name="name" id="name" required><br>

            <label for="description">Description:</label>
            <textarea name="description" id="description" required></textarea><br>

            <label for="party">Party:</label>
            <input type="text" name="party" id="party" required><br>

            <label for="image">Upload Image:</label>
            <input type="file" name="image" id="image" required><br>

            <button type="submit">Add Candidate</button>
        </form>
    </div>

</body>
</html>
