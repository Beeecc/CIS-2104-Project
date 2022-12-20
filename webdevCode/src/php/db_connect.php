<?php
    session_start();

    // Database connection start 
    $host = "localhost";    // Host name
    $user = "albino";         // User
    $password = "adrian123";         // Password
    $dbname = "albino";     // Database name

    // Create connection
    $con = mysqli_connect($host, $user, $password,$dbname);

    // Check connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>