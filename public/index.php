<?php
// Connect to the database
$host = "localhost";
$user = "root";
$password = "";
$dbname = "realestatedb.sql";
$conn = mysqli_connect($host, $user, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the login form data
$username = $_POST['username'];
$password = $_POST['password'];

// Check if the username and password are correct
$sql = "SELECT * FROM user_t WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    // Login successful
    header("Location: dashboard.php");
} else {
    // Login failed
    header("Location: login.php?error=invalid_credentials");
}
// Close connection
mysqli_close($conn);
?>