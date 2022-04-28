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
$file = fopen("../Movie-DataSet2_final.csv", 'r');

if ($file === false) {
  echo "Cannot open the file" . $file;
  exit();
}

while (($line = fgetcsv($file)) !== false) {



  // assigning each line of csv to a variable array
  $titlearray = $line[0];
  $genrearray = $line[1];
  $directorarray = $line[2];
  $actorarray = $line[3];
  $yeararray = $line[4];
  $runtimearray = $line[5];
  $revenuearray = $line[6];



  // changing date format to fit db MIGHT BE USEFUL FOR USER DOB
  // $bits = explode('/', $release);
  // $release = "$bits[2],-$bits[1]-$bits[0]";

  // splitting data from line into arrays
  foreach ($line as $title) {

    $title = explode(",", $titlearray);
  }

  foreach ($line as $genre) {

    $genre = explode(",", $genrearray);
  }

  foreach ($line as $director) {

    $director = explode(",", $directorarray);
  }

  foreach ($line as $actor) {

    $actor = explode(",", $actorarray);
  }

  foreach ($line as $year) {

    $year = explode(",", $yeararray);
  }

  foreach ($line as $runtime) {

    $runtime = explode(",", $runtimearray);
  }

  foreach ($line as $revenue) {
    $revenue = explode(",", $revenuearray);
  }


  // print_r($title);
  // print_r($genre);
  // print_r($director);
  print_r($actor);
  // print_r($year);
  // print_r($runtime);
  // print_r($revenue);

  // tidying split data
  // trim white space


  // pass through realescapestring



  // sql statements
  $insertlinemovie = "INSERT INTO movie (title, release_year, runtime, revenue) VALUES ('$title', '$year', '$runtime', '$revenue');";
  $insertlineactor = "INSERT INTO actor (actor) VALUES ('$actor');";
  $insertlinedirector = "INSERT INTO director (director) VALUES ('$director');";
  $insertlinegenre = "INSERT INTO genre (genre) VALUES ('$genre');";


  // duplicates
  $duplicate = "SELECT * FROM bingespark_test WHERE title = '$title'";
  $check = $conn->query($duplicate);

  // if ($check->num_rows == 0) {

  //   $statementmovie = $conn->query($insertlinemovie);
  //   $statementactor = $conn->query($insertlineactor);
  //   $statementdirector = $conn->query($insertlinedirector);
  //   $statementgenre = $conn->query($insertlinegenre);


  //   if (!$statement) {
  //     echo "<div> SQL error -" . $conn->error . "</div>";
  //   }
  // } else {
  //   echo "<div>duplicate found at $title so don't insert row</div>";

  //   $titleduplicate = "$line[0] ($year)";
  //   // sql statements
  //   $insertlinemovie = "INSERT INTO movie (title, release_year, runtime, revenue) VALUES ('$title', '$year', '$runtime', '$revenue');";

  //   echo "$titleduplicate";
  //   $statementmovie = $conn->query($insertlinemovie);
  // }
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