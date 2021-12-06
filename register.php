<?php
include 'connection/connect.php';
if(isset($_POST['submit'])){
    $firstname = mysqli_real_escape_string($conn,$_POST['fname']);
    $lastname = mysqli_real_escape_string($conn,$_POST['lname']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);
    $re_password = mysqli_real_escape_string($conn,$_POST['re-password']);
    $phone = mysqli_real_escape_string($conn,$_POST['phone']);
    $country = mysqli_real_escape_string($conn,$_POST['country']);
    $company = mysqli_real_escape_string($conn,$_POST['company']);
    $business_type = mysqli_real_escape_string($conn,$_POST['business_type']);
    $user_type = "client";

    //check if inputs are empty
    if($firstname != '' && $lastname != '' && $email != '' && $password != '' && $re_password != '' 
       && $phone != '' && $country != '' && $company != '' && $business_type != '')
    {
        //check if email is already taken
           $duplicate_email = "SELECT email FROM tb_users WHERE email = '$email' ";
           $result = mysqli_query($conn, $duplicate_email);
           $resultCount = mysqli_num_rows($result); //integer
           if($resultCount > 0){
              echo '<script type"text/javascript">';
              echo 'alert("Email is Already Taken. Please try again.")';
              echo '</script>';
              exit();

       //check if passwords match
    } if($password == $re_password){
          $sql = "INSERT INTO tb_users (fname, lname, email,password,contact_number,country,business_type,company,user_type) 
          VALUES ('$firstname','$lastname','$email',md5('$password'),'$phone','$country','$business_type','$company','$user_type')";
            if(mysqli_query($conn, $sql)){
             echo '<script type="text/javascript">';
             echo 'alert("You have successfully registered. You can log in now.")';
             echo '</script>';
             header("Refresh:0;url=index.php");
             } else{
                 echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
          }
        }else{
          echo '<script type"text/javascript">';
          echo 'alert("The two passwords do not match")'; 
          echo '</script>';
        }
   }else{
      echo '<script type="text/javascript">';
      echo 'alert("Please complete all the details!")';
      echo '</script>';
   }
}

 //register page is not accessible if user already login
     if (! empty($_SESSION['logged_in']) && ($_SESSION['user_type']) == "admin"){
               header('location: admin/dashboard.php');
     }elseif(! empty($_SESSION['logged_in']) && ($_SESSION['user_type']) == "client"){
               header('location: client/home.php');
     }

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Semaphore - Sign Up</title>
    <link rel="stylesheet" href="css/register/owl.carousel.min.css">
    <link rel="stylesheet" href="css/register/bootstrap.min.css">
    <link rel="stylesheet" href="css/register/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
 
<form class="row g-3 needs-validation" action="register.php" method="post" onsubmit="func()"novalidate>
  <div class="d-lg-flex half">
   <div class="bg order-1 order-md-2" style="background-image: url('images/register/banner.jpg');"></div>
    <div class="contents order-2 order-md-1">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7 py-5">
            <h3>Register</h3>
            <p class="mb-4" style="color:#3F474F;">Semaphore aims at building unique solutions for its clients with never ending customer services.
            With increasing collaboration rate, we tend to innovate in a way that other cannot.</p>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group first">
                    <label>First Name</label>
                    <input type="text" class="form-control" placeholder="e.g. John" name="fname" pattern="[A-Za-z\s]{1,}" required>
                    <div class="invalid-feedback"> Cannot contain numeric or special characters</div>
                  </div>    
                </div>
                <div class="col-md-6">
                  <div class="form-group first">
                    <label>Last Name</label>
                    <input type="text" class="form-control" placeholder="e.g. Smith" name="lname" pattern="[A-Za-z\s]{1,}" required>
                    <div class="invalid-feedback"> Cannot contain numeric or special characters </div>
                  </div>    
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group first">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" placeholder="e.g. john@your-domain.com" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                    <div class="invalid-feedback"> Invalid email </div>
                  </div>    
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group first">
                    <label>Phone Number</label>
                    <input type="tel" class="form-control" maxlength="11" placeholder="e.g. 09193558264" name="phone" pattern="[0-9]{11}" required>
                    <div class="invalid-feedback"> Invalid phone number </div>
                  </div>    
                </div>
                <div class="col-md-6">
                  <div class="form-group first">
                    <label>Country</label>
                    <select class="form-select" name="country">
                         <option value="Philippines" selected>Philippines</option>
                         <option value="Australia">Australia</option>
                         <option value="Bahrain">Bahrain</option>
                         <option value="Bangladesh">Bangladesh</option>
                         <option value="Canada">Canada</option>
                         <option value="China">China</option>
                         <option value="Malaysia">Malaysia</option>
                         <option value="Mexico">Mexico</option>
                         <option value="Mongolia">Mongolia</option>
                         <option value="Myanmar">Myanmar</option>
                         <option value="Nepal">Nepal</option>
                         <option value="Netherlands">Netherlands</option>
                         <option value="New Zealand">New Zealand</option>
                         <option value="Norway">Norway</option>
                         <option value="Oman">Oman</option>
                         <option value="Philippines">Philippines</option>
                         <option value="United Arab Emirates">United Arab Emirates</option>
                         <option value="United Kingdom">United Kingdom</option>
                         <option value="United States">United States</option> 
                    </select>
                  </div>    
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group last mb-3">
                    <label>Select Business Type</label>
                    <select class="form-select" name="business_type">
                    <option value="Individual" selected>Individual</option>
                    <option value="Sole Proprietorship">Sole Proprietorship</option>
                    <option value="Partnership">Partnership</option>
                    <option value="Corporation">Corporation</option>
                    <option value="Public Company">Public Company</option>
                    <option value="Private Company">Private Company</option>
                    <option value="Non Profit Organization">Non Profit Organization</option>
                    <option value="Government Entity">Government Entity</option>
                  </select>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group last mb-3">
                    <label>Company name</label>
                    <input type="text" class="form-control" placeholder="company name" name="company" minlength="1" required>
                    <div class="invalid-feedback"> Company name cannot be blank</div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group last mb-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Your Password" name="password" minlength="5" required>
                    <div class="invalid-feedback"> Minimum of 5 characters </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group last mb-3">
                    <label for="re-password">Re-type Password</label>
                    <input type="password"  class="form-control" placeholder="Your Password" name="re-password"  id="confirm_password" minlength="5" required>
                    <div class="invalid-feedback"> Password don't match </div>
                  </div>
                </div>
              </div>
              
              <div class="d-flex mb-5 mt-4 align-items-center">
                <div class="d-flex align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">Creating an account means you're okay with our <a href="#">Terms and Conditions</a> and our <a href="#">Privacy Policy</a>.</span>
                </label>
              </div>
              </div>
                 <input type="submit" name="submit" value="Register" onclick="return Validate()" class="btn px-5 btn-primary" style="background-color:#218838;border-color:#218838;">
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </body>
</html>

<script>
function validate(evt) {
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
  // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}

</script>
	  
	  <script>
	  (function () {
  'use strict'

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

</script>
	  <script type="text/javascript">
    function Validate() {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirm_password").value;
        if (password != confirmPassword) {
            alert("Passwords do not match.");
            return false;
        }
        return true;
    }
</script>