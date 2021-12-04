<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>About Us | Semaphore</title>
        <link rel="stylesheet" href="css/about.css">
          <link rel="stylesheet" href="css/client.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet"> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <div class="banner">
            <ul>
                <div class="floatleft">
                     <li><h3>SEMAPHORE</h3></li>
                </div>
                <div class="floatright">
                    <li class="contact"><img src="images/login/contact/phone.png"></li>
                    <li class="contact"><p>+63 906 416 9206</p></li>
                    <li class="contact"><img src="images/login/contact/email.png"></li>
                    <li class="contact"><p>semaphore@it-solutions.com</p></li>
                </div>
            </ul>
        </div>
        <div class="menu">
            <ul>
               <?php
                        session_start();
                        if (! empty($_SESSION['logged_in']))
                        {
                           echo "<li><a href='client/home.php'>Home</a></li>";
                           echo "<li><a href='ITPersonalityQuiz/SemaphoreITPersonalityQuiz.php'>IT Personality Quiz</a></li>";
                           echo "<li><a href='client/feedback.php'>Feedback</a></li>";
                           echo "<li><a href='client/home.php'>Register a Project</a></li>";
                           echo "<div class='dropdown'>
                              <li class='menu-nav'><i class='arrow down'></i></li>
                                 <div class='dropdown-content'>
                                   <p><a href='client/settings.php'>Settings</a></p>
                                   <p><a href='logout.php'>Log out</a></p>
                                 </div>
                           </div>";
                        }else{
                           echo "<li><a href='index.php'>Sign In</a></li>";
                           echo "<li><a href='register.php'>Register</a></li>";
                           echo "<li><a href='ITPersonalityQuiz/SemaphoreITPersonalityQuiz.php'>IT Personality Quiz</a></li>";
                           echo "<li><a href='feedback.php'>Feedback</a></li>";
                           echo "<div class='dropdown'>
                               <li><a href=''>Services &nbsp; <i class='arrow down'></i></a></li>
                                  <div class='dropdown-content'>
                                    <p>App Development</p>
                                    <p>Web Development</p>
                                    <p>Digital Marketing</p>
                                    <p>Software Development</p>
                                  </div>
                            </div>";
                        }
                ?>
            </ul>
        </div>

        <!-- team -->
          <div class="container">
           <h1 class="heading"><span>meet</span>Our Team</h1>

            <div class="profiles">
              <div class="profile">
                <img src="images/team/rikkimae-martinez.png" class="profile-img">

                <h3 class="user-name">Rikki Mae Martinez</h3>
                <h5>Website & Application Developer</h5>
                <p>I'm a website and application developer, specialiazing frontend and backend development.</p>
                <p style="font-size:14px;">rikkimae.martinez@xyz.com</p>
              </div>
               <div class="profile">
                <img src="images/team/johnvic-delacruz.jpg" class="profile-img">

                <h3 class="user-name">Johnvic Dela Cruz</h3>
                <h5>Front-end Developer</h5>
                <p>I'm a web designer, specializing in front-end and UX experienced with Adobe Create Suites.</p>
                <p style="font-size:14px;">johnvic.delacruz@xyz.com</p>
              </div>
              <div class="profile">
                <img src="images/team/jennifer-marquez.jpg" class="profile-img">

                <h3 class="user-name">Jennifer Marquez</h3>
                <h5>UI UX Designer</h5>
                <p>I focus on UI UX design. I strive to create usable and polished products through passionate and deliberate design.</p>
                <p style="font-size:14px;">jennifer.marquez@xyz.com</p>
              </div>
              <div class="profile">
                <img src="images/team/marianne-rario.jpg" class="profile-img">

                <h3 class="user-name">Marianne Rario</h3>
                <h5>Full-Stack Developer</h5>
                <p>I'm a full stack developer. My expertise is in the area of backend and frontend.</p>
                <p style="font-size:14px;">marianne.rario@xyz.com</p>
              </div>
              <div class="profile">
                <img src="images/team/aaron-carillo.jpg" class="profile-img">

                <h3 class="user-name">Aaaron Carillo</h3>
                <h5>Software Engineer</h5>
                <p>I'm a software engineer, specializing in building high-quality webistes and applications.</p>
                <p style="font-size:14px;">aaronjoseph.carillo@xyz.com</p>
              </div>
            </div>
          </div>

            <hr>

            <!-- dummy previous clients -->
            <section>
                <div class="rt-container">
                      <div class="col-rt-12">
                          <a name="clients"><h3>Our Previous Clients</h3></a>
                           <section class="customer-logos slider">
                              <div class="slide"><img src="images/dummy-prev-clients/comp1.png"></div>
                              <div class="slide"><img src="images/dummy-prev-clients/comp2.png"></div>
                              <div class="slide"><img src="images/dummy-prev-clients/comp3.png"></div>
                              <div class="slide"><img src="images/dummy-prev-clients/comp4.png"></div>
                              <div class="slide"><img src="images/dummy-prev-clients/comp5.png"></div>
                              <div class="slide"><img src="images/dummy-prev-clients/comp6.png"></div>
                              <div class="slide"><img src="images/dummy-prev-clients/comp7.png"></div>
                              <div class="slide"><img src="images/dummy-prev-clients/comp8.png"></div>
                           </section>
               		   </div>
                  </div>
            </section>
      </body>
</html>
 <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
    <script type="text/javascript">
    	$(document).ready(function(){
			$('.customer-logos').slick({
				slidesToShow: 6,
				slidesToScroll: 1,
				autoplay: true,
				autoplaySpeed: 1500,
				arrows: false,
				dots: false,
				pauseOnHover: false,
				responsive: [{
					breakpoint: 768,
					settings: {
						slidesToShow: 4
					}
				}, {
					breakpoint: 520,
					settings: {
						slidesToShow: 3
					}
				}]
			});
		});
</script>
