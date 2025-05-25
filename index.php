<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting System - Home</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background: url('images/vote.png') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            text-align: center;
            height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        h1 {
            font-size: 60px;
            color: #00BFFF; /* Neon blue */
            margin-bottom: 40px;
            text-shadow: 2px 2px 8px #0077b6;
        }
        .login-links {
            margin-top: 30px;
        }
        .login-links a {
            display: inline-block;
            background-color: #001f3f; /* Dark blue background */
            color: #00BFFF; /* Neon blue text */
            padding: 15px 30px;
            margin: 10px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 24px;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 0 10px #00BFFF;
        }
        .login-links a:hover {
            background-color: #00BFFF;
            color: #001f3f;
            box-shadow: 0 0 20px #00BFFF;
            transform: scale(1.05);
        }
        p {
            font-size: 24px;
            color: #ffffff;
            margin: 10px;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Welcome Text -->
        

        <!-- Display Based on Session -->
        <?php if (isset($_SESSION['user_id'])): ?>
            <p>Welcome, <?php echo $_SESSION['user_name']; ?>!</p>
            <div class="login-links">
                <a href="vote.php">Go to Voting Page</a>
                <a href="logout.php">Logout</a>
            </div>
        
        <?php elseif (isset($_SESSION['admin_id'])): ?>
            <p>Welcome, Admin!</p>
            <div class="login-links">
                <a href="admin_panel.php">Go to Admin Panel</a>
                <a href="logout.php">Logout</a>
            </div>
        
        <?php else: ?>
            <!-- User and Admin login buttons -->
            <div class="login-links">
                <a href="login.php">User Login</a>
                <a href="admin_login.php">Admin Login</a>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>
