<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-white" data-aos="fade-down">
    <div class="container">
        <a class="navbar-brand " href="index.php">TestMezure</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link " href="learnqa.php">Learn-QA</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="qatalks.php">QA-Talks</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Mobile App</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="testmezure.php">TestMezure</a>
                </li>

                <?php

                if (isset($_SESSION['CreateWSSt']) ){
                    ?>
                    <!--
                    <li class="nav-item">
                        <a class="nav-link" href="folders.php">Workplace</a>
                    </li>

                -->
                <?php
                }



                if (isset($_SESSION['userName'])) {
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                <?php
                }
                else{
                    ?>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li> -->
                <?php
                }
                ?>

            </ul>
        </div>
    </div>
</nav>

<script>
    function Logout() {

    }
</script>