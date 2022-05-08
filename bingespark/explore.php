<?php
session_start();

// db connection
include("database/dbconn.php");
include("search/explore_filter.php");


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
                            <option>Genre</option>
                            <select name="genre-filter">

                                <?php

                                foreach ($genres as $row) {
                                    $genre_filter = $row["genre"];
                                ?>
                                    <option>
                                        <?php echo $genre_filter; ?>
                                    </option>
                                <?php }

                                // echo "
                                // <input class='form-control' type='hidden' value='$genre_filter' aria-label='readonly input example' name='genre' readonly>";
                                ?>
                            </select>
                            <div class="control">
                                <button class="btn btn-default" type="submit-genre" id="button-addon2">Submit</button>
                            </div>
                        </form>
                    </div>

                    <div class="col-xs-12 col-sm-4 col-md-4" id="explore-filter-dropdown">
                        <form action="search/explore_filter_result.php" method="POST">
                            <option>Actor</option>
                            <select name="actor-filter">

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
                                <button class="btn btn-default" type="submit-actor" id="button-addon2">Submit</button>
                            </div>
                        </form>
                    </div>

                    <div class="col-xs-12 col-sm-4 col-md-4" id="explore-filter-dropdown">
                        <form action="search/explore_filter_result.php" method="POST">
                            <option>Director</option>

                            <select name="director-filter">

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

                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" id="explore-filter-dropdown">
                        <form action="search/explore_filter_result.php" method="POST">
                            <option>Revenue (million)</option>

                            Above:<select name="revenue-filter">

                                <option value="100">100</option>
                                <option value="200">200</option>
                                <option value="300">300</option>
                                <option value="400">400</option>
                                <option value="500">500</option>
                                <option value="600">600</option>
                                <option value="700">700</option>
                                <option value="800">800</option>

                            </select>
                            <div class="control">
                                <button class="btn btn-default" type="submit" id="button-addon2">Submit</button>
                            </div>
                        </form>


                    </div>

                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" id="explore-filter-dropdown">
                        <form action="search/explore_filter_result.php" method="POST">
                            <option>Runtime (minutes)</option>

                            Longer than:<select name="runtime-filter">

                                <option value="60">60</option>
                                <option value="90">90</option>
                                <option value="120">120</option>
                                <option value="180">180</option>
                                <option value="240">240</option>
                                <option value="300">300</option>

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