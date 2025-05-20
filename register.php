<?php
include('includes/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if (!preg_match('/@marwadiuniversity\.ac\.in$/', $email)) {
        $error = "Only emails ending with @marwadiuniversity.ac.in are allowed.";
    } else {
        $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
        if (mysqli_num_rows($check) > 0) {
            $error = "Email already registered.";
        } else {
            $insert = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
            if (mysqli_query($conn, $insert)) {
                $success = "Registration successful. <a href='login.php'>Login now</a>";
            } else {
                $error = "Error: " . mysqli_error($conn);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration - Voting System</title>
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
        .form-container {
      background: rgba(0,0,0,0.7);
      padding: 60px;
      border-radius: 20px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.6);
      width: 500px;           
      text-align: center;
    }

    .form-container h2 {
      font-size: 42px;        
      color: #fff;
      margin-bottom: 30px;
    }

    .form-container input[type="text"],
    .form-container input[type="email"],
    .form-container input[type="password"] {
      width: 100%;
      padding: 18px;          
      margin: 16px 0;
      font-size: 20px;        
      border: none;
      border-radius: 10px;
      background: #f1f1f1;
    }

    .form-container button {
      width: 100%;
      padding: 18px;
      margin-top: 20px;
      font-size: 22px;        
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

    .form-container p {
      margin-top: 25px;
      font-size: 18px;
      color: #fff;
    }
    .form-container p a {
      color: #00acee;
      text-decoration: none;
      font-weight: bold;
    }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Register to Vote</h2>

    <form method="POST" autocomplete="off">
        <input type="text" name="name" placeholder="Full Name" required><br>
        <input type="email" name="email" placeholder="University Email" required><br>
        <input type="password" name="password" placeholder="Create Password" required><br>
        <button type="submit">Register</button>
    </form>

    <?php
    if (!empty($error)) echo "<p style='color:red;'>$error</p>";
    if (!empty($success)) echo "<p style='color:green;'>$success</p>";
    ?>

    <p>Already registered? <a href="login.php">Login here</a></p>
</div>

</body>
</html>
