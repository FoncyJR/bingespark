<?php

include("../conn.php");

$handle = fopen('1aMovie-DataSet2_final.csv', 'r');

if ($handle == FALSE) {
    echo "CANNOT FIND FILE";
    exit();
}

while (($data = fgetcsv($handle)) !== FALSE) {

    //print_r($data);
    $filmarray = $data[0];
    $genrearray = $data[1];
    $directorarray = $data[2];
    $actorarray = $data[3];
    $yearReleasedarray = $data[4];
    $runtimearray = $data[5];
    $revenuearray = $data[6];

    $genre = explode("," , $genrearray);
    $actors = explode("," , $actorarray);
    $directors = explode("," , $directorarray);

    $arrtitle = array($filmarray);
    $arryear = array($yearReleasedarray);
    
    //print_r($arrtitle);

    foreach ($arrtitle as $filmname) {
        foreach($arryear as $year){

        

        echo "<p> $filmname</p>";
        echo "<p> $year";

         $endpoint = "http://www.omdbapi.com/?apikey=fa4b17b4&t=$filmname&y=$year";
        //$endpoint = "http://www.omdbapi.com/?apikey=fa4b17b4&t=$filmname";

        $response = file_get_contents($endpoint);

        if (!$response) {
            echo $conn->error;
        }

        $allfilmdata = json_decode($response, true);

        if (empty($yearReleasedarray)) {
            $apiyear = $allfilmdata["Year"];
            $yearReleasedarray = $apiyear;
        }
        $yearReleasedarray = trim($yearReleasedarray, "'");
        $yearReleasedarray = trim($yearReleasedarray);
        $yearReleasedarray = mysqli_real_escape_string($conn, $yearReleasedarray);


        if (empty($runtimearray)) {
            $apiruntime = $allfilmdata["Runtime"];
            $runtimearray = $apiruntime;
            $runtimearray = trim($runtimearray, " min");
        }

        // taking care of the ' and white space  
        $runtimearray = trim($runtimearray, "'");
        $runtimearray = trim($runtimearray);
        $runtimearray = mysqli_real_escape_string($conn, $runtimearray);

        // getting and sanitising the revenue, converting to a number
        if ($revenuearray < 1 || empty($revenuearray)) {
            $apirevenue = $allfilmdata["BoxOffice"];
            $revenuearray = floatval(preg_replace("/[^-0-9\.]/", "", $apirevenue));
            $revenuearray = ($revenuearray / 1000000);
            $revenuearray = round($revenuearray, 2);
            
        }

        //print_r($allfilmdata);

        // getting the poster from the API array
        $poster = $allfilmdata["Poster"];


        // trimming the film plot and passing through RES
        $plot = $allfilmdata["Plot"];
        $plot = mysqli_real_escape_string($conn, $plot);

        // trimming the film name and passing through RES
        $filmtrim = trim($filmarray);
        $filmtrim = mysqli_real_escape_string($conn, $filmtrim);




        // START OF FILM TABLE INSERT ------------------------------------------------------------------------   
        // Insert Films, Rev, Runtime, ReleaseYear to Film Table Replaced $filmarray with $filmtrim in the INSERT statement, threw up new error
        $populate_film_table = "INSERT INTO bs_film (film_id, film_name, revenue, runtime, release_year, poster, plot) VALUES (null, '$filmtrim', '$revenuearray', '$runtimearray', '$yearReleasedarray', '$poster', '$plot') ";
        //echo "<p> $insert_film_rev_run_year </p>";
        // creating statement query
        $insertfilm = $conn->query($populate_film_table);

        // Error check and echo 
        if (!$insertfilm) {
            echo $conn->error;
            exit();
        }

        $insertedFilmId = $conn->insert_id;



        //Start of Genre    
        foreach ($genre as $genretrim) {

            $genresing = trim($genretrim, "'");
            $genresing = trim($genresing);
            $genresing = mysqli_real_escape_string($conn, $genresing);

            if ($genresing == 'Romance Movies' || $genresing == 'Romantic') {
                $genresing = 'Romance';
            }

            if ($genresing == 'Classic Movies') {
                $genresing = 'Classic';
            }

            if ($genresing == 'Dramas') {
                $genresing = 'Drama';
            }

            if ($genresing == 'Thrillers') {
                $genresing = 'Thriller';
            }
            $check = "SELECT * FROM bs_genre WHERE genre ='$genresing' ";
            $checkq = $conn->query($check);
            if (!$checkq) {
                echo $conn->error;
                echo $checkq;
                exit();
            }
            if ($checkq->num_rows == 0) {
                $insert = "INSERT INTO bs_genre (genre_id, genre) VALUES ( null, '$genresing')";
                $insertq = $conn->query($insert);
                //echo "<p> $data1 </p>";
                if (!$insertq) {
                    echo $conn->error;
                    echo $insert;
                    exit();
                }
            } // end of if num rows

            $getGenres = "SELECT * FROM bs_genre WHERE genre = '$genresing' ";
            $res = $conn->query($getGenres);

            if (!$res) {
                echo $conn->error;
                exit();
            }

            $row = $res->fetch_assoc();
            $genre_id = $row['genre_id'];
            $insertMany = "INSERT INTO bs_film_genre (film_id, genre_id) VALUES ('$insertedFilmId' , '$genre_id')";

            $insertManyRes = $conn->query($insertMany);
            if (!$insertManyRes) {
                echo $conn->error;
                exit();
            }
        } // end of genre for each 


        //Start of Actor 
        foreach ($actors as $actortrim) {

            $actorsing = trim($actortrim, "'");
            $actorsing = trim($actorsing);
            $actorsing = mysqli_real_escape_string($conn, $actorsing);

            $check = "SELECT * FROM bs_actor WHERE actor_name ='$actorsing' ";
            $checkq = $conn->query($check);
            if (!$checkq) {
                echo $conn->error;
                echo $checkq;
                exit();
            }
            if ($checkq->num_rows == 0) {
                $insert = "INSERT INTO bs_actor (actor_id, actor_name) VALUES ( null, '$actorsing')";
                $insertq = $conn->query($insert);
                //echo "<p> $data1 </p>";
                if (!$insertq) {
                    echo $conn->error;
                    echo $insert;
                    exit();
                }
            } // end of if num rows

            $getActors = "SELECT * FROM bs_actor WHERE actor_name = '$actorsing' ";
            $res = $conn->query($getActors);

            if (!$res) {
                echo $conn->error;
                exit();
            }

            $row = $res->fetch_assoc();
            $actor_id = $row['actor_id'];
            $insertMany = "INSERT INTO bs_film_actor (film_id, actor_id) VALUES ('$insertedFilmId', '$actor_id')";

            $insertManyRes = $conn->query($insertMany);
            if (!$insertManyRes) {
                echo $conn->error;
                exit();
            }
        } // end of actor for each 


        //Start of Director
        foreach ($directors as $directortrim) {

            $directorsing = trim($directortrim, "'");
            $directorsing = trim($directorsing);
            $directorsing = mysqli_real_escape_string($conn, $directorsing);

            $check = "SELECT * FROM bs_director WHERE director_name ='$directorsing' ";
            $checkq = $conn->query($check);
            if (!$checkq) {
                echo $conn->error;
                echo $checkq;
                exit();
            }
            if ($checkq->num_rows == 0) {
                $insert = "INSERT INTO bs_director (director_id, director_name) VALUES ( null, '$directorsing')";
                $insertq = $conn->query($insert);
                //echo "<p> $data1 </p>";
                if (!$insertq) {
                    echo $conn->error;
                    echo $insert;
                    exit();
                }
            } // end of if num rows

            $getDirectors = "SELECT * FROM bs_director WHERE director_name = '$directorsing' ";
            $res = $conn->query($getDirectors);

            if (!$res) {
                echo $conn->error;
                exit();
            }

            $row = $res->fetch_assoc();
            $director_id = $row['director_id'];
            $insertMany = "INSERT INTO bs_film_director (film_id, director_id) VALUES ('$insertedFilmId', '$director_id')";

            $insertManyRes = $conn->query($insertMany);
            if (!$insertManyRes) {
                echo $conn->error;
                exit();
            }
        } // end of director for each 

    }
     } // delete if deleting for each within for each
}