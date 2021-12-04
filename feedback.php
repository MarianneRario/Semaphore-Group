<?php
include 'connection/connect.php';
   //if send button was clicked
   if(isset($_POST['send'])){
       $fname = mysqli_real_escape_string($conn,$_POST['firstname']);
       $lname = mysqli_real_escape_string($conn,$_POST['lastname']);
       $email = mysqli_real_escape_string($conn,$_POST['email']);
       $phone = mysqli_real_escape_string($conn,$_POST['phone']);
       $comment = mysqli_real_escape_string($conn,$_POST['comment']);
       $id = 0; // 0, if user is not log in

       //make sure fields are not empty
       if($comment != '' && $fname != '' && $lname != '' && $email != '' && $phone != ''){
           $query = "INSERT INTO tb_feedbacks (id_user,fname,lname,email,contact_number,comment)VALUES
           ('$id','$fname','$lname','$email','$phone','$comment')";

           if(mysqli_query($conn,$query)){
             echo '<script type="text/javascript">';
             echo 'alert("Thank you for getting in touch with Semaphore.")';
             echo '</script>';
             header("Refresh:0;url=feedback.php");
           }else{
                 echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
          }
       }else{
            echo '<script type="text/javascript">';
            echo 'alert("Please fill all the fields.")';
            echo '</script>';
            header("Refresh:0;url=feedback.php");
       }
   }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Feedback | Semaphore</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/feedback.css">
         <!-- font -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
        <!-- bootstrap -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="banner">
            <ul>
                <div class="floatleft">
                     <li><h3>SEMAPHORE</h3></li>
                </div>
                <div class="floatright">
                    <li class="contact"><img src="images/login/contact/phone.png"></li>
                    <li class="contact"><p id="num" style="color:white;">+63 906 416 9206</p></li>
                    <li class="contact"><img src="images/login/contact/email.png"></li>
                    <li class="contact"><p style="color:white;">semaphore@it-solutions.com</p></li>
                </div>
            </ul>
        </div>
        <div class="menu">
            <ul>
                <li><a href="index.php">Sign In</a></li>
                <div class="dropdown">
                   <li><a href="">Services &nbsp; <i class="arrow down"></i></a></li>
                      <div class="dropdown-content">
                        <p>App Development</p>
                        <p>Web Development</p>
                        <p>Digital Marketing</p>
                        <p>Software Development</p>
                      </div>
                </div>
                <li><a href="about_us.php">About Us</a></li>
                <li><a href="ITPersonalityQuiz/SemaphoreITPersonalityQuiz.php">IT Personality Quiz</a></li>
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
                 <label>First Name<span style="color: red;">*</span></label> 
                    <input type="text" class="bg-light form-control" name="firstname"  required>
                </div>
                    <div class="col-md-6 pt-md-0 pt-3"> 
                 <label>Last Name<span style="color: red;">*</span></label>
                   <input type="text" class="bg-light form-control" name="lastname"  required>
                </div>
            </div>

            <div class="row py-2">
                <div class="col-md-6"> 
                    <label>Email Address<span style="color: red;">*</span></label>
                     <input type="email" class="bg-light form-control" name="email" required> 
                 </div>
                <div class="col-md-6 pt-md-0 pt-3">
                   <label>Phone Number<span style="color: red;">*</span></label>
                     <input type="tel" class="bg-light form-control" name="phone" required>  
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
                        <button class="btn danger" onclick="location.href='index.php'" type="button">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </body>
</html>