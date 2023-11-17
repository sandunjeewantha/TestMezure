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
                                <form class="d-flex" method="GET" action="foldersview.php">
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

                                        </form>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <?php

                            if (!isset($_GET['fl_search'])) {


                                if ($selectedFile == null) {

                            ?>
                                    <h3>Folder View</h3>
                                    <div class="row col-12 mt-2">
                                        <?php
                                        $allFolder = GetFolder();
                                        while ($rowFl = mysqli_fetch_assoc($allFolder)) {
                                            $nvfid = 0;
                                            if (isset($_GET['flid'])) {
                                                $nvfid = $_GET['flid'];
                                            }
                                            if ($rowFl['id'] != $nvfid) {
                                                continue;
                                            }
                                        ?>
                                            <div class="col-12 mb-2 mt-5">
                                                <img src="content/images/icons/icons8-folder-100.png" alt="" width="50">
                                                <div class="text-start">
                                                    <span>
                                                        <h2><?php echo $rowFl['name'] ?></h2>
                                                    </span>

                                                </div>


                                                <hr>
                                                <?php
                                                $ftestcase = GetTestCaseById($rowFl['id']);
                                                if (isset($ftestcase)) {
                                                ?>
                                                    <h4>Test Cases</h4>
                                                    <ul>
                                                        <?php
                                                        while ($rowftc = mysqli_fetch_assoc($ftestcase)) {
                                                        ?>
                                                            <li>
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <?php echo $rowftc['testcase']; ?>
                                                                    </div>
                                                                    <div class="col-1">
                                                                        <span style="font-size: smaller;"><?php echo $rowftc['version']; ?></span>
                                                                    </div>
                                                                    <div class="col-2">
                                                                        <span style="font-size: smaller;"><?php echo GetUserName($rowftc['email']) ?></span>
                                                                    </div>
                                                                    <?php
                                                                    $logId = $_SESSION['user-id'];
                                                                    if ($rowftc['cuid'] == $logId) {
                                                                    ?>
                                                                        <div class="col-4">
                                                                            <a href="testcases.php?ted=1&tdel=0&tid=<?php echo $rowftc['id'] ?>" class="btn btn-warning btn-sm" name="btn-addFolder">Edit</a>
                                                                            <a href="folders.php?ted=0&tdel=1&tid=<?php echo $rowftc['id'] ?>" class="btn btn-danger btn-sm" name="btn-addFolder">Delete</a>
                                                                        </div>
                                                                    <?php
                                                                    }
                                                                    ?>

                                                                </div>
                                                            </li>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                    </ul>
                                                    <?php
                                                    $ftestDesign  = GetTestDesignById($rowFl['id']);
                                                    if (isset($ftestDesign)) {
                                                    ?>
                                                        <h4>Test Design</h4>
                                                        <ul>
                                                            <?php
                                                            while ($rowftc = mysqli_fetch_assoc($ftestDesign)) {
                                                            ?>
                                                                <li>
                                                                    <div class="row">
                                                                        <div class="col-4">
                                                                            <?php echo $rowftc['testcase']; ?>
                                                                        </div>
                                                                        <div class="col-1">
                                                                            <span style="font-size: smaller;"><?php echo $rowftc['version']; ?></span>
                                                                        </div>
                                                                        <div class="col-2">
                                                                            <span style="font-size: smaller;"><?php echo GetUserName($rowftc['email']) ?></span>
                                                                        </div>
                                                                        <?php
                                                                        $logId = $_SESSION['user-id'];
                                                                        if ($rowftc['cuid'] == $logId) {
                                                                        ?>
                                                                            <div class="col-4">
                                                                                <a href="testdesign.php?ted=1&tdel=0&tid=<?php echo $rowftc['id'] ?>" class="btn btn-warning btn-sm" name="btn-addFolder">Edit</a>
                                                                                <a href="folders.php?ted=0&tdel=2&tid=<?php echo $rowftc['id'] ?>" class="btn btn-danger btn-sm" name="btn-addFolder">Delete</a>
                                                                            </div>
                                                                        <?php
                                                                        }
                                                                        ?>

                                                                    </div>
                                                                </li>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                        </ul>
                                                        <?php
                                                        $ftestAuto = GetTestAutomationById($rowFl['id']);
                                                        if (isset($ftestAuto)) {
                                                        ?>
                                                            <h4>Test Automation</h4>
                                                            <ul>
                                                                <?php
                                                                while ($rowftc = mysqli_fetch_assoc($ftestAuto)) {
                                                                ?>
                                                                    <li>
                                                                        <div class="row">
                                                                            <div class="col-4">
                                                                                <?php echo $rowftc['testcase']; ?>
                                                                            </div>
                                                                            <div class="col-1">
                                                                                <span style="font-size: smaller;"><?php echo $rowftc['version']; ?></span>
                                                                            </div>
                                                                            <div class="col-2">
                                                                                <span style="font-size: smaller;"><?php echo GetUserName($rowftc['email']) ?></span>
                                                                            </div>
                                                                            <?php
                                                                            $logId = $_SESSION['user-id'];
                                                                            if ($rowftc['cuid'] == $logId) {
                                                                            ?>
                                                                                <div class="col-4">
                                                                                    <a href="automation.php?ted=1&tdel=0&tid=<?php echo $rowftc['id'] ?>" class="btn btn-warning btn-sm" name="btn-addFolder">Edit</a>
                                                                                    <a href="folders.php?ted=0&tdel=3&tid=<?php echo $rowftc['id'] ?>" class="btn btn-danger btn-sm" name="btn-addFolder">Delete</a>
                                                                                </div>
                                                                            <?php
                                                                            }
                                                                            ?>

                                                                        </div>
                                                                    </li>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                            </ul>

                                                            <?php
                                                            $ftestOther = GetTestOtherById($rowFl['id']);
                                                            if (isset($ftestOther)) {
                                                            ?>
                                                                <h4>Test Other</h4>
                                                                <ul>
                                                                    <?php
                                                                    while ($rowftc = mysqli_fetch_assoc($ftestOther)) {
                                                                    ?>
                                                                        <li>
                                                                            <div class="row">
                                                                                <div class="col-4">
                                                                                    <?php echo $rowftc['testcase']; ?>
                                                                                </div>
                                                                                <div class="col-1">
                                                                                    <span style="font-size: smaller;"><?php echo $rowftc['version']; ?></span>
                                                                                </div>
                                                                                <div class="col-2">
                                                                                    <span style="font-size: smaller;"><?php echo GetUserName($rowftc['email']) ?></span>
                                                                                </div>
                                                                                <?php
                                                                                $logId = $_SESSION['user-id'];
                                                                                if ($rowftc['cuid'] == $logId) {
                                                                                ?>
                                                                                    <div class="col-4">
                                                                                        <a href="other.php?ted=1&tdel=0&tid=<?php echo $rowftc['id'] ?>" class="btn btn-warning btn-sm" name="btn-addFolder">Edit</a>
                                                                                        <a href="folders.php?ted=0&tdel=4&tid=<?php echo $rowftc['id'] ?>" class="btn btn-danger btn-sm" name="btn-addFolder">Delete</a>
                                                                                    </div>
                                                                                <?php
                                                                                }
                                                                                ?>

                                                                            </div>
                                                                        </li>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                                </ul>
                                            </div>

                                        <?php
                                        }
                                        ?>

                                    </div>
                                <?php
                                }
                            } else {
                                $flSearch = $_GET['fl_search'];
                                $rrd = Search($flSearch);
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
                                            <div class="col-12 mb-2 mt-5">
                                                <img src="content/images/icons/icons8-folder-100.png" alt="" width="50">
                                                <div class="text-start">
                                                    <span>
                                                        <h2><?php echo $rowFl['name'] ?></h2>
                                                    </span>

                                                </div>


                                                <hr>
                                                <?php
                                                $ftestcase = GetTestCaseById($rowFl['id']);
                                                if (isset($ftestcase)) {
                                                ?>
                                                    <h4>Test Cases</h4>
                                                    <ul>
                                                        <?php
                                                        while ($rowftc = mysqli_fetch_assoc($ftestcase)) {
                                                        ?>
                                                            <li>
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <?php echo $rowftc['testcase']; ?>
                                                                    </div>
                                                                    <div class="col-1">
                                                                        <span style="font-size: smaller;"><?php echo $rowftc['version']; ?></span>
                                                                    </div>
                                                                    <div class="col-2">
                                                                        <span style="font-size: smaller;"><?php echo GetUserName($rowftc['email']) ?></span>
                                                                    </div>

                                                                    <div class="col-4">
                                                                        <a href="testcases.php?ted=1&tdel=0&tid=<?php echo $rowftc['id'] ?>" class="btn btn-warning btn-sm" name="btn-addFolder">Edit</a>
                                                                        <a href="folders.php?ted=0&tdel=1&tid=<?php echo $rowftc['id'] ?>" class="btn btn-danger btn-sm" name="btn-addFolder">Delete</a>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                    </ul>
                                                    <?php
                                                    $ftestDesign  = GetTestDesignById($rowFl['id']);
                                                    if (isset($ftestDesign)) {
                                                    ?>
                                                        <h4>Test Design</h4>
                                                        <ul>
                                                            <?php
                                                            while ($rowftc = mysqli_fetch_assoc($ftestDesign)) {
                                                            ?>
                                                                <li>
                                                                    <div class="row">
                                                                        <div class="col-4">
                                                                            <?php echo $rowftc['testcase']; ?>
                                                                        </div>
                                                                        <div class="col-1">
                                                                            <span style="font-size: smaller;"><?php echo $rowftc['version']; ?></span>
                                                                        </div>
                                                                        <div class="col-2">
                                                                            <span style="font-size: smaller;"><?php echo GetUserName($rowftc['email']) ?></span>
                                                                        </div>

                                                                        <div class="col-4">
                                                                            <a href="testdesign.php?ted=1&tdel=0&tid=<?php echo $rowftc['id'] ?>" class="btn btn-warning btn-sm" name="btn-addFolder">Edit</a>
                                                                            <a href="folders.php?ted=0&tdel=2&tid=<?php echo $rowftc['id'] ?>" class="btn btn-danger btn-sm" name="btn-addFolder">Delete</a>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                        </ul>
                                                        <?php
                                                        $ftestAuto = GetTestAutomationById($rowFl['id']);
                                                        if (isset($ftestAuto)) {
                                                        ?>
                                                            <h4>Test Automation</h4>
                                                            <ul>
                                                                <?php
                                                                while ($rowftc = mysqli_fetch_assoc($ftestAuto)) {
                                                                ?>
                                                                    <li>
                                                                        <div class="row">
                                                                            <div class="col-4">
                                                                                <?php echo $rowftc['testcase']; ?>
                                                                            </div>
                                                                            <div class="col-1">
                                                                                <span style="font-size: smaller;"><?php echo $rowftc['version']; ?></span>
                                                                            </div>
                                                                            <div class="col-2">
                                                                                <span style="font-size: smaller;"><?php echo GetUserName($rowftc['email']) ?></span>
                                                                            </div>

                                                                            <div class="col-4">
                                                                                <a href="automation.php?ted=1&tdel=0&tid=<?php echo $rowftc['id'] ?>" class="btn btn-warning btn-sm" name="btn-addFolder">Edit</a>
                                                                                <a href="folders.php?ted=0&tdel=3&tid=<?php echo $rowftc['id'] ?>" class="btn btn-danger btn-sm" name="btn-addFolder">Delete</a>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                            </ul>

                                                            <?php
                                                            $ftestOther = GetTestOtherById($rowFl['id']);
                                                            if (isset($ftestOther)) {
                                                            ?>
                                                                <h4>Test Other</h4>
                                                                <ul>
                                                                    <?php
                                                                    while ($rowftc = mysqli_fetch_assoc($ftestOther)) {
                                                                    ?>
                                                                        <li>
                                                                            <div class="row">
                                                                                <div class="col-4">
                                                                                    <?php echo $rowftc['testcase']; ?>
                                                                                </div>
                                                                                <div class="col-1">
                                                                                    <span style="font-size: smaller;"><?php echo $rowftc['version']; ?></span>
                                                                                </div>
                                                                                <div class="col-2">
                                                                                    <span style="font-size: smaller;"><?php echo GetUserName($rowftc['email']) ?></span>
                                                                                </div>

                                                                                <div class="col-4">
                                                                                    <a href="other.php?ted=1&tdel=0&tid=<?php echo $rowftc['id'] ?>" class="btn btn-warning btn-sm" name="btn-addFolder">Edit</a>
                                                                                    <a href="folders.php?ted=0&tdel=4&tid=<?php echo $rowftc['id'] ?>" class="btn btn-danger btn-sm" name="btn-addFolder">Delete</a>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                                </ul>
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