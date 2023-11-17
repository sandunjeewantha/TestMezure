<?php
require('connection/connection.php');
require('functions/adminfunction.php');
LoginCheck();
if (isset($_GET['qid']) && isset($_GET['status'])) {
  $qid = $_GET['qid'];
  $status = $_GET['status'];
  UpdateQuectionStatus($qid, $status);
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </nav>
  <br>
  <div class="card">
    <div class="card-header">

    </div>
    <div class="card-body">
      <h5 class="card-title"></h5>

    </div>
  </div>

  <?php
  $quections = GetAllPost();
  while ($rowqu = mysqli_fetch_assoc($quections)) {
  ?>
    <div class="card mb-4">
      <div class="card-body">
        <div class="row">
          <div class="col-4"><?php echo $rowqu['quection'] ?></div>
          <?php
          if ($rowqu['status'] == 1) {
          ?>
            <div class="col-2"><span class="p-1" style="background-color: rgba(1,200,1,1);width:auto;color:white;border-radius:5px">Accepted</span></div>
          <?php
          }
          ?>
        </div>
        <div class="row">
          <div class="col-1">
            <a href="posts.php?qid=<?php echo $rowqu['id']; ?>&status=1" class="btn btn-warning">Accept</a>
          </div>
          <div class="col-1">
            <a href="posts.php?qid=<?php echo $rowqu['id']; ?>&status=0" class="btn btn-danger">Delete</a>
          </div>
          <div class="col-1">
            <a class="btn btn-primary" href="teachqa.php?qid=<?php echo $rowqu['id']; ?>" role="button">Reply</a>
          </div>
        </div>

      </div>


    </div>
  <?php
  }
  ?>
</body>

</html>