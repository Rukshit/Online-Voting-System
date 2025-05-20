<?php
session_start();
include('includes/db.php');

// Check if the user is logged in as admin
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch all candidates and their votes from the database
$query = "SELECT c.id, c.name, COUNT(v.id) AS vote_count
          FROM candidates c
          LEFT JOIN votes v ON c.id = v.candidate_id
          GROUP BY c.id";
$result = mysqli_query($conn, $query);

// Success or error messages
$success_msg = isset($_GET['success']) ? $_GET['success'] : '';
$error_msg = isset($_GET['error']) ? $_GET['error'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Voting System</title>
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
            background: rgba(0, 0, 0, 0.6); /* Semi-transparent background */
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
            width: 80%;
            max-width: 900px;
            text-align: center;
        }

        h1 {
            font-size: 40px;
            margin-bottom: 20px;
            color: #00BFFF; /* Neon blue */
            text-shadow: 2px 2px 8px #0077b6;
        }

        h2 {
            font-size: 32px;
            margin-bottom: 20px;
            color: #00BFFF; /* Neon blue */
            text-shadow: 2px 2px 8px #0077b6;
        }

        p {
            font-size: 18px;
            color: #fff;
        }

        a {
            text-decoration: none;
            color: #00BFFF;
            font-weight: bold;
        }

        a:hover {
            color: #fff;
            text-decoration: underline;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #00BFFF;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #00BFFF;
            color: #fff;
        }

        td {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .button {
            display: inline-block;
            padding: 15px 30px;
            background-color: #00BFFF;
            color: #fff;
            border-radius: 10px;
            font-size: 20px;
            margin-top: 20px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 0 10px #00BFFF;
        }

        .button:hover {
            background-color: #0077b6;
            box-shadow: 0 0 20px #00BFFF;
            transform: scale(1.05);
        }

        .error, .success {
            font-size: 18px;
            margin-top: 20px;
        }

        .error {
            color: #e74c3c;
        }

        .success {
            color: #27ae60;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
                width: 90%;
            }
            h1, h2 {
                font-size: 28px;
            }
            table {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Welcome, <?php echo $_SESSION['admin_username']; ?>!</h1>
        <p><a href="admin_login.php?logout=true">Logout</a></p>

        <h2>Manage the Voting System</h2>

        <!-- Success/Error messages -->
        <?php if ($success_msg) echo "<p class='success'>$success_msg</p>"; ?>
        <?php if ($error_msg) echo "<p class='error'>$error_msg</p>"; ?>

        <!-- Add New Candidate -->
        <h3><a class="button" href="add_candidate.php">Add New Candidate</a></h3>

        <!-- View Votes -->
        <h3>View Votes</h3>
        <table>
            <tr>
                <th>Candidate Name</th>
                <th>Votes</th>
                <th>Actions</th>
            </tr>

            <?php while ($candidate = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $candidate['name']; ?></td>
                    <td><?php echo $candidate['vote_count']; ?></td>
                    <td>
                        <a href="edit_candidate.php?id=<?php echo $candidate['id']; ?>">Edit</a> | 
                        <a href="delete_candidate.php?id=<?php echo $candidate['id']; ?>" onclick="return confirm('Are you sure you want to delete this candidate?');">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>

</body>
</html>
