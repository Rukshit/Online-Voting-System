<?php
session_start();

// If the user is not logged in, redirect them to the login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include('includes/db.php');

// Fetch the list of candidates
$candidates_query = "SELECT * FROM candidates";
$candidates_result = mysqli_query($conn, $candidates_query);

// Check if there are any candidates
if (mysqli_num_rows($candidates_result) == 0) {
    $error = "No candidates available to vote for.";
}

// Handle voting
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $candidate_id = $_POST['candidate_id'];
    $user_id = $_SESSION['user_id'];

    // Check if the user has already voted
    $vote_check_query = "SELECT * FROM votes WHERE voter_id = '$user_id'";
    $vote_check_result = mysqli_query($conn, $vote_check_query);
    
    if (mysqli_num_rows($vote_check_result) > 0) {
        $error = "You have already voted.";
    } else {
        // Insert vote into the votes table
        $vote_query = "INSERT INTO votes (candidate_id, voter_id) VALUES ('$candidate_id', '$user_id')";
        if (mysqli_query($conn, $vote_query)) {
            $success = "Your vote has been successfully recorded!";
        } else {
            $error = "There was an error casting your vote.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vote - Voting System</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Keep your main style -->
    <style>
        body {
            background: url('images/voteing.png') no-repeat center center fixed;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
            height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #ffffff;
            text-align: center;
            backdrop-filter: brightness(0.7);
        }

        h2 {
            margin-top: 30px;
            font-size: 32px;
            color: #ffffff;
            text-shadow: 1px 1px 5px #000;
        }

        .candidate-card {
            background: rgba(0, 0, 0, 0.6);
            border-radius: 15px;
            padding: 20px;
            margin: 20px auto;
            width: 300px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            transition: transform 0.3s;
        }

        .candidate-card:hover {
            transform: scale(1.05);
        }

        .candidate-card img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
            border: 2px solid #ffffff;
        }

        .candidate-card strong {
            display: block;
            margin-top: 10px;
            font-size: 20px;
        }

        .candidate-card p {
            font-size: 14px;
            color: #ddd;
        }

        button {
            background-color:rgb(21, 55, 88);
            border: none;
            color: white;
            padding: 10px 20px;
            margin-top: 10px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color:rgb(15, 150, 181);
        }

        a {
            color: #ffcc00;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        .message {
            font-size: 18px;
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>! Please vote for your candidate:</h2>

    <?php
    // Show success or error messages
    if (!empty($success)) {
        echo "<p class='message' style='color: lightgreen;'>$success</p>";
    }
    if (!empty($error)) {
        echo "<p class='message' style='color: red;'>$error</p>";
    }
    ?>

    <?php
    // Reset pointer if needed
    mysqli_data_seek($candidates_result, 0);

    // Display each candidate
    while ($candidate = mysqli_fetch_assoc($candidates_result)) {
    ?>
        <div class="candidate-card">
            <img src="<?php echo htmlspecialchars($candidate['image']); ?>" alt="<?php echo htmlspecialchars($candidate['name']); ?>">
            <strong><?php echo htmlspecialchars($candidate['name']); ?></strong>
            <p><?php echo htmlspecialchars($candidate['description']); ?></p>

            <?php if (!isset($success)) { ?>
                <form method="POST">
                    <input type="hidden" name="candidate_id" value="<?php echo $candidate['id']; ?>">
                    <button type="submit">Vote</button>
                </form>
            <?php } else { ?>
                <p style="color: lightgreen;"><strong>You have already voted.</strong></p>
            <?php } ?>
        </div>
    <?php
    }
    ?>

    <p><a href="logout.php">Logout</a></p>

</body>
</html>
