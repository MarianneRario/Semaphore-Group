<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Feedback - Semaphore</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/feedback.css">
        <!-- fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
        <!-- bootstrap -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </head>
    <body>
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
                                            $id = $row["id"] ;
                                            $fname = $row["fname"] ;
                                            $lname = $row["lname"] ;
                                            $email = $row["email"] ;
                                            $phone = $row["contact_number"] ;
                                }
                            }
                            ?>
                           
                            <li class="menu-nav"><a href="home.php">Home</a></li>
                            <li class="menu-nav"><a href="../ITPersonalityQuiz/SemaphoreITPersonalityQuiz.php">IT Personality Quiz</a></li>
                            <li class="menu-nav"><a href="../about_us.php">About Us</a></li>
                            <li class="menu-nav"><a href="contact.php">Feedback</a></li>
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

                     //if send button was clicked
                     if(isset($_POST['send'])){
                         $comment = mysqli_real_escape_string($conn,$_POST['comment']);

                         //make sure comment is not empty
                         if($comment != ''){
                            $query = "INSERT INTO tb_feedbacks (id_user,fname,lname,email,contact_number,comment)VALUES
                            ('$id','$fname','$lname','$email','$phone','$comment')";

                             if(mysqli_query($conn,$query)){
                               echo '<script type="text/javascript">';
                               echo 'alert("Thank you for getting in touch with Semaphore.")';
                               echo '</script>';
                               header("Refresh:0;url=feedback.php");
                             }else{
                                   echo "ERROR: Could not able to execute $query. " . 
                                // The error / mysqli_error() function returns the last error description for the most recent function call, if any.
                                   mysqli_error($conn);
                            }
                         }else{
                              echo '<script type="text/javascript">';
                              echo 'alert("Please fill the comment section.")';
                              echo '</script>';
                              header("Refresh:0;url=feedback.php");
                         }
                     }
                    ?>
                </div>
            </ul>
        </div>

    <!-- feedback form -->
    <div class="wrapper bg-white mt-sm-5">
        <h3 class="pb-4 border-bottom">Feedback</h3>
        <h6 class="pb-4 border-bottom" id="sub">Thank you for your interest in Semaphore. Please send us a message to ask a question
        or report a technical problem.</h6>
        <div class="py-2">

          <form action="feedback.php" method="post">
            <div class="row py-2">
                <div class="col-md-6"> 
                 <label>First Name</label> 
                    <input type="text" class="bg-light form-control" name="firstname" id="auto" value="<?php echo $fname;?>" disabled>
                </div>
                    <div class="col-md-6 pt-md-0 pt-3"> 
                 <label>Last Name</label>
                   <input type="text" class="bg-light form-control" name="lastname" id="auto" value="<?php echo $lname;?>" disabled>
                </div>
            </div>

            <div class="row py-2">
                <div class="col-md-6"> 
                    <label>Email Address</label>
                     <input type="text" class="bg-light form-control" name="email" id="auto" value="<?php echo $email;?>" disabled> 
                 </div>
                <div class="col-md-6 pt-md-0 pt-3">
                   <label>Phone Number</label>
                     <input type="tel" class="bg-light form-control" name="phone" id="auto" value="<?php echo $phone;?>" disabled> 
                </div>
            </div>

            <div class="row py-2">
                <div class="col-md-12"> <label>Comment <span style="color: red;">*</span></label> 
                   <div class="form-group">
                         <textarea class="form-control" name="comment" maxlength=500 id="exampleTextarea" rows="3" required></textarea>
                   </div>
                </div>
            </div>
            <div class="py-2 mb-1"> 
                <button class="btn btn-primary mr-3" name="send">Submit</button><!-- SAVE BUTTON -->
            </div>
          </form>

                <div class="d-sm-flex align-items-center mt-4 pt-3 border-top" id="deactivate">
                    <div>
                        <p>Required fields are marked with an asterisk (*).</p>
                    </div>
                    <div class="ml-auto">
                        <button class="btn danger" onclick="location.href='home.php'" type="button">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
  </body>
</html>