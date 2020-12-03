<?php

   //creating database connection
   $conn = new mysqli("localhost","root","","tapir_grocer");
   
   // Checking connection
    if($conn == false) {
        die("ERROR: Could not connect. " . $conn->connect_error );
    }
?>
