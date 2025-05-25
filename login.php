<?php
session_start();
include('includes/db.php');

if (isset($_SESSION['user_id'])) {
    header("Location: vote.php");
    exit();
}

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $user = mysqli_fetch_assoc($check);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        header("Location: vote.php");
        exit();
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Login - Voting System</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background: url('images/create.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            color: #00aaff;
        }
           /* ---- START: Bigger form + text sizes ---- */
    .form-container {
      background: rgba(0,0,0,0.7);
      padding: 60px;
      border-radius: 20px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.6);
      width: 500px;           /* make form wider */
      text-align: center;
    }

    .form-container h2 {
      font-size: 42px;        /* bigger heading */
      color: #fff;
      margin-bottom: 30px;
    }

    .form-container input[type="email"],
    .form-container input[type="password"] {
      width: 100%;
      padding: 18px;          /* taller inputs */
      margin: 16px 0;
      font-size: 20px;        /* larger text inside */
      border: none;
      border-radius: 10px;
      background: #f1f1f1;
    }

    .form-container button {
      width: 100%;
      padding: 18px;
      margin-top: 20px;
      font-size: 22px;        /* larger button text */
      border: none;
      border-radius: 10px;
      background-color: #3498db;
      color: #fff;
      cursor: pointer;
      transition: background-color 0.3s;
    }
    .form-container button:hover {
      background-color: #2980b9;
    }

    .form-container .register-link {
      margin-top: 25px;
      font-size: 18px;
      color: #fff;
    }
    .form-container .register-link a {
      color: #00acee;
      text-decoration: none;
      font-weight: bold;
    }
    </style>
</head>
<body>

<div class="form-container">
    <h2>User Login</h2>

    <form method="POST" autocomplete="off">
        <input type="email" name="email" placeholder="University Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>

    <?php if (!empty($error)) echo "<p style='color: red;'>$error</p>"; ?>

    <p class="register-link">Not registered? <a href="register.php">Create an account</a></p>
    <p class="clear-link"><a href="login.php?logout=true">Clear session (dev only)</a></p>
</div>

</body>
</html>
