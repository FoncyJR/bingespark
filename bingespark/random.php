<?php

// db connection
include("database/dbconn.php");

// gather data from db
$explore_query = "SELECT * FROM movie ORDER BY RAND() LIMIT 1";

// REFINE TO JUST SELECT THE THINGS YOU NEED FOR ECHO
// $explore_query = "SELECT * FROM movie
// INNER JOIN movie_actor ON movie.movie_id
// INNER JOIN actor ON actor.actor_id
// INNER JOIN movie_genre ON movie.movie_id
// INNER JOIN genre ON genre.genre_id
// INNER JOIN movie_director ON movie.movie_id
// INNER JOIN director ON director.director_id ORDER BY RAND() LIMIT 1";

$explore_query_result = $dbconn->query($explore_query);

if (!$explore_query_result) {
    echo $dbconn->query($explore_query);
}
$movies = array();

while ($row = $explore_query_result->fetch_assoc()) {
    $movies[] = $row;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('partials/head.php') ?>
    <title>bingespark explore</title>
</head>

<body>

    <!-- Navbar -->
    <?php include('partials/navbar.php'); ?>

    <!--Body-->
    <div class="container-fluid" id="profile-panel">
        <div class="panel panel-default">
            <div class="panel-heading" id="profile-panel-heading">
                <h3 class="panel-title">Random Movie</h3>
                <!---Change to dynamic username?-->
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
                            $movie_title = $row["title"];
                            $movie_year = $row["release_year"];
                            $movie_description = $row["movie_desc"];
                            $movie_runtime = $row["runtime"];
                            $movie_revenue = $row["revenue"];
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

                                            <p>$movie_description</p>
                                            <p><b>Runtime:</b> $movie_runtime mins <b>Revenue:</b> <span>&#36;</span>$movie_revenue million</p>
                                            <p><b>Director:</b> </p>
                                            <p><b>Actors: </b>
                                            </div>
                                </div>
                                
                            </div>
                            ";
                        }
                        ?>

                    </div>

                </div>

            </div>

            <!--Footer-->
            <?php include('partials/footer.php'); ?>

</body>

</html>