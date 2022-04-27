<?php

$host = "localhost";
$user = "root";
$pw = ""; //MAMP
//$pw = "root"; //XAMPP
$db = "bingespark_test";

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