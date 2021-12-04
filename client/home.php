<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Home - Semaphore, IT Solutions Provider</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/home.css">
        <!-- dummny previous clients css -->
        <link rel="stylesheet" href="../css/client.css">

        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    </head>
    <body>
         <div class="banner">
            <ul>
                <div class="floatleft">
                     <li><h3>SEMAPHORE</h3></li>
                </div>
                <div class="floatright">
                    <?php
                        session_start();
                        if (! empty($_SESSION['logged_in']) && ($_SESSION['user_type']) == "client")
                        {
                            include '../connection/connect.php';
                            $sql_select = "SELECT * FROM tb_users WHERE email = '$_SESSION[email]'";
                            $result = mysqli_query($conn, $sql_select);

                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_assoc($result)){
                                            $fname = $row["fname"] ;
                                            $lname = $row["lname"] ;
                                            $email = $row["email"] ;
                                            $id = $row["id"] ;
                                }
                            }
                            ?>
                           
                            <li class="menu-nav"><a href="home.php">Home</a></li>
                            <li class="menu-nav"><a href="../ITPersonalityQuiz/SemaphoreITPersonalityQuiz.php">IT Personality Quiz</a></li>
                            <li class="menu-nav"><a href="../about_us.php">About Us</a></li>
                            <li class="menu-nav"><a href="feedback.php">Feedback</a></li>
                            <div class="dropdown">
                              <li class="menu-nav"><i class="arrow down"></i></li>
                                 <div class="dropdown-content">
                                   <p><span>Client,</span> <?php echo $fname . ', ' . $lname;?></p>
                                   <p><a href="settings.php">Settings</a></p>
                                   <p><a href="../logout.php">Log out</a></p>
                                 </div>
                           </div>
                         <?php
                        }
                        else
                        {
                            // access denied if user is not log in
                             header("location: ../index.php");
                             exit; 
                         }

                         //register a project
                         if(isset($_POST['submit'])){
                          $project_name = mysqli_real_escape_string($conn,$_POST['project-name']);
                          $project_duration = mysqli_real_escape_string($conn,$_POST['project-duration']);
                          $project_description = mysqli_real_escape_string($conn,$_POST['project-description']);
                          $project_category = mysqli_real_escape_string($conn,$_POST['project-category']);
                          $status = "Pending";


                          if($project_description == '') {
                            echo '<script type"text/javascript">';
                            echo 'alert("Please fill your description")';
                            header("Refresh:0;url=home.php");
                            echo '</script>'; 
                          }else{
                            //insert data
                            $strip_project_description = strip_tags($project_description);
                            $sql = "INSERT INTO tb_projects (id_user,project_name,project_category, project_duration,project_description,project_status) 
                            VALUES ('$id','$project_name','$project_category','$project_duration','$strip_project_description','$status')";
                              if(mysqli_query($conn, $sql)){
                               echo '<script type="text/javascript">';
                               echo 'alert("Project added sucessfully")';
                               header("Refresh:0;url=home.php");
                               echo '</script>';
                               } else{
                                   echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                            }
                          }
                      }
                    ?>
                </div>
            </ul>
        </div>
        <div class="container contact">
         <h4 class="sub">What we <span>offer</span></h4>
        	<div class="row">
          	<div class="col-md-3">
            	<div class="contact-info">
        				<img src="images/icons/web.png" alt="image"/>
        				<h4>Web Development</h4>
        			  <h5>We create beautiful, user-friendly interfaces.</h5>
        			</div>
        		</div>
            <div class="col-md-3">
            	<div class="contact-info">
        				<img src="images/icons/marketing.png" alt="image"/>
        				<h4>Digital Marketing</h4>
        			  <h5>Put your business in front of the right people today.</h5>
        			</div>
        		</div>
            <div class="col-md-3">
            	<div class="contact-info">
        				<img src="images/icons/app.png" alt="image"/>
        				<h4>App Development</h4>
        			  <h5>Make wild ideas reality.</h5>
        			</div>
            </div>
            	<div class="col-md-3">
            	<div class="contact-info">
        				<img src="images/icons/software.png" alt="image"/>
        				<h4>Software Development</h4>
        			  <h5>We provide truly prominent software solutions.</h5>
        			</div>
        		</div>

    <!-- register a project form -->
    	<div class="col-md-3">
    	<div class="contact-info" id="contact-hello">
				<img src="images/rocket.gif" alt="image"/>
				<h5>Hello! <?php echo ' '.  $fname . ' ' . $lname;?></h5>
				<h4>WANT TO START A PROJECT?</h4>
			  <h5>Let's talk about your project.</h5>
        <h6 style="padding-top: 50px;"><a href="registered_projects.php"><- My registered projects </a></h6>
			</div>
		</div>
		<div class="col-md-9">
			<div class="contact-form">
				<div class="form-group">
          <form class="needs-validation" action="home.php" method="post" novalidate>
               <h3>Register a Project</h3>		
			      	  <label class="control-label col-sm-2">Project Name</label>
			      	  <div class="col-sm-10">          
			      		<input type="text" class="form-control" id="project-name" placeholder="Project Name" name="project-name" minlength="1" required>
                <div class="invalid-feedback"> Cannot be blank </div>
			      	  </div>
			      	</div>
              <div class="form-group">
               <label class="control-label col-sm-2">Category</label>
                <div class="col-sm-10">  
                <select class="form-control" id="exampleFormControlSelect1" name="project-category">
                    <option value="Web Development">Web Development</option>
                    <option value="Digital Marketing">Digital Marketing</option>
                    <option value="App Development">App Development</option>
                    <option value="Software Development">Software Development</option>
                </select>
               </div>
             </div>

             <div class="form-group">
                <label class="control-label col-sm-4">When would you like us to start?</label>
			      	  <div class="col-sm-10">          
                  <div class="form-check">
                   <input class="form-check-input" type="radio" name="project-duration" id="flexRadioDefault1" value="Within 3 months" checked>
                   <label class="form-check-label" for="flexRadioDefault1">
                       Within 3 months
                   </label>
                 </div>
                 <div class="form-check">
                   <input class="form-check-input" type="radio" name="project-duration" id="flexRadioDefault2" value="3-6 months">
                   <label class="form-check-label" for="flexRadioDefault2">
                       3-6 months 
                   </label>
                 </div>
                 <div class="form-check">
                   <input class="form-check-input" type="radio" name="project-duration" id="flexRadioDefault2" value="6-12 months">
                   <label class="form-check-label" for="flexRadioDefault2">
                     6-12 months
                   </label>
                 </div>
                 <div class="form-check">
                   <input class="form-check-input" type="radio" name="project-duration" id="flexRadioDefault2" value="1+ years">
                   <label class="form-check-label" for="flexRadioDefault2">
                     1+ years
                   </label>
                 </div>
                 <div class="form-check">
                   <input class="form-check-input" type="radio" name="project-duration" id="flexRadioDefault2" value="We haven't set a time frame yet">
                   <label class="form-check-label" for="flexRadioDefault2">
                     We have not set a time frame yet
                   </label>
                 </div>
			      	  </div>
			      	</div>
			      	<div class="form-group">
			      	  <label class="control-label col-sm-2" id="project-description">Tell us about your project</label>
			      	  <div class="col-sm-10">
                    <textarea id="summernote" name="project-description" required></textarea>
                     <script>
                       $('#summernote').summernote({
                         placeholder: "Brief Project Summary",
                         tabsize: 2,
                         height: 200
                       });
                       //prevent form resubmission when page is refreshed
                       if ( window.history.replaceState ) {
                          window.history.replaceState( null, null, window.location.href );
                       }
                     </script>
			      	    </div>
			      	</div>
			      	<div class="form-group">        
			      	  <div class="col-sm-offset-2 col-sm-10">
			      		<button type="submit" class="btn btn-default" id="btn" name="submit">Submit</button>
               </form>
			   	   </div>
            </div>
          </div>
        </div>
      </div>
      <!-- dummy partners -->
            <section>
                <div class="rt-container">
                      <div class="col-rt-12">
                          <a name="clients"><h3 style="text-align: center;">Our <span style="color:#353260;font-weight:bold;">partners</</h3></a>
                          <br><br>
                           <section class="customer-logos slider">
                              <div class="slide"><img src="../images/dummy-prev-clients/comp1.png"></div>
                              <div class="slide"><img src="../images/dummy-prev-clients/comp2.png"></div>
                              <div class="slide"><img src="../images/dummy-prev-clients/comp3.png"></div>
                              <div class="slide"><img src="../images/dummy-prev-clients/comp4.png"></div>
                              <div class="slide"><img src="../images/dummy-prev-clients/comp5.png"></div>
                              <div class="slide"><img src="../images/dummy-prev-clients/comp6.png"></div>
                              <div class="slide"><img src="../images/dummy-prev-clients/comp7.png"></div>
                              <div class="slide"><img src="../images/dummy-prev-clients/comp8.png"></div>
                           </section>
               		   </div>
                  </div>
            </section>
        </div>
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

	(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
  })()
</script>
