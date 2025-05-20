<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Admin is logged in, display dashboard
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Voting System</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Background Image */
        body {
            background: url('images/vote.png') no-repeat center center fixed;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Admin Dashboard Styling */
        .dashboard-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            background-color: rgba(255, 255, 255, 0.9);  /* Slight opacity */
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);  /* Larger shadow */
            width: 80%;
            max-width: 800px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: rgb(22, 193, 215);
            font-size: 36px;
            font-weight: 700;
        }

        h3 {
            color: #333;
            font-size: 28px;
            margin-bottom: 30px;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin: 15px 0;
        }

        a {
            text-decoration: none;
            color: #00BFFF;
            font-size: 20px;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #007bb5;
        }

        /* Logout Button Styling */
        .logout-btn {
            margin-top: 30px;
            background-color: #FF6347;
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 10px;
            font-size: 20px;
            transition: background-color 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #D44F39;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .dashboard-container {
                padding: 30px;
                width: 90%;
            }

            h2 {
                font-size: 28px;
            }

            h3 {
                font-size: 24px;
            }

            a {
                font-size: 18px;
            }

            .logout-btn {
                padding: 12px 24px;
                font-size: 18px;
            }
        }
    </style>
</head>
<body>

    <div class="dashboard-container">
        <h2>Welcome, Admin (<?php echo $_SESSION['admin_email']; ?>)</h2>
        <h3>Admin Dashboard</h3>
        <ul>
            <li><a href="add_candidate.php">Add New Candidate</a></li>
            <li><a href="view_votes.php">View Votes</a></li>
        </ul>
        <a href="admin_logout.php" class="logout-btn">Logout</a>
    </div>

</body>
</html>
