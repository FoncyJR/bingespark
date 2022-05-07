<?php

session_start();

// db connection
include("database/dbconn.php");

$movie_id = htmlentities(urldecode($_GET["filter"]));

// gather data from db
$explore_query = "SELECT * FROM movie WHERE movie_id = '$movie_id';";

// REFINE TO JUST SELECT THE THINGS YOU NEED FOR ECHO
// $explore_query = "SELECT * FROM movie
// INNER JOIN movie_actor ON movie.movie_id
// INNER JOIN actor ON actor.actor_id
// INNER JOIN movie_genre ON movie.movie_id
// INNER JOIN genre ON genre.genre_id
// INNER JOIN movie_director ON movie.movie_id
// INNER JOIN director ON director.director_id WHERE movie_id = '$movie_id;";

$explore_query_result = $dbconn->query($explore_query);

$movies = array();

if (!$explore_query_result) {
    echo $dbconn->query($explore_query);
}


while ($row = $explore_query_result->fetch_assoc()) {

    $movies[] = $row;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('partials/head.php') ?>
    <title>bingespark Movie</title>
</head>

<body>

    <!-- Navbar -->
    <?php include('partials/navbar.php'); ?>

    <!--Body-->
    <div class="container-fluid" id="profile-panel">
        <div class="panel panel-default">
            <div class="panel-heading" id="profile-panel-heading">
                <h3 class="panel-title"><?php foreach ($movies as $row) {
                                            $movie_title = $row["title"];
                                        }
                                        $movie_title ?></h3>

            </div>
            <div class="panel-body" id="profile-panel-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <?php

                        foreach ($movies as $row) {

                            if (strlen($row["thumbnail"]) > 0) {
                                $movie_thumbnail = $row["thumbnail"];
                            } else {
                                $movie_thumbnail = 'images/moviePosterPlaceholder.png';
                            };

                            if (strlen($row["movie_desc"]) > 0) {
                                $movie_description = $row["movie_desc"];
                            } else {
                                $movie_description = "No description available at the moment.";
                            };

                            if (strlen($row["revenue"]) > 0) {
                                $movie_revenue = $row["revenue"];
                            } else {
                                $movie_revenue = "No revenue figures available at the moment.";
                            };

                            $movie_title = $row["title"];
                            $movie_year = $row["release_year"];
                            $movie_runtime = $row["runtime"];

                            // $movie_director = $row["director"];
                            // $movie_actor = $row["actor"];

                            echo "
                            <div class='row' id='random-movie'>
                                <div class='col-xs-12 col-sm-12 col-md-12'> 
                                <a href='#'><h4>$movie_title ($movie_year)</h4></a>
                                </div>
                            </div>

                            <div class='row' id='random-movie'>
                                <div class='col-xs-12 col-sm-6 col-md-6'>
                                    <img src='$movie_thumbnail' alt='$movie_title poster' width='500px'>
                                </div>
                                <div class='col-xs-12 col-sm-6 col-md-6'>

                                    <p><b>Description</b><br><br>$movie_description</p>
                                    <p><b>Runtime:</b> $movie_runtime mins <b>Revenue:</b> <span>&#36;</span>$movie_revenue million</p>
                                    <p><b>Director:</b> </p>
                                    <p><b>Actors: </b>
                                </div>
                                ";
                        }
                        ?>
                        <?php
                        if (isset($_SESSION["user_id"])) {
                            echo "
                            <div class='col-xs-12 col-sm-6 col-md-6'>
                                    <div class='container-fluid' id='profile-panel'>
                                        <div class='panel panel-default'>
                                            <div class='panel-heading' id='profile-panel-heading-review'>
                                                <h3 class='panel-title'>Leave a Review! </h3>
                                            </div>
                                            <div class='panel-body' id='profile-panel-body'>
        
                                                <div class='row'>
                                                         <div class='col-xs-6 col-sm-4 col-md-4'>
        
                                                         </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                                    ";
                        }



                        ?>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!--Footer-->
    <?php include('partials/footer.php'); ?>

</body>

</html>