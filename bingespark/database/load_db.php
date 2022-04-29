<!-- // changing date format to fit db MIGHT BE USEFUL FOR USER DOB
  // $bits = explode('/', $release);
  // $release = "$bits[2],-$bits[1]-$bits[0]"; -->

<?php

// db dbconnection
include("../dbconn.php");

// declare csv as variable
$file = fopen("../Movie-DataSet2_final.csv", 'r');

// check that file can be found
if ($file === false) {
    echo "Cannot open the file. Check the filepath." . $file;
    exit();
}

// reading and cleaning csv data and putting into db
while (($line = fgetcsv($file)) !== false) {



    // assigning each line of csv to a variable array
    $title_array = $line[0];
    $genre_array = $line[1];
    $director_array = $line[2];
    $actor_array = $line[3];
    $year_array = $line[4];
    $runtime_array = $line[5];
    $revenue_array = $line[6];

    // converting data from index into a new array
    $title = array($title_array);
    $year = array($year_array);

    // splitting data from indices with multiple entries - genre, director and actor
    $genre = explode(",", $genre_array);
    $director = explode(",", $director_array);
    $actor = explode(",", $actor_array);


    // data processing
    foreach ($title as $movie) {

        foreach ($year as $movieyear) {

            // OMDB API credentials
            $endpoint_api = "http://www.omdbapi.com/?apikey=63ee3bba&t=$filmname&y=$year";

            // API data
            $data_api = file_get_contents($apiendpoint);

            if (!$data_api) {
                echo $dbconn->error;
            }

            $movie_api = json_decode($data_api, true);

            // filling in data missing from csv from api
            // release year
            if (empty($year_array)) {
                $year_api = $movie_api["Year"];
                $year_array = $year_api;
            }

            // runtime
            if (empty($runtime_array)) {
                //initial trim and tidy runtime data
                $runtime_api = $movie_api["Runtime"];
                $runtime_array = $runtime_api;
                $runtime_array = trim($runtime_array, " min");
            }

            // revenue
            if (empty($revenue_array)) {
                $revenue_api = $movie_api["BoxOffice"];
                // $revenue_array = floatval(preg_replace("/[^-0-9\.]/", "", $revenue_api));
                $revenue_array = ($revenue_array / 1000000);
                $revenue_array = round($revenue_array, 2);
            }

            // description
            $movie_desc = $movie_api["Plot"];
            $movie_desc = mysqli_real_escape_string($conn, $movie_desc);

            // thumbnail - using posters from api
            $movie_thumb = $movie_api["Poster"];


            // tidy and trim data
            $title_trim = trim($title_array);
            $title_trim = mysqli_real_escape_string($conn, $title_trim);

            $year_array = trim($year_array, "'");
            $year_array = trim($year_array);
            $year_array = mysqli_real_escape_string($dbconn, $year_array);

            $runtime_array = trim($runtime_array, "'");
            $runtime_array = trim($runtime_array);
            $runtime_array = mysqli_real_escape_string($dbconn, $runtime_array);


            // movie insert statement
            $movie_sql = "INSERT INTO movie (movie_id, title, release_year, runtime, revenue, description, thumbnail, movie_review) 
            VALUES (null, '$title_trim', '$revenue_array', '$runtime_array', '$year_array', '$movie_desc', '$movie_thumb', null) ";
            // send insert statement to db
            $movie_insert = $dbconn->query($movie_sql);








            // genre


            // director


            // actor

        } //foreach year end
    } //foreach movie end















    // print_r($title);
    // print_r($genre);
    // print_r($director);
    // print_r($actor);
    // print_r($year);
    // print_r($runtime);
    // print_r($revenue);

    // tidying split data - actors and genre
    // trim white space




    // pass through realescapestring



    // sql statements
    //   $insertlinemovie = "INSERT INTO movie (title, release_year, runtime, revenue) VALUES ('$title', '$year', '$runtime', '$revenue');";
    //   $insertlineactor = "INSERT INTO actor (actor) VALUES ('$actor');";
    //   $insertlinedirector = "INSERT INTO director (director) VALUES ('$director');";
    //   $insertlinegenre = "INSERT INTO genre (genre) VALUES ('$genre');";


    //   // duplicates
    //   $duplicate = "SELECT * FROM bingespark_test WHERE title = '$title'";
    //   $checkduplicate = $dbconn->query($duplicate);

    //   if ($checkduplicate->num_rows == 0) {

    //     $statementmovie = $dbconn->query($insertlinemovie);
    //     $statementactor = $dbconn->query($insertlineactor);
    //     $statementdirector = $dbconn->query($insertlinedirector);
    //     $statementgenre = $dbconn->query($insertlinegenre);


    //     if (!$statement) {
    //       echo "<div> SQL error -" . $dbconn->error . "</div>";
    //     }
    //   } else {
    //     echo "<div>duplicate found at $title so don't insert row</div>";

    //     $titleduplicate = "$title ($year)";
    //     // sql statements
    //     $insertlinemovie = "INSERT INTO movie (title, release_year, runtime, revenue) VALUES ('$title', '$year', '$runtime', '$revenue');";

    //     echo "$titleduplicate";
    //     $statementmovie = $dbconn->query($insertlinemovie);
    //   }

} //while loop end

// close file
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