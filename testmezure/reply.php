<?php

require('connection/connection.php');
require('functions/function.php');
$editableReply = null;
if (isset($_GET['qid'])) {
  $qid = $_GET['qid'];
  $loadedQuection = GetQuectionById($qid);
}

if (isset($_GET['qid']) && isset($_GET['dl']) && isset($_GET['rid']) && isset($_GET['ed'])) {
  $qid = $_GET['qid'];
  $dl = $_GET['dl'];
  $ed = $_GET['ed'];
  $rid = $_GET['rid'];

  if ($ed == 1 && $dl == 0) {
    $editableReply = mysqli_fetch_assoc(LoadAnswersById($rid));
  }
}
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

  <title>QA - Reply</title>

</head>

<body data-bs-spy="scroll" data-bs-target=".navbar">

  <!--navbar-->
  <?php
  require('NavBar.php')
  ?>

  <!--features-->
  <section id="features" class="" style="min-height:715px">
    <?php
    if ($editableReply == null) {
    ?>
      <div class="container">
        <div class="row mt-5">
          <div class="col"></div>

          <div class="card mb-3 mt-3">
            <div class="mt-2">
              <?php
              if ($rowqbid = mysqli_fetch_assoc($loadedQuection)) {
                echo '<b>Q#</b>' . $rowqbid['quection'];
              }
              ?>
            </div>
            <div class="card-body">
              <form action="" method="POST">
                <input type="hidden" name="qa-id" value="<?php echo $rowqbid['id']; ?>">
                <textarea name="qa-text"> Reply </textarea>
                <script>
                  tinymce.init({
                    selector: 'textarea',
                    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                  });
                </script>
                <br>
                <center>
                  <button type="submit" name="btnQAAdd" class="btn btn-primary btn-sm">Submit Reply</button>
                </center>
              </form>
            </div>
          </div>
        </div>
        <div class="row col-12">
          <div id="hiddenDiv" class="container d-none">
            <div class="card mb-3 mt-3">
              <div class="card-body">
                <form action="" method="POST">
                  <textarea name="qu-text"> Ask Anything </textarea>
                  <script>
                    tinymce.init({
                      selector: 'textarea',
                      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                    });
                  </script>
                  <br>
                  <center>
                    <button type="submit" name="btnQAdd" class="btn btn-primary btn-sm">Post</button>
                  </center>
                </form>
              </div>
            </div>

          </div>
          <h4>
            <font color="purple">Answers</font>
          </h4>
          <br>

          <?php
          $quections = LoadAnswers($rowqbid['id']);
          while ($rowqu = mysqli_fetch_assoc($quections)) {
          ?>
            <div class="card mb-2">
              <div class="card-body">
                <div class="row">
                  <b><?php echo GetUserName($rowqu['ruemail']) ?></b>
                </div>
                <div class="row">
                  <?php echo $rowqu['answer'] ?>
                </div>
                <?php
                if ($_SESSION['user-id']  == $rowqu['ruid']) {
                ?>
                  <div class="row">
                    <a class="btn btn-secondary btn-sm mt-2 col-2" href="reply.php?qid=<?php echo $rowqu['qid']; ?>&dl=0&ed=1&rid=<?php echo $rowqu['id']; ?>" role="button">Edit Reply</a>
                    <a class="btn btn-danger btn-sm mt-2 col-2" style="margin-left: 10px;" href="reply.php?qid=<?php echo $rowqu['qid']; ?>&dl=1&ed=0&rid=<?php echo $rowqu['id']; ?>" role="button">Delete Reply</a>
                  </div>
                <?php
                }
                ?>
              </div>
            </div>
          <?php
          }
          ?>

        </div>
      </div>
    <?php
    }
    else{
      ?>
      <div class="container">
        <div class="row mt-5">
          <div class="col"></div>

          <div class="card mb-3 mt-3">
            <div class="mt-2">
              <?php
              if ($rowqbid = mysqli_fetch_assoc($loadedQuection)) {
                echo '<b>Q#</b>' . $rowqbid['quection'];
              }
              ?>
            </div>
            <div class="card-body">
              <form action="" method="POST">
                <input type="hidden" name="qa-uid" value="<?php echo $rowqbid['id']; ?>">
                <input type="hidden" name="answ-id" value="<?php echo $editableReply['id']; ?>">
                <textarea name="qa-utext"> <?php echo $editableReply['answer']; ?> </textarea>
                <script>
                  tinymce.init({
                    selector: 'textarea',
                    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                  });
                </script>
                <br>
                <center>
                  <button type="submit" name="btnQAUpdate" class="btn btn-primary btn-sm">Update Reply</button>
                </center>
              </form>
            </div>
          </div>
        </div>
      </div>
    <?php 
    }

    ?>



  </section>






  <!--footer-->
  <footer class="py-4" style="margin-top: -35px;">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <p class="mb-0">Developed By Sandun Jeewantha </p>
        </div>

      </div>
  </footer>

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

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>

  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="content/js/app.js"></script>
</body>

</html>