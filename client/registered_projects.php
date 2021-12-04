<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>My Registered Projects - Semaphore</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="css/projects.css">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet"> 

        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

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
                        include ('../connection/connect.php');
                        if (! empty($_SESSION['logged_in']) && ($_SESSION['user_type']) == "client")
                        {
                            $sql_select = "SELECT * FROM tb_users WHERE email = '$_SESSION[email]'";
                            $result = mysqli_query($conn, $sql_select);

                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_assoc($result)){
                                            $fname = $row["fname"] ;
                                            $lname = $row["lname"] ;
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
                    ?>
                </div>
            </ul>
        </div>

        <div class="container search-table">
            <div class="search-box">
                <div class="row">
                    <div class="col-md-3">
                        <p><a href="home.php"><- Go back</a></p>
                        <h5 class="sub-head">My registered Projects</h5>
                    </div>
                    <div class="col-md-9">
                        <input type="text" name="search_text" id="search_text" class="form-control" placeholder="Search by project name">
                    </div> 
                </div>
            </div>
           <div id="result"></div> 

  <footer>
   <!-- IT personality quiz -->
   	<div class="col-md-3">
    	<div class="contact-info" id="contact-hello">
				<img src="images/icons/quiz.png" alt="image"/>
				<p>
                    <a href="../ITPersonalityQuiz/SemaphoreITPersonalityQuiz.php">Take your IT Personality Quiz</a></p>
			</div>
		</div>
    <!-- Register a project -->
   	<div class="col-md-3">
    	<div class="contact-info" id="contact-hello">
				<img src="images/icons/rocket.png" alt="image"/>
				<p>
                    <a href="home.php">Register Your New Project</a></p>
			</div>
		</div>
    <!-- Feedback -->
    <div class="col-md-3">
     	<div class="contact-info" id="contact-hello">
				<img src="images/icons/feedback.png" alt="image"/>
				<p>
                    <a href="feedback.php">How Can We Help You?</a></p>
	   	    </div>
		 </div>
    <!-- Meet Our Team -->
    <div class="col-md-3">
     	<div class="contact-info" id="contact-hello">
				<img src="images/icons/aboutus.png" alt="image"/>
				<p>
                    <a href="../about_us.php">Meet Our Team</a></p>
	   	    </div>
		 </div>
    <div class="col-md-3" style="float: right;width:197px;">
     	<div class="contact-info" id="contact-hello"><br>
				<p>© 2021 Semaphore. All righs reserved.</p>
	   	    </div>
		 </div>
      </div>
     </footer>
   </body>
</html>
<script>
      $(document).ready(function(){
       load_data();
        function load_data(query)
        {
         $.ajax({
          url:"search.php",
          method:"POST",
          data:{query:query},
          success:function(data)
          {
        $('#result').html(data);
          }
         });
        }
        $('#search_text').keyup(function(){
         var search = $(this).val();
         if(search != ''){
          load_data(search);
         }else{
          load_data();
         }
        });
      });
 </script>