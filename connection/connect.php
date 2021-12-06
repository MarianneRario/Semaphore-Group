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

    // 
    $errors = array();

    // mysqli_connect() - creates connection 
    $conn = mysqli_connect($server,$username,$password,$db_name);

    // if no connection established, die()
    if(!$conn){
        // die() - It prints a message and exit the current script
        die("Connection failed: " . mysqli_connect_error());
    }
?>

