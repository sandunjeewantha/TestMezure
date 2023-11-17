<?php

require('connection/connection.php');
require('functions/function.php');

LoginCheck();
LoadWorkstation();
$selectedFile = null;
if (isset($_GET['ed']) && isset($_GET['del']) && isset($_GET['flid'])) {
    $ed = $_GET['ed'];
    $del = $_GET['del'];
    $flid = $_GET['flid'];
    if ($del == 1) {
        RemoveFolder($flid);
    }
    $selectedFile = mysqli_fetch_assoc(GetFolderById($flid));
}
if (isset($_GET['ted']) && isset($_GET['tdel']) && isset($_GET['tid'])) {
    $ted = $_GET['ted'];
    $tdel = $_GET['tdel'];
    $tid = $_GET['tid'];
    if ($tdel == 1) {
        RemoveTestCase($tid);
    }
}

if (isset($_GET['ted']) && isset($_GET['tdel']) && isset($_GET['tid'])) {
    $ted = $_GET['ted'];
    $tdel = $_GET['tdel'];
    $tid = $_GET['tid'];
    if ($tdel == 2) {
        RemoveTestDesign($tid);
    }
}

if (isset($_GET['ted']) && isset($_GET['tdel']) && isset($_GET['tid'])) {
    $ted = $_GET['ted'];
    $tdel = $_GET['tdel'];
    $tid = $_GET['tid'];
    if ($tdel == 3) {
        RemoveTestAutomation($tid);
    }
}

if (isset($_GET['ted']) && isset($_GET['tdel']) && isset($_GET['tid'])) {
    $ted = $_GET['ted'];
    $tdel = $_GET['tdel'];
    $tid = $_GET['tid'];
    if ($tdel == 4) {
        RemoveTestOther($tid);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
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
            margin-left: -600px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Button Styles */
        .create-button {
            padding: 10px 20px;
            background-color: #007bff;
            /* Button background color */
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .create-button:hover {
            background-color: #0056b3;
            /* Button background color on hover */
        }

        /* Folder Styles */
        .folder {
            margin-top: 10px;
            padding: 10px;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 200px;
            text-align: center;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Edit and Delete Buttons Styles */
        .edit-button,
        .delete-button {
            padding: 5px 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            margin-left: 5px;
        }

        .edit-button:hover,
        .delete-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>


    <div class="container">
        <div class="row">
            <div class="row col-12">
                <div class="col-4">
                    <?php require('subpages/sidebar.php'); ?>
                </div>
                <div class="col-8">
                    <div class="content">
                        <nav class="navbar bg-body-tertiary">
                            <div class="container-fluid">
                                <form class="d-flex" method="GET" action="">
                                    <input class="form-control me-2" type="search" placeholder="Search" name="fl_search" aria-label="Search">
                                    <button class="btn btn-outline-success" type="submit">Search</button>
                                    <a href="folders.php" class="btn btn-outline-success" style="margin-left: 10px;">Clear</a>
                                </form>
                            </div>
                        </nav>
                        <br>
                        <br>

                        <div class="container mt-5" style="margin-left:22%;width:88%">

                            <div class="row">
                                <div class="row col-12">
                                    <div id="hiddenDiv" class="container">
                                        <form action="" method="POST">
                                            <div class="row">

                                                <?php
                                                if ($selectedFile == null) {
                                                ?>
                                                    <div class="col-2">
                                                        <input type="text" required name="folderName" placeholder="Enter Folder Name" class="form-control">
                                                    </div>
                                                    <div class="col-2 mt-1">
                                                        <button type="submit" class="btn btn-primary btn-sm" name="btn-addFolder">Add</button>
                                                    </div>
                                                <?php
                                                } else {
                                                ?>
                                                    <div class="col-2">
                                                        <input type="hidden" required name="edfolderId" placeholder="Enter Folder Name" class="form-control" value="<?php echo $selectedFile['id'] ?>">
                                                        <input type="text" required name="edfolderName" placeholder="Enter Folder Name" class="form-control" value="<?php echo $selectedFile['name'] ?>">
                                                    </div>
                                                    <div class="col-2 mt-1">
                                                        <button type="submit" class="btn btn-primary btn-sm" name="btn-editFolder">Update</button>
                                                    </div>
                                                <?php
                                                }
                                                ?>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <?php

                            if (!isset($_GET['fl_search'])) {


                                if ($selectedFile == null) {

                            ?>
                                    <h3>List Of Folders</h3>
                                    <div class="row col-12 mt-2">
                                        <?php
                                        $allFolder = GetFolder();
                                        while ($rowFl = mysqli_fetch_assoc($allFolder)) {
                                        ?>
                                            <div class="col-6 mb-2 mt-5">
                                                <a href="foldersview.php?vw=1&flid=<?php echo $rowFl['id'] ?>">
                                                <img src="content/images/icons/icons8-folder-100.png" alt="" width="50">
                                                </a>
                                                <div class="text-start">
                                                    <span>
                                                        <h2><?php echo $rowFl['name'] ?></h2>
                                                    </span>

                                                </div>
                                                <div class="">
                                                    <a href="folders.php?ed=1&del=0&flid=<?php echo $rowFl['id'] ?>" class="btn btn-warning btn-sm" name="btn-addFolder">Edit</a>
                                                    <a href="folders.php?ed=0&del=1&flid=<?php echo $rowFl['id'] ?>" class="btn btn-danger btn-sm" name="btn-addFolder">Delete</a>
                                                </div>

                                                
                                                       

                                                        
                                            </div>

                                        <?php
                                        }
                                        ?>

                                    </div>
                                <?php
                                }
                            } else {
                                $flSearch = $_GET['fl_search'];
                                $rrd = FSearch($flSearch);
                                if ($rrd == null) {
                                ?>
                                    <div>No any record found</div>
                                <?php
                                } else {
                                ?>
                                    <div class="row col-12 mt-2">
                                        <?php
                                        $allFolder = $rrd;
                                        while ($rowFl = mysqli_fetch_assoc($allFolder)) {
                                        ?>
                                            <div class="col-6 mb-2 mt-5">
                                            <a href="foldersview.php?vw=1&flid=<?php echo $rowFl['id'] ?>">
                                                    <img src="content/images/icons/icons8-folder-100.png" alt="folder" width="50">
                                                </a>
                                                <div class="text-start">
                                                    <span>
                                                        <h2><?php echo $rowFl['name'] ?></h2>
                                                    </span>

                                                </div>
                                                <div class="">
                                                    <a href="folders.php?ed=1&del=0&flid=<?php echo $rowFl['id'] ?>" class="btn btn-warning btn-sm" name="btn-addFolder">Edit</a>
                                                    <a href="folders.php?ed=0&del=1&flid=<?php echo $rowFl['id'] ?>" class="btn btn-danger btn-sm" name="btn-addFolder">Delete</a>
                                                </div>

                                                   
                                                       

                                                            
                                                                
                                            </div>

                                        <?php
                                        }
                                        ?>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>

                </div>

            </div>
        </div>


        <script>
            // Wait for the document to be fully loaded
            document.addEventListener("DOMContentLoaded", function() {
                // Get references to the button and the hidden div
                var showHideButton = document.getElementById("showHideButton");
                var hiddenDiv = document.getElementById("hiddenDiv");

                // Add a click event listener to the button
                showHideButton.addEventListener("click", function() {
                    // Toggle the visibility of the hidden div using Bootstrap 5 classes
                    hiddenDiv.classList.toggle("d-none");
                });
            });
        </script>

</body>

</html>