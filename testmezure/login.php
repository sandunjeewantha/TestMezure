<?php
require('connection/connection.php');
require('functions/function.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Signup Page</title>
    <link rel="stylesheet" href="content/css/style2.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <form id="login-form" action="login.php" method="POST">
                <h2>Login</h2>
                <div class="form-group" >
                    <label for="login-email">Email:</label>
                    <input type="email" id="login-email" name="login-email" required>
                </div>
                <div class="form-group">
                    <label for="login-password">Password:</label>
                    <input type="password" id="login-password" name="login-password" required>
                </div>
                <div class="form-group">
                   
                    <a href="mailto:sandun14013@gmail.com">Forgot Password?</a>
                </div>
                <div>
                    <span>If you don't have account ? <a href="signup.php">Sign up</a> here </span>
                </div>
                <button type="submit" name="loginButton">Login</button>
            </form>
        </div>