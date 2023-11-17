<?php

require('connection/connection.php');
require('functions/function.php');

LoginCheck();
LoadWorkstation();

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="content/css/style.css">
    <script src="https://cdn.tiny.cloud/1/8fwl8eqzj5k519z6rfaz9zrqjwoa372th7jgb91o3h0v1m20/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>


    <title>TestMezure</title>
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
                <?php
                $edmode = false;
                $edtcid = 0;
                $edted = 0;
                $edtdel = 0;

                if (isset($_GET['tid']) && isset($_GET['ted']) && isset($_GET['tdel'])) {
                    $edtcid = $_GET['tid'];
                    $edted = $_GET['ted'];
                    $edtdel = $_GET['tdel'];
                    $edmode = true;
                }
                $edData = mysqli_fetch_assoc(GetOneTestCaseById($edtcid));

                ?>
                <div class="col-8 mt-3">
                    <h3><?php echo $edmode ? 'EDIT' : 'ADD NEW' ?> TEST CASE</h3>
                    <form action="" method="POST" class="mt-3">
                        <div class="row">
                            <select class="form-select" id="folderSelect" name="testCaseFolder">
                                <option value="0">Select Folder</option>
                                <?php
                                $allFolder = GetFolder();
                                while ($rowFl = mysqli_fetch_assoc($allFolder)) {
                                    if ($edmode && $rowFl['id'] == $edData['fid']) {
                                ?>
                                        <option value="<?php echo $rowFl['id'] ?>" selected><?php echo $rowFl['name'] ?></option>
                                    <?php
                                    } else {
                                    ?>
                                        <option value="<?php echo $rowFl['id'] ?>"><?php echo $rowFl['name'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="row mt-2">
                            <?php
                            if ($edmode) {
                            ?>
                                <input type="text" name="tcVersion" placeholder="Enter Version" value="<?php echo $edData['version']; ?>">
                            <?php
                            } else {
                            ?>
                                <input type="text" name="tcVersion" placeholder="Enter Version">
                            <?php
                            }
                            ?>
                        </div>
                        <div class="row card mb-3 mt-3">
                            <div class="card-body">
                                <div class="card-body">

                                    <textarea name="testCaseText">
                                            <?php echo $edmode ? $edData['testcase'] : 'Write Your Test Cases Here & Add to Folder' ?> 
                                    </textarea>
                                    <script>
                                        tinymce.init({
                                            selector: 'textarea',
                                            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                                            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                                        });
                                    </script>

                                    <input type="hidden" value="<?php echo $edtcid ?>" name="edtcid">

                                </div>
                                <br>
                                <?php
                                if ($edmode) { ?>
                                    <button type="submit" name="btnEdittestCase" class="btn btn-primary btn-sm">Update Test Case</button>
                                <?php
                                } else {
                                ?>
                                    <button type="submit" name="btnAddtestCase" class="btn btn-primary btn-sm">Add Test Case</button>
                                <?php
                                }
                                ?>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="content/js/app.js"></script>
</body>

</html>