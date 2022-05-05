<?php

// db connection
include("../database/dbconn.php");
include("explore_filter.php");

if (isset($_POST['search'])) {
    $input_text = $_POST['search'];
}

$search_query = "SELECT DISTINCT  movie.movie_id, movie.release_year,
    movie.title, movie.runtime, movie.thumbnail, movie.movie_desc
    FROM movie
    INNER JOIN  movie_genre
    ON movie.movie_id=movie_genre.movie_id
    INNER JOIN genre
    ON genre.genre_id=movie_genre.genre_id
    INNER JOIN  movie_actor
    ON movie.movie_id=movie_actor.movie_id
    INNER JOIN actor
    ON actor.actor_id=movie_actor.actor_id
    INNER JOIN movie_director
    ON movie.movie_id = movie_director.movie_director_id
    INNER JOIN director
    ON director.director_id = movie_director.director_id
    WHERE actor.actor LIKE '%$input_text%' OR genre.genre LIKE '%$input_text%' OR director.director LIKE '%$input_text%' OR movie.title LIKE '%$input_text%';";


$search_query_result = $dbconn->query($search_query);


if (!$search_query_result) {
    echo $dbconn->query($explore_query);
}
$movies = array();

while ($row = $search_query_result->fetch_assoc()) {
    $movies[] = $row;
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
                <h3 class="panel-title">Explore</h3>
            </div>

            <div class="panel-body" id="profile-panel-body">

                <div class="row" id="explore-filter">

                    <div class="col-xs-12 col-sm-4 col-md-4" id="explore-filter-dropdown">
                        <form action="/explore_filter_result.php" method="POST">
                            <select name="genre">
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
                        <form action="explore_filter_result.php" method="POST">
                            <select name="actor">
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
                        <form action="explore_filter_result.php" method="POST">
                            <select name="director">
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
                <h4 class="panel-title">Search results matching <?php echo" '$input_text' "?></h4>

            </div>
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
                            
                            $movie_title = $row["title"];
                            $movie_year = $row["release_year"];
                            $movie_id = $row["movie_id"];




                            echo "
                            <div class='row' id='explore-movies'>

                            <div class='col-xs-12 col-sm-12 col-md-12'>
                            <a href='../movie.php?filter=$movie_id'><h4>$movie_title($movie_year)</h4></a>
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
-->


    <!--Footer-->
    <?php include('../partials/footer_2.php'); ?>

</body>

</html>