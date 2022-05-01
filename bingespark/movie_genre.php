<?php

// db connection
include("database/dbconn.php");

$movie_genre = htmlentities($_GET["genre"]);

// gather data from db
$explore_query = "SELECT * FROM movie INNER JOIN movie_genre ON movie.movie_id INNER JOIN genre ON genre.genre_id WHERE genre = '$movie_genre';";

// REFINE TO JUST SELECT THE THINGS YOU NEED FOR ECHO
// $explore_query = "SELECT * FROM movie
// INNER JOIN movie_actor ON movie.movie_id
// INNER JOIN actor ON actor.actor_id
// INNER JOIN movie_genre ON movie.movie_id
// INNER JOIN genre ON genre.genre_id
// INNER JOIN movie_director ON movie.movie_id
// INNER JOIN director ON director.director_id WHERE movie_id = 1";

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
    <title>bingespark movie by genre</title>
</head>

<body>

    <!-- Navbar -->
    <?php include('partials/navbar.php'); ?>

    <!--Body-->
    <div class="container-fluid" id="profile-panel">
        <div class="panel panel-default">
            <div class="panel-heading" id="profile-panel-heading">
                <h3 class="panel-title"><?php echo $movie_genre?></h3>

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
                                    <img src='$movie_thumbnail' alt='$movie_title poster'>
                                    </div>

                                    </div>
                                    ";
                        }
                        ?>
                        ?>

                    </div>

                </div>

            </div>

            <!--Footer-->
            <?php include('partials/footer.php'); ?>

</body>

</html>