<?php

require('connection/connection.php');
require('functions/function.php');

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

  <title>QA - Talks</title>

</head>

<body data-bs-spy="scroll" data-bs-target=".navbar">

  <!--navbar-->
  <?php
  require('NavBar.php')
  ?>

  <!--features-->
  <section id="features" class="" style="min-height:715px">
    <div class="container">
      <div class="row mt-5">
        <div class="col"></div>
        <div class="col-4 text-end">
          <button id="showHideButton" class="btn btn-primary btn-sm">Add New Question</button>
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
          <font color="purple">Questions</font>
        </h4>
        <br>

        <?php
        $quections = LoadQuections();
        while ($rowqu = mysqli_fetch_assoc($quections)) {
        ?>
          <div class="card mb-2">
            <div class="card-body">
              <div class="row">
                <?php echo $rowqu['quection'] ?>
              </div>
              <div class="row col-2 mt-2">
                <a class="btn btn-primary btn-sm" href="reply.php?qid=<?php echo $rowqu['id']; ?>" role="button">Reply</a>
              </div>

            </div>
            <hr>
            <div class="col-12 mb-2 text-start">
              <button class="" style="height:30px; float:right" id="showAnswer<?php echo $rowqu['id']; ?>" onclick="showAnswer(<?php echo $rowqu['id']; ?>)">Show Answer</button>
            </div>
            <div id="showAnswerDiv<?php echo $rowqu['id']; ?>" style="display: none;">

              <?php
              $quectionsAnswer = LoadAnswers($rowqu['id']);
              while ($rowqu1 = mysqli_fetch_assoc($quectionsAnswer)) {
              ?>
                <div class="card mb-2">
                  <div class="card-body">
                    <div class="row">
                      <b><?php echo GetUserName($rowqu1['ruemail']) ?></b>
                    </div>
                    <div class="row">
                      <?php echo $rowqu1['answer'] ?>
                    </div>

                  </div>
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


    function showAnswer(id) {
      debugger;
      var divToToggle = document.getElementById("showAnswerDiv" + id);
      if (divToToggle.style.display === "none" || divToToggle.style.display === "") {
        divToToggle.style.display = "block";
      } else {
        divToToggle.style.display = "none";
      }
    }
  </script>

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>

  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="content/js/app.js"></script>
</body>

</html>