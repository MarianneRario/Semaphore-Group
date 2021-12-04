<?php
   session_start();
//    DEVELOPMENT
//    $username = "";
//    $email = "";

//    REMOTE
    $server = "remotemysql.com";
    $username = "DvCvy5s93e";
    $password = "R1PBw2P1VI";
    $db_name = "DvCvy5s93e";

   $errors = array();
   /**
    * CONNECT TO THE DATABASE
    */
   
   $db = mysqli_connect($server,$username,$password,$db_name);
   
   /**
    * REGISTER USER
    */
   //IF THE REGISTER BUTTON IS CLICKED
   if(isset($_POST['register'])) {
       $name = mysqli_real_escape_string($db, $_POST['name']);
       $username = mysqli_real_escape_string($db, $_POST['username']);
       $email = mysqli_real_escape_string($db, $_POST['email']);
       $password1 = mysqli_real_escape_string($db, $_POST['password']);
       $password2 = mysqli_real_escape_string($db, $_POST['confirm_password']);

       //TO AVOID DUPLICATE USERS
       $check_duplicate_username = "SELECT username FROM users WHERE username = '$username' ";
       $result = mysqli_query($db, $check_duplicate_username);
       $resultCount = mysqli_num_rows($result); //integer
       if($resultCount > 0){
            array_push($errors, "Username is already taken.");
       }

        //TO AVOID DUPLICATE EMAIL
       $check_duplicate_email = "SELECT email FROM users WHERE email = '$email' ";
       $result = mysqli_query($db, $check_duplicate_email);
       $resultCount = mysqli_num_rows($result); //integer
       if($resultCount > 0){
            array_push($errors, "Email is already taken.");
       }
   
       //ERROR MESSAGES FROM REGISTRATION PAGE
       if(empty($name)) {
           array_push($errors, "First name is required");
       }
       if(empty($username)) {
           array_push($errors, "Username is required");
       }
       if(empty($email)) {
           array_push($errors, "Email is required"); 
       }
       if(empty($password1)) {
           array_push($errors, "Password is required"); 
       }
       if($password1 != $password2){
           array_push($errors, "Password do not match");
       }
       //SAVE USER FROM THE DATABASE IF THERE IS NO ERROR
       if(count($errors) == 0){ //integer return type
           $password = $password1;
           $sql = "INSERT INTO users (name, username, email, password)
                   VALUES ('$name', '$username', '$email', '$password')";
           mysqli_query($db, $sql);
   
        header('Location: save.php');
       }
   }
   