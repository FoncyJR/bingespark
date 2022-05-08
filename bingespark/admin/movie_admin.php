<?php

session_start();

// db connection
include("../database/dbconn.php");

// MOVIE data
$movie_id = htmlentities(urldecode($_GET["filter"]));

// gather data from db
$explore_query = "SELECT * FROM movie WHERE movie_id = '$movie_id';";

$explore_query_result = $dbconn->query($explore_query);

$movies = array();

if (!$explore_query_result) {
    echo $dbconn->query($explore_query);
}


while ($row = $explore_query_result->fetch_assoc()) {

    $movies[] = $row;
}

//Directors array
$explore_query_director = "SELECT * FROM director
                INNER JOIN movie_director
                ON director.director_id = movie_director.director_id
                INNER JOIN movie
                ON movie.movie_id = movie_director.movie_id
                WHERE movie.movie_id = '$movie_id';";

$explore_query_result_director = $dbconn->query($explore_query_director);

$directors = array();

if (!$explore_query_result_director) {
    echo $dbconn->query($explore_query_director);
}


while ($row = $explore_query_result_director->fetch_assoc()) {

    $directors[] = $row;
}

//Movies array
$explore_query_actor = "SELECT * FROM actor
                        INNER JOIN movie_actor
                        ON actor.actor_id = movie_actor.actor_id
                        INNER JOIN movie
                        ON movie.movie_id = movie_actor.movie_id
                        WHERE movie.movie_id = '$movie_id';";

$explore_query_result_actor = $dbconn->query($explore_query_actor);

$actors = array();

if (!$explore_query_result_actor) {
    echo $dbconn->query($explore_query_actor);
}


while ($row = $explore_query_result_actor->fetch_assoc()) {

    $actors[] = $row;
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('../partials/head_2.php') ?>
    <title>bingespark Movie</title>
</head>

<body>

    <!-- Navbar -->
    <?php include('../partials/navbar_2.php'); ?>

    <!--Body-->
    <div class="container-fluid" id="profile-panel">
        <div class="panel panel-default">
            <div class="panel-heading" id="profile-panel-heading">
                <h3 class="panel-title"><?php foreach ($movies as $row) {
                                            $movie_title = $row["title"];
                                        }
                                        $movie_title ?></h3>

            </div>
            <!-- Movie display -->
            <div class="panel-body" id="profile-panel-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <?php

                        foreach ($movies as $row) {

                            if (strlen($row["thumbnail"]) > 0) {
                                $movie_thumbnail = $row["thumbnail"];
                            } else {
                                $movie_thumbnail = '../images/moviePosterPlaceholder.png';
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
                                <a href='movie.php?filter=$movie_id'><h4>$movie_title ($movie_year)</h4></a>
                                </div>
                            </div>

                            <div class='row' id='random-movie'>
                                <div class='col-xs-12 col-sm-6 col-md-6'>
                                    <img src='$movie_thumbnail' alt='$movie_title poster' width='500px'>
                                </div>

                                  <div class='col-xs-12 col-sm-6 col-md-6'>
                                ";
                        }
                        ?>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <?php

                        foreach ($movies as $row) {

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
                                <div class='col-xs-12 col-sm-6 col-md-6'>

                                    <p><b>Description</b><br><br>$movie_description</p>
                                    <p><b>Runtime:</b> $movie_runtime mins <b>Revenue:</b> <span>&#36;</span>$movie_revenue million</p>
                                  
                                ";
                            foreach ($directors as $row) {
                                $movie_director = $row["director"];
                                echo "<p><b>Director:</b> $movie_director </p>";
                            }

                            echo "
                                <p><b>Actors:</b>";

                            foreach ($actors as $row) {
                                $movie_actor = $row["actor"];
                                echo "
                                    $movie_actor.
                                    ";
                            }
                            echo "</p></div>";
                        }
                        ?>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="panel-heading" id="profile-panel-options">
                        </div>



                        <div class="panel panel-default">
                            <div class="panel-heading" id="profile-panel-heading">
                                <h3 class="panel-title">Movie Options</h3>

                            </div>

                            <div class="panel-body" id="profile-panel-body">


                                <div class="mb-3">
                                    <form action="edit_movie_include.php" method="POST" name="form">
                                        <div class="panel-body" id="profile-panel-body">
                                            <input type="text" class="form-control" name="title" placeholder="Movie Title">
                                        </div>
                                        <input class='form-control' type='hidden' value='<?php echo "$movie_id" ?>' aria-label='readonly input example' name='userid' readonly>
                                        <div class="panel-body" id="profile-panel-body">
                                            <input type="number" class="form-control" name="release-year" placeholder="Release Year">
                                        </div>
                                        <div class="panel-body" id="profile-panel-body">
                                            <input type="number" class="form-control" name="runtime" placeholder="Runtime (mins)">
                                        </div>
                                        <div class="panel-body" id="profile-panel-body">
                                            <input type="number" class="form-control" name="revenue" placeholder="Revenue (millions)">
                                        </div>
                                        <div class="panel-body" id="profile-panel-body">
                                            <input type="text" class="form-control" name="description" placeholder="Movie Description">
                                        </div>
                                        <div class="panel-body" id="profile-panel-body">
                                            <div class="mb-3">
                                                <label for="formFile" class="form-label">Movie Poster</label>
                                                <input class="form-control" type="file" id="formFile" id="upload-btn">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="submit">Edit Movie</button>
                                </div>
                                </form>
                            </div>
                            <?php

                            echo
                            "
                            <form action='delete_movie.php' method='POST' name='form'>
                            <div class='panel-body' id='profile-panel-body'>
                            <input class='form-control' type='hidden' value='$movie_id' aria-label='readonly input example' name='movieid' readonly>
                                <div><input type='submit' name='submit' value='Delete Movie' /></div>
                            </div>
                            </form>
                            ";



                            ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    </div>

    <!--Footer-->
    <?php include('../partials/footer_2.php'); ?>

</body>

</html>