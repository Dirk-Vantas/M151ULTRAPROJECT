<?php

//Author    : Gideon Watson
//Date      : 10/03/2022

//Here is going ot be the model of the pattern a simple DB connection object with wich we can do the sql requests
    
    $servername = "db";
    $username = "db";
    $password = "db";
    $db = "db";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }



?>