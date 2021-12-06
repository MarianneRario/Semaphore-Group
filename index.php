<?php
include 'connection/connect.php';
// A session is a way to store information (in variables) to be used across multiple pages.
// Unlike a cookie, the information is not stored on the users computer.
session_start();
if(isset($_POST['login'])){
  // mysqli_real_escape_string() - Escapes special characters in a string for use in an SQL statement
  // usually enough to avoid SQL injection
  // When you view your data in the database after a successful insert, having escaped it with mysql_real_escape_string(), you will not see the backslashes in the database. This is because the escaping backslashes are only needed in the SQL query statement. mysql_real_escape_string() sanitizes it for insert (or update, or other query input) but doesn't result in a permanently modified version of the data when it is stored.
  // source: https://stackoverflow.com/questions/10406895/clarification-on-mysqli-real-escape-string-storing-in-database
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

     if($email != '' && $password != ''){
        //  count() - bilangin nya errors
       if(count($errors) == 0){
           $password = md5($password); //descrypt password
           $query = "SELECT * FROM tb_users WHERE email = '$email' AND password = '$password'";
        // mysqli_query() - does not actually return the result of the query only the number that identifies the result set
           $result = mysqli_query($conn, $query);
           //  mysqli_num_rows() - returns integer; how many rows have been returned by a select query.
           if (mysqli_num_rows($result) == 1){
            // mysqli_fetch_assoc() function returns an associative array which contains the current row of the result object. This function returns NULL if there are no more rows.
                $row = mysqli_fetch_assoc($result); //ROW ARRAY
                $user_type = $row['user_type'];
                
                //admin user
                if($user_type == "admin"){
                    $_SESSION['logged_in'] = true;
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $password;

                    $_SESSION['user_type'] = $user_type;
                    header('location: admin/dashboard.php');
                }
                //client user
               else {
               $_SESSION['logged_in'] = true;
               $_SESSION['email'] = $email;
               $_SESSION['password'] = $password;

               $_SESSION['user_type'] = $user_type;
               header('location: client/home.php');
            }
           } else{      //incorrect username or password
                echo '<script type"text/javascript">';
                echo 'alert("Incorrect email or password")';
                header("Refresh:0;url=index.php");
                echo '</script>';
           }
       }
   }else{  //empty input text box 
       echo '<script type"text/javascript">';
       echo 'alert("Please enter your email or password")';
       header("Refresh:0;url=index.php");
       echo '</script>';
   }
}

    //login page is not accessible if user already login
     if (! empty($_SESSION['logged_in']) && ($_SESSION['user_type']) == "admin"){
               header('location: admin/dashboard.php');
     }elseif(! empty($_SESSION['logged_in']) && ($_SESSION['user_type']) == "client"){
               header('location: client/home.php');
     }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Semaphore | IT Solutions Provider</title>
        <link rel="stylesheet" href="css/index.css">
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
                <li><a href="register.php">Register</a></li>
                <li><a href="ITPersonalityQuiz/SemaphoreITPersonalityQuiz.php">IT Personality Quiz</a></li>
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
                <li><a href="feedback.php">Feedback</a></li>
            </ul>
        </div>
        <center>
            <div class="main">
                <img src="images/login/main-banner.gif">
                <p>Leading Global <lable class="p1">IT <br>
                Solutions</lable> Provider <br>
                <lable class="p2">We help Businesses with, Web, Mobile app and <br>
                Software Development</lable></p>
                </p>
                  <form action="index.php" method="post">
                     <ul>
                        <li><input type="text" placeholder="Email" name="email" required></li>
                        <li><input type="password" placeholder="Password" name="password" required></li>
                        <li><button type="submit" name="login">Log In</button><hr></li>
                     </ul>
                 </form>
                 <div class="register">
                     <a href="register.php"><button class="btn-register">Register now</button></a>
                 </div>
             </div>
        </center>
    </body>
</html>