<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>IT Personality Quiz | Semaphore</title>
        <link rel="stylesheet" href="style/quiz.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@700&display=swap" rel="stylesheet"> 
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body>
        <div class="banner">
            <ul>
                <div class="floatleft">
                     <li><h5>SEMAPHORE</h5></li>
                </div>
                <div class="floatright">
                    <li class="contact"><img src="../images/login/contact/phone.png"></li>
                    <li class="contact"><p>+63 906 416 9206</p></li>
                    <li class="contact"><img src="../images/login/contact/email.png"></li>
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
                           echo "<li><a href='../client/home.php'>Home</a></li>";
                           echo "<li><a href='../client/feedback.php'>Feedback</a></li>";
                           echo "<li><a href='../client/home.php'>Register a Project</a></li>";
                           echo "<div class='dropdown'>
                              <li class='menu-nav'><i class='arrow down'></i></li>
                                 <div class='dropdown-content'>
                                   <p><a href='../about_us.php'>About Us</a></p>
                                   <p><a href='settings.php'>Settings</a></p>
                                   <p><a href='../logout.php'>Log out</a></p>
                                 </div>
                           </div>";
                        }else{
                           echo "<li><a href='../index.php'>Sign In</a></li>";
                           echo "<li><a href='../register.php'>Register</a></li>";
                           echo "<li><a href='../feedback.php'>Feedback</a></li>";
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
        <center>
        <div class="sub-banner">
            <img src="img/banner.png" class="img">
            <h4>What's Your IT Personality?</h4>
            <p>Just like in life, in IT, people exhibit different personality types. Take this quiz to find out what your IT</p> 
            <p>personality is and we'll show your results.</p>
            <a href="#button" class="to-bottom">Take the quiz now</a>
        </div>

       <a name="button"><img src="img/banner2.png" class="img2"></a>
        <div class="main">
            <form action="ITPersonalityQuizResult.php" method="post">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><img class="icon" src="img/name.png"></span>
                  </div>
                  <?php
                        if (! empty($_SESSION['logged_in'])){
                             include '../connection/connect.php';
                            $sql_select = "SELECT * FROM tb_users WHERE email = '$_SESSION[email]'";
                            $result = mysqli_query($conn, $sql_select);

                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_assoc($result)){
                                            $fname = $row["fname"] ;
                                            $lname = $row["lname"] ;
                                }
                            //name is provided is user is login
                            echo "<input type='text' class='form-control' name='name' value='$fname $lname' disabled required>";
                        }
                      }else{
                            //ask name if user is not login
                            echo "<input type='text' class='form-control' placeholder='Hello! What is your name?' name='name' required>";
                      }
                  ?>
                </div>
                <h6>Instructions: Answer each of the questions below honestly about yourself and we'll score the quiz
                    and let you know what is your IT Personality.
                </h6>

                <!--questions-->
                    <p>1. Are you a good communicator?</p>
                     <label><input type="radio" name="q1" value=5 required /> Yes all the time</label>
                     <label><input type="radio" name="q1" value=4 /> Yes, usually</label>
                     <label><input type="radio" name="q1" value=3 /> Sometimes</label>
                     <label><input type="radio" name="q1" value=2 /> No, never</label>
                     
                     <p>2. How would you describe your problem solving skills?</p>
                     <label><input type="radio" name="q2" value=5 required /> Excellent</label>
                     <label><input type="radio" name="q2" value=4 /> Good</label>
                     <label><input type="radio" name="q2" value=3 /> Everage</label>
                     <label><input type="radio" name="q2" value=2 /> Bad</label>

                     <p>3. You work well in a team...</p>
                     <label><input type="radio" name="q3" value=5 required /> Always</label>
                     <label><input type="radio" name="q3" value=4 /> Most of the time</label>
                     <label><input type="radio" name="q3" value=3 /> Sometimes</label>
                     <label><input type="radio" name="q3" value=2 /> Never</label>

                     <p>4. Your creative skills are..</p>
                     <label><input type="radio" name="q4" value=5 required /> Excellent</label>
                     <label><input type="radio" name="q4" value=4 /> Very good</label>
                     <label><input type="radio" name="q4" value=3 /> Good</label>
                     <label><input type="radio" name="q4" value=2 /> Bad</label>

                     <p>5. Select which statement best applies to you</p>
                     <label><input type="radio" name="q5" value=5  required /> Can work well under pressure and prioritize work</label>
                     <label><input type="radio" name="q5" value=4 /> An ability to understand data and how it will be used</label>
                     <label><input type="radio" name="q5" value=3 /> A business outcome approach, and an understanding of user needs</label>
                     <label><input type="radio" name="q5" value=2 /> A capacity to bring a project on time to a specification price and quality regardless of hurdles encountered </label>
                     <label><input type="radio" name="q5" value=1 /> Able to explain complex concepts clearly</label>

                     <p>6. Do you see yourself in a leadership role?</p>
                     <label><input type="radio" name="q6" value=5 required /> Yes</label>
                     <label><input type="radio" name="q6" value=4 /> No</label>

                     <p>7. Do you think logically and Analytically?</p>
                     <label><input type="radio" name="q7" value=5 required /> All the time</label>
                     <label><input type="radio" name="q7" value=4 /> Most of the time yes</label>
                     <label><input type="radio" name="q7" value=3 /> This usually applies to me</label>
                     <label><input type="radio" name="q7" value=2 /> This rarely applies to me</label>
                     <label><input type="radio" name="q7" value=1 /> No, never</label>

                     <p>8. Would you prefer a highly technical role?</p>
                     <label><input type="radio" name="q8" value=5 required /> Definitely</label>
                     <label><input type="radio" name="q8" value=4 /> Yes, most likely</label>
                     <label><input type="radio" name="q8" value=3 /> I guess</label>
                     <label><input type="radio" name="q8" value=2 /> Definitely not</label>

                     <p>9. Do you enjoy management roles?</p>
                     <label><input type="radio" name="q9" value=5 required /> Yes, very much</label>
                     <label><input type="radio" name="q9" value=4 /> Yes</label>
                     <label><input type="radio" name="q9" value=3 /> Doesn't bother me</label>
                     <label><input type="radio" name="q9" value=2 /> No</label>

                     <p>10. which are you more comfortable with?</p>
                     <label><input type="radio" name="q10" value=5 required /> Helping others with basic hardware and sofware technology.</label>
                     <label><input type="radio" name="q10" value=4 /> Testing networks for security loopholes.</label><br>
                     <label><input type="radio" name="q10" value=3 /> Analyzing user behavior and data to identify cybersecurity threats</label><br>
                     <label><input type="radio" name="q10" value=2 /> Creating and developing new applications with Linux.</label><br>
                     <label><input type="radio" name="q10" value=1 /> Charge of leading teams, defining goals, communicating with stakeholders, and seeing a project through to its closure.</label><br>
                     <button type="submit" name="submit-quiz" class="btn btn-success btn-md pl-5 pr-5" id="btn">SUBMIT QUIZ</button>
            </form>
          </div>
           <footer>
                © 2021 Semaphore. All righs reserved.
                 <br><br>
                Created by Martinez, Rikki Mae &middot;   Rario, Marianne &middot;  Marquez, Jennifer &middot;  Carillo, Aaron &middot; Dela Cruz, Johnvic
            </footer>
       </center>
    </body>
</html>