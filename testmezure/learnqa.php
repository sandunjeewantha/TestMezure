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

  <title>Learn - QA </title>

</head>

<body data-bs-spy="scroll" data-bs-target=".navbar">

  <!--navbar-->
  <?php
  require('NavBar.php')
  ?>

  <!--features-->
  <section id="features" class="" style="min-height:715px">
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

                            <!-- <button type="button" class="btn btn-primary btn-sm">read more</button>
                            <button type="button" class="btn btn-secondary btn-sm">watch video</button> -->
                        </div>
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

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>

  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="content/js/app.js"></script>
</body>

</html>