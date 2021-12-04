<?php

    // DEVELOPMENT
    // $server = "localhost";
    // $username = "root";
    // $password = "";
    // $db_name = "project";

    // REMOTE
    $server = "remotemysql.com";
    $username = "DvCvy5s93e";
    $password = "R1PBw2P1VI";
    $db_name = "DvCvy5s93e";

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