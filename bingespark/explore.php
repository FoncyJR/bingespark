<?php

// db connection
include("database/dbconn.php");

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
    <title>bingespark explore</title>
</head>

<body>

    <!-- Navbar -->
    <?php include('partials/navbar.php'); ?>

    <!--Body-->
    <div class="container-fluid" id="profile-panel">
        <div class="panel panel-default">
            <div class="panel-heading" id="profile-panel-heading">
                <h3 class="panel-title">Explore</h3>
                <!---Change to dynamic username?-->
            </div>
            <div class="panel-body" id="profile-panel-body">

                <div class="row" id="explore-filter">

                    <div class="col-xs-12 col-sm-4 col-md-4" id="explore-filter-dropdown">
                        <div class="btn-group dropdown">
                            <button type="button" class="btn btn-default">Genre</button>
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="#">Action</a>
                                </li>
                                <li>
                                    <a href="#">Adventure</a>
                                </li>
                                <li>
                                    <a href="#">Comedy</a>
                                </li>
                                <li>
                                    <a href="#">Crime</a>
                                </li>
                                <li>
                                    <a href="#">Drama</a>
                                </li>
                                <li>
                                    <a href="#">Family</a>
                                </li>
                                <li>
                                    <a href="#">Fantasy</a>
                                </li>
                                <li>
                                    <a href="#">Horror</a>
                                </li>
                                <li>
                                    <a href="#">Mystery</a>
                                </li>
                                <li>
                                    <a href="#">Romantic</a>
                                </li>
                                <li>
                                    <a href="#">Sci-Fi</a>
                                </li>
                                <li>
                                    <a href="#">Thriller</a>
                                </li>
                                <li>
                                    <a href="#">Western<a>
                                </li>
                                <li>
                                    <a href="#">Biography</a>
                                </li>
                                <li>
                                    <a href="#">Sport</a>
                                </li>
                                <li>
                                    <a href="#">History</a>
                                </li>
                                <li>
                                    <a href="#">War</a>
                                </li>
                                <li>
                                    <a href="#">Animation</a>
                                </li>
                                <li>
                                    <a href="#">Music</a>
                                </li>
                                <li>
                                    <a href="#">Musical</a>
                                </li>
                                <li>
                                    <a href="#">Children</a>
                                </li>
                                <li>
                                    <a href="#">Classic</a>
                                </li>
                                <li>
                                    <a href="#">Cult</a>
                                </li>
                                <li>
                                    <a href="#">International</a>
                                </li>
                                <li>
                                    <a href="#">Independent</a>
                                </li>

                            </ul>
                        </div>

                    </div>


                    <div class='col-xs-12 col-sm-4 col-md-4'>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Actor">
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </div>

                    <div class='col-xs-12 col-sm-4 col-md-4'>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Director">
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
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
                                $movie_thumbnail = '../database/moviePosterPlaceholder.png';
                            };
                            $movie_title = $row["title"];
                            $movie_year = $row["release_year"];



                            echo "
                            <div class='row' id='explore-movies'>

                            <div class='col-xs-12 col-sm-12 col-md-12'>
                            <a href='#'><h4>$movie_title($movie_year)</h4></a>
                            </div>

                            <div class='col-xs-12 col-sm-12 col-md-12' id='explore-poster'> 
                            <img src='$movie_thumbnail' alt='$movie_title poster'>
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