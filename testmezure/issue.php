<?php

require('connection/connection.php');
require('functions/function.php');

LoginCheck();
LoadWorkstation();

$tctcyid = null;
$tcyid = null;
if (isset($_GET['st']) && isset($_GET['testcyst']) && isset($_GET['tctcyid']) && isset($_GET['tcyid'])) {
    $st = $_GET['st'];
    $testcyst = $_GET['testcyst'];
    $tctcyid = $_GET['tctcyid'];
    $tcyid = $_GET['tcyid'];
    if ($st == 4 && $testcyst == 0) {
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Boxicons and AOS CSS -->
    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- TinyMCE JavaScript -->
    <script src="https://cdn.tiny.cloud/1/8fwl8eqzj5k519z6rfaz9zrqjwoa372th7jgb91o3h0v1m20/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <!-- Your custom CSS file -->
    <link rel="stylesheet" href="content/css/style.css">

    <title>TestMezure</title>
</head>

<body>
    <br>
    <br>
    <br>
    <div class="container">
        <div class="row">
            <div class="col">
                <a class="btn btn-warning" href="testcycle.php" role="button">Back</a>
            </div>

            <center>

                <br>
                <br>
                <center>
                    <div class="card w-75 mb-3">
                        <form action="" method="POST">
                            <div class="card-body">
                                <input type="hidden" name="iss-id" id="" value="<?php echo $tctcyid; ?>">
                                <input type="hidden" name="iss-tcid" id="" value="<?php echo $tcyid; ?>">
                                <textarea name="iss-text">Attach </textarea>
                                <script>
                                    tinymce.init({
                                        selector: 'textarea',
                                        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                                        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                                    });
                                </script>
                                <br>

                                <button type="submit" class="btn btn-primary btn-sm" name="iss-btn">Save</button>

                            </div>
                        </form>
                    </div>
                </center>
                <br>

                <br>
            </center>
</body>

</html>