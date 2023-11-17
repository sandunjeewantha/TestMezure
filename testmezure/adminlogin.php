<?php
    require('connection/connection.php');
    require('functions/adminfunction.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="content/css/style2.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <form id="login-form" action="adminlogin.php" method="POST">
                <h2>Admin Login</h2>
                <div class="form-group">
                    <label for="login-email">Email:</label>
                    <input type="text" id="login-email" name="ad-login-email" required>
                </div>
                <div class="form-group">
                    <label for="login-password">Password:</label>
                    <input type="password" id="login-password" name="ad-login-password" required>
                </div>
           
                <button type="submit" name="ad-btn-login">Login as Admin</button>
            </form>
        </div>