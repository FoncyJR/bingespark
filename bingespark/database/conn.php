<?php

// $server = $SERVER["REMOTE_ADDR"];

// echo $server . "<br>";

// if ($server == '127.0.0.1' || $server == '::1') {
  //local credentials
  $host = "localhost";
  $user = "root";
  $pw = "root"; //MAMP
  //$pw = ""; //XAMPP
  $db = "bingespark_test";

// } else {
//   //remote credentials
//   $host = "mcondren03.webhosting6.eeecs.qub.ac.uk";
//   $user = "mcondren03";
//   $pw = "Y5NxF7mMJ0pMp266";
//   $db = "mcondren03";
  
// }

$conn = new mysqli($host, $user, $pw, $db);

if ($conn->connect_error) {

  $check = "not connected " . $conn->connect_error;
} else {

  $check = "Connected to your mysql DB.";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  include("partials/head.php")
  ?>
  <title>Document</title>
</head>

<body>
  <div class="container">
    <h1 class="title">
      <?php
      echo $check;
      ?>
    </h1>

    <p class="subtitle">

    </p>

  </div>
</body>

</html>