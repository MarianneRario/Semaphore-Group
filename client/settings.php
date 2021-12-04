<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Account Settings | Semaphore</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/settings.css">
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <!-- bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script>
        //prevent  re-update when page is refreshed
              if ( window.history.replaceState ) {
                    window.history.replaceState( null, null, window.location.href );
            }
    </script>
</head>

<body>
    <div class="banner">
        <!-- MENU -->
        <ul>
            <div class="floatleft">
                <li>
                    <h3>SEMAPHORE</h3>
                </li>
            </div>
            <div class="floatright">
                <?php
                session_start();
                include('../connection/connect.php');
                if (! empty($_SESSION['logged_in']) && ($_SESSION['user_type']) == "client") {
                    $sql_select = "SELECT * FROM tb_users WHERE email = '$_SESSION[email]'";
                    $result = mysqli_query($conn, $sql_select);

                    //retrieve user info
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row["id"];
                            $fname = $row["fname"];
                            $lname = $row["lname"];
                            $email = $row["email"];
                            $phone = $row["contact_number"];
                            $country = $row["country"];
                            $business_type = $row["business_type"];
                            $company = $row["company"];
                            $password =$row["password"];
                        }
                    }

                    //IF SAVE CHANGES BUTTON WAS CLICKED
                      if(isset($_POST['save_changes'])){

                          $firstname = mysqli_real_escape_string($conn,$_POST['firstname']);
                          $lastname = mysqli_real_escape_string($conn,$_POST['lastname']);
                          $email_address = mysqli_real_escape_string($conn,$_POST['email']);
                          $phone_number = mysqli_real_escape_string($conn,$_POST['phone']);
                          $client_country = mysqli_real_escape_string($conn,$_POST['country']);
                          $company_name = mysqli_real_escape_string($conn,$_POST['company']);
                          $business = mysqli_real_escape_string($conn,$_POST['business_type']);
                            
                           //check if user left the input text blank
                            if($firstname != '' && $lastname != ''  && $email_address != ''
                               && $phone_number != '' && $client_country != '' && $company_name != '' && $business != '' ){
                      

                         //UPDATE DATA
                          $query = "UPDATE tb_users SET fname='".$firstname."',lname='".$lastname."' ,
                          email='".$email_address."',contact_number='".$phone_number."' ,country='".$client_country."',
                          company='".$company_name."' ,business_type='".$business."' WHERE id =".$id;
                          mysqli_query($conn,$query); 
                              if(mysqli_query($conn, $query)){
                                 echo '<script type="text/javascript">';
                                 echo 'alert("Your Account Details Was Updated Successfully")';
                                 echo '</script>';
                                 header("Refresh:0;url=settings.php");
                                 } else{
                                     echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
                              }
                        }else{
                         echo '<script type="text/javascript">';
                         echo 'alert("Please complete all your details!")';
                         echo '</script>';
                         header("Refresh:0;url=settings.php");                                
                        }
                    }


                    //IF CHANGE PASSWORD BUTTON WAS CLICKED
                      if(isset($_POST['change_password'])){

                      $current_password = mysqli_real_escape_string($conn,$_POST['current_password']);
                      $new_password = mysqli_real_escape_string($conn,$_POST['new_password']);
                           
                        if($current_password != '' && $new_password != ''){
                                 //make sure current password is right
                                 if(md5($current_password) == $password){
                                     //if right, update password
                                     $query = "UPDATE tb_users SET password='".md5($new_password)."' WHERE id = '$id'";
                                     mysqli_query($conn,$query); 
                                         if(mysqli_query($conn, $query)){
                                            echo '<script type="text/javascript">';
                                            echo 'alert("Your Password Was Updated Successfully")';
                                            echo '</script>';
                                            header("Refresh:0;url=settings.php");
                                            }else{
                                                echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
                                          }
                                }else{
                                 echo '<script type="text/javascript">';
                                 echo 'alert("Password does not match! Please try again.")';
                                 echo '</script>';
                                }
                           }else{
                               echo '<script type="text/javascript">';
                               echo 'alert("Please enter your current password and new password!")';
                               echo '</script>';
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
                            <p><span>Client,</span> <?php echo $fname . ', ' . $lname; ?></p>
                            <p><a href="settings.php">Settings</a></p>
                            <p><a href="../logout.php">Log out</a></p>
                        </div>
                    </div>
                <?php
                } else {
                    // access denied to this page, if user is not log in
                    header("location: ../index.php");
                    exit;
                }
                ?>
            </div>
        </ul>
    </div>

    <!-- EDIT USER INFO -->
    <div class="wrapper bg-white mt-sm-5">
        <h4 class="pb-4 border-bottom">Account settings</h4>
        <div class="py-2">

          <form class="needs-validation" action="settings.php" method="post" novalidate>
            <div class="row py-2">
                <div class="col-md-6"> 
                 <label>First Name</label> 
                    <input type="text" class="bg-light form-control" name="firstname" pattern="[A-Za-z\s]{1,}" value="<?php echo $fname;?>" required>
                    <div class="invalid-feedback"> Cannot contain numeric or special characters</div>
                </div>
                    <div class="col-md-6 pt-md-0 pt-3"> 
                 <label>Last Name</label>
                   <input type="text" class="bg-light form-control" name="lastname" pattern="[A-Za-z\s]{1,}" value="<?php echo $lname;?>" required>
                   <div class="invalid-feedback"> Cannot contain numeric or special characters</div>
                </div>
            </div>

            <div class="row py-2">
                <div class="col-md-6"> 
                    <label>Email Address</label>
                     <input type="text" class="bg-light form-control" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="<?php echo $email;?>" required> 
                     <div class="invalid-feedback"> Invalid email </div>
                 </div>
                <div class="col-md-6 pt-md-0 pt-3">
                   <label>Phone Number</label>
                     <input type="tel" class="bg-light form-control" name="phone" pattern="[0-9]{11}" value="<?php echo $phone;?>" required> 
                     <div class="invalid-feedback"> Invalid phone number </div>
                </div>
            </div>

            <div class="row py-2">
                <div class="col-md-6"> <label>Country</label> <select name="country" id="country" class="bg-light" required>
                        <option selected><?php echo $country;?></option>
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
                    </select> </div>
                <div class="col-md-6"> <label>Business Type</label> <select name="business_type" class="bg-light">
                        <option selected><?php echo $business_type;?></option>
                        <option value="Sole Proprietorship">Sole Proprietorship</option>
                        <option value="Partnership">Partnership</option>
                        <option value="Corporation">Corporation</option>
                        <option value="Public Company">Public Company</option>
                        <option value="Private Company">Private Company</option>
                        <option value="Non Profit Organization">Non Profit Organization</option>
                        <option value="Government Entity">Government Entity</option>
                    </select> </div>
            </div>
            <div class="row py-2">
                <div class="col-md-12"> <label>Company Name</label> 
                  <input type="text" name="company" class="mb-4 bg-light form-control" minlength="1" value="<?php echo $company;?>" required> 
                  <div class="invalid-feedback"> Company name cannot be blank</div>
                </div>
            </div>
            <div class="py-3 mb-5"> 
                <button class="btn btn-primary mr-3" name="save_changes">Save Changes</button><!-- SAVE BUTTON -->
            </div>
          </form>

            <!-- CHANGE PASSWORD -->
            <form action="settings.php" method="post">
                <h5 class="pb-4 border-bottom">Change Your Password</h5>
                <div class="pt-4 row py-2">
                    <div class="col-md-6"> 
                        <label>Current Password <span style="color:red;">*</span></label> 
                          <input type="password" minlength=5 name="current_password" class="bg-light form-control" required>
                    </div>
                    <div class="col-md-6 pt-md-0 pt-3"> 
                        <label>New Password <span style="color:red;">*</span></label> 
                          <input type="password" minlength=5 name="new_password" class="mb-5 bg-light form-control" required> </div>
                </div>
                <div class="py-3 pb-4 border-bottom">
                     <button class="btn btn-primary mr-3" name="change_password">Change Password</button><!-- SAVE BUTTON -->
                </div>
                <div class="d-sm-flex align-items-center pt-3" id="deactivate">
                    <div>
                        <p>Details about your semaphore account and password</p>
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
<script>
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