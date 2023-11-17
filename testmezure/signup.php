<?php
require('connection/connection.php');
require('functions/function.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <link rel="stylesheet" href="content/css/style2.css">
</head>

<body>
    <div class="container">
        <div class="signup-container">
            <form id="signup-form" action="signup.php" method="POST">
                <h2>Sign Up</h2>
                <div class="form-group">
                    <label for="signup-email">Email:</label>
                    <input type="email" id="signup-email" name="signup-email" required>
                </div>
                <div class="form-group">
                    <label for="signup-password">Password:</label>
                    <input type="password" id="signup-password" name="signup-password" required>
                </div>
                <div class="form-group">
                    <label for="confirm-password">Confirm Password:</label>
                    <input type="password" id="confirm-password" name="confirm-password" required>
                </div>
                <button type="submit" name="signUpButton">Sign Up</button>
            </form>
            <p>Already have an account? <a href="login.php">Sign In Here</a></p>
        </div>
    </div>
</body>

</html>