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


// reading csv file and adding to db
$file = fopen("./csv/Movie-DataSet2_final.csv", 'r');

if ($file === false) {
  echo "Cannot open the file".$file;
  exit();
}

while (($line = fgetcsv($file)) !== false) {
  // // read data from a single line
  // echo "<div> - INSERT INTO bingespark_test (laptopModel, currentPrice, launchDate) VALUES ($line[0], $line[1], $line[2]); </div>";

  // assigning each line of csv to a variable array
  $titlearray = $line[0];
  $genrearray = $line[1];
  $directorarray = $line[2];
  $actorarray = $line[3];
  $yeararray = $line[4];
  $runtimearray = $line[5];
  $revenuearray = $line[6];

                                            // // changing date format to fit db MIGHT BE USEFUL FOR USER DOB
                                            // $bits = explode('/', $release);
                                            // $release = "$bits[2],-$bits[1]-$bits[0]";

  // splitting data from arrays
  $genre = explode(",", $genrearray);
  $actor = explode(",",$actorarray);
  $director = explode(",",$directorarray);



  // sql statements
  $insertlinemovie = "INSERT INTO movie (title, release_year, runtime, revenue) VALUES ('$title', '$year', '$runtime', '$revenue');";
  $insertlineactor = "INSERT INTO actor (actor) VALUES ('$actor');";
  $insertlinedirector = "INSERT INTO director (director) VALUES ('$director');";
  $insertlinegenre = "INSERT INTO genre (genre) VALUES ('$genre');";


  // duplicates
  $duplicate = "SELECT * FROM bingespark_test WHERE title = '$title'";
  $check = $conn->query($duplicate);

  if ($check->num_rows == 0) {

    $statementmovie = $conn->query($insertlinemovie);
    $statementactor = $conn->query($insertlineactor);
    $statementdirector = $conn->query($insertlinedirector);
    $statementgenre = $conn->query($insertlinegenre);
    

    if (!$statement) {
      echo "<div> SQL error -" . $conn->error . "</div>";
    }
  } else {
    echo "<div>duplicate found at $title so don't insert row</div>";

    $titleduplicate = "$line[0] ($year)";
    // sql statements
    $insertlinemovie = "INSERT INTO movie (title, release_year, runtime, revenue) VALUES ('$title', '$year', '$runtime', '$revenue');";

    echo "$titleduplicate";
    $statementmovie = $conn->query($insertlinemovie);
  }
}


fclose($file);

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