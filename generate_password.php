<?php
// Define the plain text passwords
$password_junnu = "junnu14325"; // Password for junnu
$password_satish = "satishkumar@033"; // Password for satish

// Generate the hashed passwords
$hashed_password_junnu = password_hash($password_junnu, PASSWORD_DEFAULT);
$hashed_password_satish = password_hash($password_satish, PASSWORD_DEFAULT);

// Display the hashed passwords
echo "Hashed password for 'junnu14325': " . $hashed_password_junnu . "<br>";
echo "Hashed password for 'satishkumar@033': " . $hashed_password_satish;
?>
