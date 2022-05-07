<?php
session_start();

// db connection
include("database/dbconn.php");
include("search/explore_filter.php");

// 

// gather data from db
$explore_query = "SELECT * FROM movie;";

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
    <title>bingespark Explore</title>
</head>

<body>

    <!-- Navbar -->
    <?php include('partials/navbar.php'); ?>

    <!--Body-->
    <div class="container-fluid" id="profile-panel">
        <div class="panel panel-default">
            <div class="panel-heading" id="profile-panel-heading">
                <h3 class="panel-title">Explore</h3>
            </div>

            <div class="panel-body" id="profile-panel-body">

                <div class="row" id="explore-filter">

                    <div class="col-xs-12 col-sm-4 col-md-4" id="explore-filter-dropdown">
                        <form action="search/explore_filter_result.php" method="POST">
                            <select name="genre-filter">
                                <option>Genre</option>
                                <?php

                                foreach ($genres as $row) {
                                    $genre_filter = $row["genre"];
                                ?>
                                    <option>
                                        <?php echo $genre_filter; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <div class="control">
                                <button class="btn btn-default" type="submit" id="button-addon2">Submit</button>
                            </div>
                        </form>
                    </div>

                    <div class="col-xs-12 col-sm-4 col-md-4" id="explore-filter-dropdown">
                        <form action="search/explore_filter_result.php" method="POST">
                            <select name="actor-filter">
                                <option>Actor</option>
                                <?php

                                foreach ($actors as $row) {
                                    $actor_filter = $row["actor"];
                                ?>
                                    <option>
                                        <?php echo $actor_filter; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <div class="control">
                                <button class="btn btn-default" type="submit" id="button-addon2">Submit</button>
                            </div>
                        </form>
                    </div>

                    <div class="col-xs-12 col-sm-4 col-md-4" id="explore-filter-dropdown">
                        <form action="search/explore_filter_result.php" method="POST">
                            <select name="director-filter">
                                <option>Director</option>
                                <?php

                                foreach ($directors as $row) {
                                    $director_filter = $row["director"];
                                ?>
                                    <option>
                                        <?php echo $director_filter; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <div class="control">
                                <button class="btn btn-default" type="submit" id="button-addon2">Submit</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>

    </div>
    </div>
    </div>
    <div class="container-fluid" id="profile-panel">
        <div class="panel panel-default">
            <div class="panel-heading" id="profile-panel-heading">
                <h4 class="panel-title">Movies</h4>
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
                            $movie_id = $row["movie_id"];




                            echo "
                            <div class='row' id='explore-movies'>

                            <div class='col-xs-12 col-sm-12 col-md-12'>
                            <a href='movie.php?filter=$movie_id'><h4>$movie_title($movie_year)</h4></a>
                            </div>

                            <div class='col-xs-12 col-sm-12 col-md-12' id='explore-poster'> 
                            <img src='$movie_thumbnail' alt='$movie_title poster' width = '500px'>
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
-->>


    <!--Footer-->
    <?php include('partials/footer.php'); ?>

</body>

</html>