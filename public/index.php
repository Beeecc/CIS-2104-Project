<?php
// Connect to the database
include "../src/php/db_connect.php"
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
        <title>Sign In | NAC Management</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../src/css/signIn.css" />
        <script type="text/javascript" src="../src/js/auth.js"></script>
    </head>
    <body>
        <div class="signup-form">
            <form method="post" action="index.php">
                <label for="username">Username:</label>
                <br>
                <input type="text" id="username" name="username">
                <br>
                <label for="password">Password:</label>
                <br>
                <input type="password" id="password" name="password">
                <br>
                <br>
                <input type="submit" value="Submit"> 
                
                <?php
                  if (isset($_POST['username']) && isset($_POST['password'])) {
                    // Escape the submitted username and password to prevent SQL injection attacks
                    $username = $con->real_escape_string($_POST['username']);
                    $password = $con->real_escape_string($_POST['password']);
                    // Query the database to see if the username and password are correct
                    $query = "SELECT * FROM user_t WHERE username = '$username' AND password = '$password';";
                    $result = mysqli_query($con, $query);
                    if (mysqli_num_rows($result ) > 0) {
                        // Start a session and set a session variable to indicate that the user is logged in
                        
                        $temp = $con->query($query);
                        $result = $temp->fetch_assoc();

                        if ($result["role"] == 1){
                            header('Location: dashboard.php');
                        } elseif ($result["role"] == 2){
                            header('Location: tenant_account.php');
                        }
                        exit;
                      } else {
                        // Display an error message
                        echo 'Invalid username or password';
                      }
                    }
                ?>
            </form>
        </div>
    </body>
</html>