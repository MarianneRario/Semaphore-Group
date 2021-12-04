<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $db_name = "project";
    $errors = array();

    //create connection
    $conn = mysqli_connect($server,$username,$password,$db_name);

    //checking connection
    if(!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }else{
       // echo "Connected successfully" ."<br>";
    }
?>