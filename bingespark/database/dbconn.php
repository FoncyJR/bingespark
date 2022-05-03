<?php

//  $server = $SERVER["REMOTE_ADDR"];

//     if ($server == '127.0.0.1' || $server == '::1') {
          //local credentials
          $host = "localhost";
          $user = "root";
          $pw = "root"; //MAMP
          //$pw = ""; //XAMPP
          $db = "bingespark_test_b";

    // } else {
    //       //remote credentials
    //       $host = "mcondren03.webhosting6.eeecs.qub.ac.uk";
    //       $user = "mcondren03";
    //       $pw = "Y5NxF7mMJ0pMp266";
    //       $db = "mcondren03";

    // }

$dbconn = new mysqli($host, $user, $pw, $db);

    if ($dbconn->connect_error) {

      $check = "not connected " . $dbconn->connect_error;
    } else {

      $check = "Connected to your mysql DB.";
    }
