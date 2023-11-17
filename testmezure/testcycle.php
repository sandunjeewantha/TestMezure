<?php

require('connection/connection.php');
require('functions/function.php');

LoginCheck();
LoadWorkstation();
$selectedCycle = null;
if (isset($_GET['tced']) && isset($_GET['tcdel']) && isset($_GET['tcflid'])) {
    $ed = $_GET['tced'];
    $del = $_GET['tcdel'];
    $flid = $_GET['tcflid'];
    if ($del == 1) {
        RemovCycle($flid);
    }
    $selectedCycle = mysqli_fetch_assoc(GetestCycleById($flid));
}
if (isset($_GET['ted']) && isset($_GET['tdel']) && isset($_GET['tid'])) {
    $ted = $_GET['ted'];
    $tdel = $_GET['tdel'];
    $tid = $_GET['tid'];
    if ($tdel == 1) {
        RemoveTestCase($tid);
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
    <title>Test Cycles</title>
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


                        <div class="container mt-5" style="margin-left:22%;width:88%">

                            <div class="row">
                                <div class="row col-12">
                                    <div id="hiddenDiv" class="container">
                                        <form action="" method="POST">
                                            <div class="row">

                                                <?php
                                                if ($selectedCycle == null) {
                                                ?>
                                                    <div class="col-2">
                                                        <input type="text" required name="cycleName" placeholder="Enter Cycle Name" class="form-control">
                                                    </div>
                                                    <div class="col-2 mt-1">
                                                        <button type="submit" class="btn btn-primary btn-sm" name="btn-addCycle">Create Cycle</button>
                                                    </div>
                                                <?php
                                                } else {
                                                ?>
                                                    <div class="col-2">
                                                        <input type="hidden" required name="edcycleId" placeholder="Enter Folder Name" class="form-control" value="<?php echo $selectedCycle['id'] ?>">
                                                        <input type="text" required name="edcycleName" placeholder="Enter Folder Name" class="form-control" value="<?php echo $selectedCycle['name'] ?>">
                                                    </div>
                                                    <div class="col-2 mt-1">
                                                        <button type="submit" class="btn btn-primary btn-sm" name="btn-editCycle">Update</button>
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
                            if ($selectedCycle == null) {

                            ?>
                                <h3>List Of Test Cycles</h3>
                                <div class="row col-12 mt-2">
                                    <?php
                                    $allFolder = GetestCycle();
                                    while ($rowFl = mysqli_fetch_assoc($allFolder)) {
                                    ?>
                                        <div class="col-6 mb-2 mt-5">
                                            <img src="content/images/icons/icons8-cycle-50.png" alt="" width="50">
                                            <div class="text-start">
                                                <span>
                                                    <h2><?php echo $rowFl['name'] ?></h2>
                                                </span>

                                            </div>
                                            <div class="">
                                                <button onclick="ShowCycle(<?php echo $rowFl['id']; ?>)" class="btn btn-primary btn-sm">Link</button>
                                                <a href="testcycle.php?tced=1&tcdel=0&tcflid=<?php echo $rowFl['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                                <a href="testcycle.php?tced=0&tcdel=1&tcflid=<?php echo $rowFl['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                                <a href="viewcycle.php?go=1&tcyid=<?php echo $rowFl['id'] ?>" class="btn btn-success btn-sm">Execute</a>
                                            </div>
                                            <div style="display: none;" id="linkFolder<?php echo $rowFl['id'] ?>" class="mt-3">
                                                <!-- this is hidden div for link folder -->
                                                <ul>
                                                    <?php
                                                    $allTestCases = GetAllTestCase($rowFl['id']);
                                                    while ($rowaltc = mysqli_fetch_assoc($allTestCases)) {
                                                    ?>
                                                        <div class="row">
                                                            <div class="col-6"><?php echo $rowaltc['testcase'] ?></div>
                                                            <div class="col-6">
                                                                <a href="testcycle.php?add=1&tcaid=<?php echo $rowaltc['id'] ?>&tcyid=<?php echo $rowFl['id'] ?>" class="btn btn-warning btn-sm">Add</a>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </ul>

                                            </div>
                                            <hr>
                                            <?php
                                            $ftestcase = GetAllTestCaseByCycle($rowFl['id']);
                                            if (isset($ftestcase)) {
                                            ?>
                                                <h4>Test Cases</h4>
                                                <ul>
                                                    <?php
                                                    while ($rowftc = mysqli_fetch_assoc($ftestcase)) {
                                                    ?>
                                                        <li>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <?php echo $rowftc['testcase']; ?>
                                                                </div>
                                                                <div class="col-6">
                                                                    <a href="testcycle.php?tctcdel=1&tctcyid=<?php echo $rowftc['id'] ?>" class="btn btn-danger btn-sm" name="btn-addFolder">Delete</a>
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
                            ?>
                        </div>
                    </div>

                </div>

            </div>
        </div>


        <script>
            function ShowCycle(id) {
                var divToToggle = document.getElementById("linkFolder" + id);
                if (divToToggle.style.display === "none" || divToToggle.style.display === "") {
                    divToToggle.style.display = "block";
                } else {
                    divToToggle.style.display = "none";
                }
            }
        </script>

</body>

</html>