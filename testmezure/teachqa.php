<?php
require('connection/connection.php');
require('functions/adminfunction.php');
LoginCheck();
if (isset($_GET['ed']) && isset($_GET['id'])) {
  if ($_GET['ed'] == 0) {
    RemoveQATalks($_GET['id']);
  }
}
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

  <br>

  <br>
  <center>
    <div class="card w-75 mb-3">
      <div class="card-body">
        <form action="teachqa.php" method="POST">
          <?php
          if (isset($_GET['ed']) && isset($_GET['id'])) {
            if ($_GET['ed'] == 1) {
              $qatalks = LoadQATalksById($_GET['id']);
              $rowqat = mysqli_fetch_assoc($qatalks);
          ?>
              <input type="hidden" name="id" value="<?php echo $rowqat['id'] ?>">
              <textarea name="qu-text"><?php echo $rowqat['teach'] ?></textarea>
              <script>
                tinymce.init({
                  selector: 'textarea',
                  plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                  toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                });
              </script>
              <br>
              <input type="submit" class="btn btn-primary" value="Update" name="btnQAEdit">
            <?php
            }
          } else {
            ?>
            <textarea name="qu-text"></textarea>
            <script>
              tinymce.init({
                selector: 'textarea',
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
              });
            </script>
            <br>
            <input type="submit" class="btn btn-primary" value="Add" name="btnQAAdd">
          <?php
          }
          ?>


        </form>
      </div>
    </div>

    <br>
    </div>
    <div class="container">
      <div class="row">
        <?php
        $quections = LoadQATalks();
        while ($rowqu = mysqli_fetch_assoc($quections)) {
        ?>

          <div class="col-auto">
            <div class="card" style="width: 18rem;">
              <div class="card-body">
                <!-- <h5 class="card-title">Sanity Testing</h5> -->
                <p class="card-text"><?php echo $rowqu['teach'] ?></p>

                <a href="teachqa.php?ed=1&id=<?php echo $rowqu['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="teachqa.php?ed=0&id=<?php echo $rowqu['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
              </div>
            </div>
          </div>


        <?php
        }
        ?>

      </div>
    </div>
    </div>
  </center>
  <br>
</body>

</html>