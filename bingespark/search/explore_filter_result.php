<?php

// db connection
include("database/dbconn.php");

// // gather data from db
// $explore_query = "SELECT * FROM movie;";

// $explore_query_result = $dbconn->query($explore_query);

// if (!$explore_query_result) {
//     echo $dbconn->query($explore_query);
// }
// $movies = array();

// while ($row = $explore_query_result->fetch_assoc()) {
//     $movies[] = $row;
// }

// db connection filter
include("search/explore_filter.php");

// setting variables from dropdown for filter
if (isset($_POST['genre-filter'])) {
    $genre = $_POST['genre-filter'];
}

if (isset($_POST['actor-filter'])) {
    $genre = $_POST['actor-filter'];
}

if (isset($_POST['director-filter'])) {
    $genre = $_POST['director-filter'];
}

if (isset($genre)) {
    $filter_query = "SELECT DISTINCT  movie.movie_id, movie.release_year,
    movie.title, movie.runtime, movie.thumbnail, movie.movie_desc
    FROM movie
    INNER JOIN  movie_genre
    ON movie.movie_id=movie_genre.movie_id
    INNER JOIN genre
    ON genre.genre_id=movie_genre.genre_id
    WHERE genre.genre = $genre;";
}

$filter_query_result = $dbconn->query($filter_query);

if (!$filter_query_result) {
    echo $dbconn->query($filter_query);
}
$filter_result = array();

while ($row = $filter_query_result->fetch_assoc()) {
    $filter_result[] = $row;
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
            </div>

            <div class="panel-body" id="profile-panel-body">

                <div class="row" id="explore-filter">

                    <div class="col-xs-12 col-sm-4 col-md-4" id="explore-filter-dropdown">
                        <form action="search/explore_filter_result.php" method="POST">
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
                        <form action="search/explore_filter_result.php" method="POST">
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
                        <form action="search/explore_filter_result.php" method="POST">
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
                <h4 class="panel-title">Movies</h4>
            </div>
            <div class="panel-body" id="profile-panel-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <?php

                        foreach ($filter_result as $row) {


                            if (strlen($row["thumbnail"]) > 0) {
                                $movie_thumbnail_filter = $row["thumbnail"];
                            } else {
                                $movie_thumbnail_filter = 'images/moviePosterPlaceholder.png';
                            };
                            $movie_title_filter = $row["title"];
                            $movie_year_filter = $row["release_year"];
                            $movie_id_filter = $row["movie_id"];




                            echo "
                            <div class='row' id='explore-movies'>

                            <div class='col-xs-12 col-sm-12 col-md-12'>
                            <a href='movie.php?filter=$movie_id_filter><h4>$movie_title_filter($movie_year_filter)</h4></a>
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
-->>


    <!--Footer-->
    <?php include('partials/footer.php'); ?>

</body>

</html>