<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Sidebar Styles */
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #333;
            padding-top: 20px;
        }

        .sidebar a {
            padding: 15px 25px;
            text-decoration: none;
            font-size: 18px;
            color: #fff;
            display: block;
        }

        .sidebar a:hover {
            background-color: #555;
        }

        /* Content Styles */
        .content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <a href="folders.php">Folders</a>
    <a href="testcases.php">Test Cases</a>
    <a href="testcycle.php">Test Cycles & Reports</a>
    <a href="testdesign.php">Test Design</a>
    <a href="automation.php">Automation</a>
    <a href="other.php">Other</a>
    <a href="testmezure.php">Settings</a>
    <a href="index.php">Logout</a>
</div>

<div class="content">
    <!-- Your main content goes here -->
    <h2>workspaceName</h2>
    
</div>

</body>
</html>
