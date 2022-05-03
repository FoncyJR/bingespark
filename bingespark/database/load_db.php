<?php

// db connection
include("dbconn.php");

// declare csv as variable
// $file = fopen("../Movie-DataSet2_final.csv", 'r');
// $file = fopen("../Movie-1.csv", 'r');
// $file = fopen("../Movie-2.csv", 'r');
// $file = fopen("../Movie-3.csv", 'r');
$file = fopen("../Movie-5.csv", 'r');

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
            // $endpoint_api = "http://www.omdbapi.com/?apikey=63ee3bba&t=$movie&y=$movieyear";
            $endpoint_api = "http://www.omdbapi.com/?apikey=90159532&t=$movie&y=$movieyear";

            // API data
            $data_api = file_get_contents($endpoint_api);

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
            $movie_desc = mysqli_real_escape_string($dbconn, $movie_desc);

            // thumbnail - using posters from api
            $movie_thumb = $movie_api["Poster"];

            // tidy and trim data
            $title_trim = trim($title_array);
            $title_trim = mysqli_real_escape_string($dbconn, $title_trim);

            $year_array = trim($year_array, "'");
            $year_array = trim($year_array);
            $year_array = mysqli_real_escape_string($dbconn, $year_array);

            $runtime_array = trim($runtime_array, "'");
            $runtime_array = trim($runtime_array);
            $runtime_array = mysqli_real_escape_string($dbconn, $runtime_array);

            // movie insert statement
            $movie_sql = "INSERT INTO movie (movie_id, title, release_year, runtime, revenue, movie_desc, thumbnail) 
            VALUES (null, '$title_trim', '$year_array', '$runtime_array', '$revenue_array', '$movie_desc', '$movie_thumb') ";
            // send insert statement to db
            $movie_insert = $dbconn->query($movie_sql);
            // check error
            if (!$movie_insert) {
                echo $dbconn->error;
                exit();
            }

            // save last inserted id to be used in following insert statements
            $last_movie_insert_id = $dbconn->insert_id;


            // genre
            foreach ($genre as $movie_genre) {

                $genre_trim = trim($movie_genre, "'");
                $genre_trim = trim($genre_trim);
                $genre_trim = mysqli_real_escape_string($dbconn, $genre_trim);

                if ($genre_trim == 'Romance Movies' || $genre_trim == 'Romantic') {
                    $genre_trim = 'Romance';
                }

                if ($genre_trim == 'Classic Movies') {
                    $genre_trim = 'Classic';
                }

                if ($genre_trim == 'Dramas') {
                    $genre_trim = 'Drama';
                }

                if ($genre_trim == 'Thrillers') {
                    $genre_trim = 'Thriller';
                }

                $check_genre = "SELECT * FROM genre WHERE genre ='$genre_trim' ";
                $genre_checked = $dbconn->query($check_genre);
                if (!$genre_checked) {
                    echo $dbconn->error;
                    exit();
                }
                if ($genre_checked->num_rows == 0) {
                    $genre_sql = "INSERT INTO genre (genre_id, genre) VALUES ( null, '$genre_trim')";
                    $genre_insert = $dbconn->query($genre_sql);

                    if (!$genre_insert) {
                        echo $dbconn->error;
                        exit();
                    }
                }

                // populating many-to-many table
                $genre_db = "SELECT * FROM genre WHERE genre = '$genre_trim' ";
                $genre_result = $dbconn->query($genre_db);

                if (!$genre_result) {
                    echo $dbconn->error;
                    exit();
                }

                $row = $genre_result->fetch_assoc();
                $genre_id = $row['genre_id'];
                $genre_sql_mtm = "INSERT INTO movie_genre (movie_id, genre_id) VALUES ('$last_movie_insert_id' , '$genre_id')";

                $genre_insert_mtm = $dbconn->query($genre_sql_mtm);
                if (!$genre_insert_mtm) {
                    echo $dbconn->error;
                    exit();
                }
            } // genre_end

            // director
            foreach ($director as $movie_director) {

                // trim director
                $director_trim = trim($movie_director, "'");
                $director_trim = trim($director_trim);
                $director_trim = mysqli_real_escape_string($dbconn, $director_trim);

                $check_director = "SELECT * FROM director WHERE director ='$director_trim' ";
                $director_checked = $dbconn->query($check_director);
                if (!$director_checked) {
                    echo $dbconn->error;

                    exit();
                }
                if ($director_checked->num_rows == 0) {
                    $director_sql = "INSERT INTO director (director_id, director) VALUES ( null, '$director_trim')";
                    $director_insert = $dbconn->query($director_sql);

                    if (!$director_insert) {
                        echo $dbconn->error;
                        exit();
                    }
                }
                // populating many-to-many table    
                $director_db = "SELECT * FROM director WHERE director = '$director_trim' ";
                $director_result = $dbconn->query($director_db);

                if (!$director_result) {
                    echo $dbconn->error;
                    exit();
                }

                $row = $director_result->fetch_assoc();
                $director_id = $row['director_id'];
                $director_sql_mtm = "INSERT INTO movie_director (movie_id, director_id) VALUES ('$last_movie_insert_id', '$director_id')";

                $director_insert_mtm = $dbconn->query($director_sql_mtm);
                if (!$director_insert_mtm) {
                    echo $dbconn->error;
                    exit();
                }
            } // director_end

            // actor
            foreach ($actor as $movie_actor) {

                $actor_trim = trim($movie_actor, "'");
                $actor_trim = trim($actor_trim);
                $actor_trim = mysqli_real_escape_string($dbconn, $actor_trim);

                $check_actor = "SELECT * FROM actor WHERE actor ='$actor_trim' ";
                $actor_checked = $dbconn->query($check_actor);
                if (!$actor_checked) {
                    echo $dbconn->error;
                    exit();
                }
                if ($actor_checked->num_rows == 0) {
                    $actor_sql = "INSERT INTO actor (actor_id, actor) VALUES ( null, '$actor_trim')";
                    $actor_insert = $dbconn->query($actor_sql);
                    if (!$actor_insert) {
                        echo $dbconn->error;
                        exit();
                    }
                }
                // populating many-to-many table   
                $actor_db = "SELECT * FROM actor WHERE actor = '$actor_trim' ";
                $actor_result = $dbconn->query($actor_db);

                if (!$actor_result) {
                    echo $dbconn->error;
                    exit();
                }

                $row = $actor_result->fetch_assoc();
                $actor_id = $row['actor_id'];
                $actor_sql_mtm = "INSERT INTO movie_actor (movie_id, actor_id) VALUES ('$last_movie_insert_id', '$actor_id')";

                $actor_insert_mtm = $dbconn->query($actor_sql_mtm);
                if (!$actor_insert_mtm) {
                    echo $dbconn->error;
                    exit();
                }
            } //actor_end



        } //foreach year end
    } //foreach movie end

} //while loop end
    
// close file
// fclose($file);
