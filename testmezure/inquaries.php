<?php
require('connection/connection.php');
require('functions/adminfunction.php');
LoginCheck();
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.tiny.cloud/1/8fwl8eqzj5k519z6rfaz9zrqjwoa372th7jgb91o3h0v1m20/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
</head>

<body>
  <h4>Hello , Admin</h4>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

  <nav class="navbar navbar-expand-lg bg-body-tertiary">

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" href="posts.php">Posts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="teachqa.php">Teach QA</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="inquaries.php">Inquaries</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="index.php">Visit TestMezure</a>

        </li>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="adminlogout.php">LogOut</a>

        </li>
      </ul>
  </nav>
  <nav class="navbar bg-body-tertiary">
    <div class="container-fluid">
      <form class="d-flex" method="GET" action="inquaries.php">
        <input class="form-control me-2" type="search" placeholder="Search" name="fl_search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
        <a href="inquaries.php" class="btn btn-outline-success" style="margin-left: 10px;">Clear</a>
      </form>
    </div>
  </nav>
  <br>


  <div class="container">
    <div class="row">
      <?php
      $allInq = GetAllInquaries();
      $fl_search = "";
      if (isset($_GET['fl_search'])) {
        $fl_search = strtolower($_GET['fl_search']);
      }
      while ($row = mysqli_fetch_assoc($allInq)) {
        $fullName = strtolower($row['fullName']);
        $email = strtolower($row['email']);
        $subject = strtolower($row['subject']);
        $message = strtolower($row['message']);

        if (!(strpos($fullName,$fl_search) !== false || strpos($email,$fl_search) !== false 
        || strpos($subject,$fl_search) !== false || strpos($message,$fl_search) !== false) && $fl_search != "") {
          continue;
        }
      ?>
        <div class="col-12 mb-3" style="background-color: rgba(0,0,0,0.3);">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Name : <?php echo $row['fullName'] ?></li>
            <li class="list-group-item">Email : <?php echo $row['email'] ?></li>
            <li class="list-group-item">Subject : <?php echo $row['subject'] ?></li>
            <li class="list-group-item">Message : <?php echo $row['message'] ?></li>
          </ul>
        </div>
      <?php
      }
      ?>


    </div>
  </div>
</body>

</html>