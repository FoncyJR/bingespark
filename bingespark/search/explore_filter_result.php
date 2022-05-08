<?php

session_start();

// db connection
include("../database/dbconn.php");

// db connection filter
include("explore_filter.php");

// setting variables from dropdown for filter
if (isset($_POST["genre-filter"])) {
    $genre = $_POST["genre-filter"];
    $filter_query = "SELECT movie.movie_id, movie.release_year,
    movie.title, movie.runtime, movie.thumbnail, movie.movie_desc, genre.genre
    FROM movie
    INNER JOIN  movie_genre
    ON movie.movie_id=movie_genre.movie_id
    INNER JOIN genre
    ON genre.genre_id=movie_genre.genre_id
    WHERE genre.genre = '$genre';";
} else
if (isset($_POST["actor-filter"])) {
    $actor = $_POST["actor-filter"];
    $filter_query = "SELECT movie.movie_id, movie.release_year,
    movie.title, movie.runtime, movie.thumbnail, movie.movie_desc, actor.actor
    FROM movie
    INNER JOIN  movie_actor
    ON movie.movie_id=movie_actor.movie_id
    INNER JOIN actor
    ON actor.actor_id=movie_actor.actor_id
    WHERE actor.actor = '$actor';";
} else
if (isset($_POST["director-filter"])) {
    $director = $_POST["director-filter"];
    $filter_query = "SELECT movie.movie_id, movie.release_year,
    movie.title, movie.runtime, movie.thumbnail, movie.movie_desc, director.director
    FROM movie
    INNER JOIN  movie_director
    ON movie.movie_id=movie_director.movie_id
    INNER JOIN director
    ON director.director_id=movie_director.director_id
    WHERE director.director = '$director';";
} else if (isset($_POST["revenue-filter"])) {
    $revenue = $_POST["revenue-filter"];
    $filter_query = "SELECT movie.movie_id, movie.release_year,
    movie.title, movie.runtime, movie.revenue, movie.thumbnail, movie.movie_desc
    FROM movie
    WHERE movie.revenue >'$revenue';";
} else if (isset($_POST["runtime-filter"])) {
    $runtime = $_POST["runtime-filter"];
    $filter_query = "SELECT movie.movie_id, movie.release_year,
    movie.title, movie.runtime, movie.revenue, movie.thumbnail, movie.movie_desc
    FROM movie
    WHERE movie.runtime >'$runtime';";
} else {
    header("location: ../explore.php");
}



$filter_query_result = $dbconn->query($filter_query);

if (!$filter_query_result) {
    echo $dbconn->query($filter_query);
}
$filter_result = array();

while ($row = $filter_query_result->fetch_assoc()) {
    //  $filter_result[] = $row;
    array_push($filter_result, $row);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('../partials/head_2.php') ?>
    <title>bingespark explore</title>
</head>

<body>

    <!-- Navbar -->
    <?php include('../partials/navbar_2.php'); ?>

    <!--Body-->

    <div class="container-fluid" id="profile-panel">
        <div class="panel panel-default">
            <div class="panel-heading" id="profile-panel-heading">
                <h4 class="panel-title">Results</h4>
                <h5><a href="../explore.php">Back</a></h5>
            </div>
            <div class="panel-body" id="profile-panel-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <?php

                        foreach ($filter_result as $row) {

                            $movie_title_filter = $row["title"];
                            $movie_year_filter = $row["release_year"];
                            $movie_id_filter = $row["movie_id"];

                            if (strlen($row["thumbnail"]) > 0) {
                                $movie_thumbnail_filter = $row["thumbnail"];
                            } else {
                                $movie_thumbnail_filter = '../images/moviePosterPlaceholder.png';
                            };





                            echo "
                            <div class='row' id='explore-movies'>

                            <div class='col-xs-12 col-sm-12 col-md-12'>
                            <a href='../movie.php?filter=$movie_id_filter'><h4>$movie_title_filter($movie_year_filter)</h4></a>
                            </div>

                            <div class='col-xs-12 col-sm-12 col-md-12' id='explore-poster'> 
                            <img src='$movie_thumbnail_filter' alt='$movie_title_filter poster' width = '500px'>
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


    <!--Full list of all movies in db. 
    Include pagination
    Filters down left hand side - ideally checkbox one
-->


    <!--Footer-->
    <?php include('../partials/footer_2.php'); ?>

</body>

</html>