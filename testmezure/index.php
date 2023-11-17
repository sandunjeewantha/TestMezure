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
  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="content/css/style.css">

    <title>TestMezure</title>
</head>

<body data-bs-spy="scroll" data-bs-target=".navbar">

    <!--navbar-->
   <?php
    require('NavBar.php')
   ?>

    <!--hero-->
    <section id="home" class="bg-cover hero-section" style="background-image: url(img/1.jpg);">
        <div class="overlay"></div>
        <div class="container text-white text-center">
            <div class="row">
                <div class="col-12">
                    <h1 class="display-4" data-aos="zoom-in">Revolutionizing Your QA WorkFlow <br>
                        </h1>
                    <p class="my-4 x" data-aos="fade-up">Streamlining and enhancing every step of your quality assurance process <br> for better, faster results</p>
                    <br>
                    <a href="testmezure.php" data-aos="fade-up" class="btn btn-main y">Download</a>
                </div>
            </div>
        </div>
    </section>

   
<!--features-->
<section id="features" class="text-center">
    <div class="container">
        <div class="row">
            <div class="col-12 section-intro text-center" data-aos="fade-up">
                <div class="divider"></div>
                <h5 class="h">Experience the full potential of TestMezure by unlocking a world of amazing features at your fingertips.</h5>
            </div>
        </div>
        <div class="row gx-4 gy-5">
            <div class="col-md-4 feature" data-aos="fade-up">
                     
        <h5 class="mt-4 mb-3 c">All Together in One Center Platform</h5>
        <p>You Can Manage Your Project or Organization All QA , Project Process in One Center Place...</p>
    </div>
    <div class="col-md-4 feature" data-aos="fade-up">

        <h5 class="mt-4 mb-3 c">TestMezure Align with Industry Trends</h5>
        <p>Day by Day TestMezure Updating & Always Align with Industry Trends , Not Will Expire...</p>
    </div>
    <div class="col-md-4 feature" data-aos="fade-up">

      

                <h5 class="mt-4 mb-3 c">Open Source & Free</h5>
                <p>TestMezure is Open Source & Free Platform without Any Charges,  Can Use From LifeTime Free...</p>
            </div>
            <div class="col-md-4 feature" data-aos="fade-up">

                <h5 class="mt-4 mb-3 c">Test Design & QA Documentation with Customizing</h5>
                <p>Create & Manage All Veriety of Test Design & Documentation with user prfered way rather than traditional ways</p>
            </div>
            <div class="col-md-4 feature" data-aos="fade-up">
             
                <h5 class="mt-4 mb-3 c">Execution & Reports</h5>
                <p>Create Test Cycles , Executes Tests and Generate Reports...</p>
            </div>
            <div class="col-md-4 feature" data-aos="fade-up">
             
                <h5 class="mt-4 mb-3 c">Automation</h5>
                <p>Manage & Handle Your Automation Scripts Easily</p>
            </div>
         
            <div class="col-md-4 feature" data-aos="fade-up">
              
                <h5 class="mt-4 mb-3 c">Discussion Platform</h5>
                <p>Discuss , Solve , Ask , Build Up Your Network with World & Build QA Community </p>
            </div>
            <div class="col-md-4 feature" data-aos="fade-up">
             
                <h5 class="mt-4 mb-2 c">Learning Platform</h5>
                <p>Learn Software Quality assurance Beginner to Advance</p>
            
            </div>
            <div class="col-md-4 feature" data-aos="fade-up">
             
                <h5 class="mt-4 mb-3 c">User Frienly</h5>
                <p>TestMezure is Easy to Use & User Friendly Platform...</p>
            
            </div>
        </div>
   
      
    </div>
</section>




    <!--about-->
    <section id="about" class="bg-cover" style="background-image: url(img/cover_3.jpg);">
        <div class="overlay"></div>
        <div class="container text-white text-center">
            <div class="row">
                <div class="col-12 section-intro text-center" data-aos="fade-up">
                    <h5>How to Use</h5>
                    <div class="divider"></div>
                    
                    <a href="#" class="video-btn"><i class='bx bx-play'></i></a>
                </div>
            </div>
        </div>
    </section>


    <!--counters-->
    <section class="bg-cover" style="background-image: url(img/cover_2.jpg);">
        <div class="overlay"></div>
        <div class="container text-white text-center">
            <div class="row gy-4" data-aos="fade-up">
                <div class="col-md-3">
                 
                    <h1 class="mt-3 mb-2">100+</h1>
                    <p>Organizations</p>
                </div>
                <div class="col-md-3">
                   
                    <h1 class="mt-3 mb-2">10K+</h1>
                    <p>Freelancers</p>
                </div>
                <div class="col-md-3">
                    
                    <h1 class="mt-3 mb-2">2K+</h1>
                    <p>Undegraduates</p>
                </div>
                <div class="col-md-3">
                    
                    <h1 class="mt-3 mb-2">25K+</h1>
                    <p>Indstry Experts & Peoples</p>
                </div>
            </div>
        </div>
    </section>

    <!--reviews-->
    <section id="reviews" class="text-center">
        <div class="container">
            <div class="row">
                <div class="col-12 section-intro text-center">
                    <h1>Our Testimonials</h1>
                    <div class="divider"></div>
                   
                </div>
            </div>
            <div class="row g-4 text-start">
                <div class="col-md-4" data-aos="fade-up">
                    <div class="review p-4">
                        <div class="person">
                            <img src="content/images/dinesha.jpg" alt="dinesha">
                            <div class="text ms-3">
                                <h6 class="mb-0">Dinesha Diyapotage</h6>
                                <small>QA Lead</small>
                            </div>
                        </div>
                        <p class="pt-4">

                            "I had the privilege of using TestMezure test management application as a QA Lead, and I'm thoroughly impressed. <br>This application has transformed our test management processes. <br>Its user-friendly interface, comprehensive features, and excellent support make it a game-changer for QA teams.<br> It simplifies QA WorkFlow, enabling us to deliver high-quality products efficiently. TestMezure application is a must-have for any QA team."
                            
                            Feel free to customize this statement further to align with your specific needs and branding.</p>
                        <div class="stars">
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up">
                    <div class="review p-4">
                        <div class="person">
                            <img src="content/images/ishani.jpg" alt="">
                            <div class="text ms-3">
                                <h6 class="mb-0">Ishani Nuwanthika</h6>
                                <small>Senior Quality Assurance Engineer/Software Engineer</small>
                            </div>
                        </div>
                        <p class="pt-4">"I've had the pleasure of working closely with TestMezure application.<br> As a Software Engineer, I value tools that enhance collaboration and efficiency. <br>TestMezure application does just that. It seamlessly integrates into our development cycle,<br> making it easier to understand testing requirements and track process.<br> TestMezure application not only benefits our QA team but also improves communication between development and testing, ultimately leading to better software quality."</p>
                        <div class="stars">
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up">
                    <div class="review p-4">
                        <div class="person">
                            <img src="content/images/nipun.jpg" alt="nipun">
                            <div class="text ms-3">
                                <h6 class="mb-0">Nipun Dilshan</h6>
                                <small>Freelancer/ Developer / Cyber Security Specialist</small>
                            </div>
                        </div>
                        <p class="pt-4">"As a seasoned freelancer in the industry, I understand the importance of efficiency and precision in delivering high-quality results to clients.<br>  TestMezure application has been a game-changer in my workflow. Its user-friendly interface simplifies test planning and tracking,<br> allowing me to focus on what I do best—ensuring the quality of software products.<br> This application is a must-have for freelancers looking to enhance their testing capabilities and provide top-notch services to clients.<br> Kudos to Sandun for creating such a valuable tool for our industry!"</p>
                        <div class="stars">
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up">
                    <div class="review p-4">
                        <div class="person">
                            <img src="content/images/techseya.jpg" alt="">
                            <div class="text ms-3">
                                <h6 class="mb-0">techseya</h6>
                                <small>Software Development Company</small>
                            </div>
                        </div>
                        <p class="pt-4">As a development company committed to delivering top-tier software solutions, we understand the pivotal role that test management plays in ensuring product quality.<br>
                            We recently integrated TestMezure test management application into our development processes, and the results have been outstanding. This application has revolutionized how we handle testing and quality assurance.<br>
                            Its user-friendly interface, comprehensive features, and scalability have allowed our teams to work more efficiently and collaboratively. With this application, we can confidently deliver software that exceeds client expectations, and it has become an indispensable asset in our development toolkit.<br>
                            We highly recommend TestMezure application to other development companies seeking to elevate their software quality and streamline their workflows."</p>
                        <div class="stars">
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4" data-aos="fade-up">
                    <div class="review p-4">
                        <div class="person">
                            
                            <div class="text ms-3">
                                <h6 class="mb-0">Undergraduates</h6>
                                <small>Undergraduates in different Univeristies</small>
                            </div>
                        </div>
                        <p class="pt-4">This is Greate Opportunity to Us Learn QA , discuss, networking and Practice.<br> through that we can directly align and enter industry with experience . this is greate product to use undergraduates .</p>
                        <div class="stars">
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                        </div>
                    </div>
                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

   

    <!--contact-->
    <section id="contact" class="bg-cover text-white" style="background-image: url(img/cover_3.jpg);">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-12 section-intro text-center" data-aos="fade-up">
                    <h1>Get in touch</h1>
                    <div class="divider"></div>
                    <p>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 mx-auto" data-aos="fade-up">
                    <form action="" method="POST" class="row g-4">
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="inqr-fName" required placeholder="Full name">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="email" class="form-control" name="inqr-email" required placeholder="Email address">
                        </div>
                        <div class="form-group col-md-12">
                            <input type="text" class="form-control" name="inqr-subject" required placeholder="Subject">
                        </div>
                        <div class="form-group col-md-12">
                            <textarea id="" cols="30" rows="4" name="inqr-message"  class="form-control" placeholder="Message"></textarea>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-main y" name="inqrBtn"  type="submit">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!--footer-->
    <footer class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0">Developed  By Sandun Jeewantha </p>
                </div>
               
        </div>
    </footer>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="content/js/app.js"></script>
</body>

</html>