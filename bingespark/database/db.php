<?php
 
 $host = "localhost";
 $user = "root";
 //$pw = ""; //MAMP
 $pw = "root"; //XAMPP
 $db = "webdev";
 
 $conn = new mysqli($host, $user, $pw, $db);
 
 if ($conn->connect_error) {
 
      $check = "not connected ".$conn->connect_error;
 
        }else{
 
     $check="Connected to your mysql DB.";
 
 }
 
?>