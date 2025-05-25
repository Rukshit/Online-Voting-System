<?php
session_start();
include('includes/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to get the admin details
    $query = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username'");
    $admin = mysqli_fetch_assoc($query);

    // Check if admin exists and verify the password
    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_username'] = $admin['username'];
        header("Location: admin_panel.php");
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Voting System</title>
    <style>
        /* General Body Styling */
        body {
            background: url('images/vote.png') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Login Box Styling */
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
        }

        form {
            background: rgba(255, 255, 255, 0.2);  /* More transparent form background */
            padding: 60px;  /* Increased padding for better spacing */
            border-radius: 16px;  /* More rounded corners */
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.5);  /* Larger shadow */
            width: 100%;
            max-width: 600px;  /* Extra large form width */
            text-align: center;
        }

        /* Title Styling */
        h2 {
    margin: 0 0 40px 0;  /* Top margin 0, bottom margin 40px */
    color: rgb(5, 113, 159);
    font-size: 36px;  /* Extra large font size */
    font-weight: 700;
    background-color: white;
    padding: 10px 20px;  /* Add some padding inside the background */
    border-radius: 8px;  /* Rounded corners for background */
    display: inline-block;  /* To make the background fit the text */
}


        /* Input Fields Styling */
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 20px;  /* Larger padding */
            margin: 20px 0;  /* Increased margin */
            border: 1px solid #ccc;
            border-radius: 12px;  /* More rounded corners */
            font-size: 22px;  /* Larger font size */
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus, input[type="password"]:focus {
            border-color: #5e9bfc;
            outline: none;
        }

        /* Submit Button Styling */
        button {
            width: 100%;
            padding: 20px;  /* Larger padding */
            background-color: #001f3f;  /* Dark blue background */
            color: #00BFFF;  /* Neon blue text */
            border: none;
            border-radius: 12px;  /* More rounded corners */
            font-size: 22px;  /* Larger font size */
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 0 10px #00BFFF;
        }

        button:hover {
            background-color: #00BFFF;
            color: #001f3f;
            box-shadow: 0 0 20px #00BFFF;
            transform: scale(1.05);
        }

        /* Error Message Styling */
        .error {
            color: #e74c3c;
            font-size: 18px;  /* Larger error text */
            margin-top: 20px;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            form {
                padding: 40px;
            }

            h2 {
                font-size: 30px;
            }

            input[type="text"], input[type="password"], button {
                padding: 18px;
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <form method="POST">
            <h2>Admin Login</h2>
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Login</button>
            <?php
            if (!empty($error)) {
                echo "<p class='error'>$error</p>";
            }
            ?>
        </form>
    </div>
</body>
</html>
