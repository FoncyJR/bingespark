<?php

// db connection
include("database/dbconn.php");


    $input_text= htmlentities(urldecode($_POST['search']));

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
    WHERE actor.actor LIKE '%$input_text%' OR genre.genre LIKE '%$input_text%' OR director.director LIKE '%$input_text%' OR movie.title LIKE '%$input_text%'";

    $search_query_result = $dbconn->query($search_query);


if (!$search_query_result) {
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

    <?php

    foreach ($movies as $row) {
        $movie_genre = $row["genre"];
    }

    ?>
    <!--Body-->
    <div class="container-fluid" id="profile-panel">
        <div class="panel panel-default">
            <div class="panel-heading" id="profile-panel-heading">
                <h3 class="panel-title">Explore</h3>
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
                            <ul class='dropdown-menu'>
                                <li>
                                    <?php echo "<a href='movie_genre.php?filter=$movie_genre'>Action</a>" ?>
                                </li>
                                <li>
                                    <a href='#'>Adventure</a>
                                </li>
                                <li>
                                    <a href='#'>Comedy</a>
                                </li>
                                <li>
                                    <a href='#'>Crime</a>
                                </li>
                                <li>
                                    <a href='#'>Drama</a>
                                </li>
                                <li>
                                    <a href='#'>Family</a>
                                </li>
                                <li>
                                    <a href='#'>Fantasy</a>
                                </li>
                                <li>
                                    <a href='#'>Horror</a>
                                </li>
                                <li>
                                    <a href='#'>Mystery</a>
                                </li>
                                <li>
                                    <a href='#'>Romantic</a>
                                </li>
                                <li>
                                    <a href='#'>Sci-Fi</a>
                                </li>
                                <li>
                                    <a href='#'>Thriller</a>
                                </li>
                                <li>
                                    <a href='#'>Western<a>
                                </li>
                                <li>
                                    <a href='#'>Biography</a>
                                </li>
                                <li>
                                    <a href='#'>Sport</a>
                                </li>
                                <li>
                                    <a href='#'>History</a>
                                </li>
                                <li>
                                    <a href='#'>War</a>
                                </li>
                                <li>
                                    <a href='#'>Animation</a>
                                </li>
                                <li>
                                    <a href='#'>Music</a>
                                </li>
                                <li>
                                    <a href='#'>Musical</a>
                                </li>
                                <li>
                                    <a href='#'>Children</a>
                                </li>
                                <li>
                                    <a href='#'>Classic</a>
                                </li>
                                <li>
                                    <a href='#'>Cult</a>
                                </li>
                                <li>
                                    <a href='#'>International</a>
                                </li>
                                <li>
                                    <a href='#'>Independent</a>
                                </li>

                            </ul>
                        </div>

                    </div>


                    <div class='col-xs-12 col-sm-4 col-md-4'>
                        <form class="navbar-form navbar-right">
                            <div class="form-group">
                                <div class="input-group mb-3" action="GET" action=>
                                    <input type="text" name="search_query" value="<?php if (isset($_GET['search'])) {
                                                                                        echo $_GET['search_query'];
                                                                                    } ?>" class="form-control" placeholder="Actor" aria-label="Search" aria-describedby="basic-addon2">

                                    <button class="btn btn-default" type="submit" id="button-addon2">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class='col-xs-12 col-sm-4 col-md-4'>
                        <form class="navbar-form navbar-right">
                            <div class="form-group">
                                <div class="input-group mb-3" action="GET">
                                    <input type="text" name="search_query" value="<?php if (isset($_GET['search'])) {
                                                                                        echo $_GET['search_query'];
                                                                                    } ?>" class="form-control" placeholder="Director" aria-label="Search" aria-describedby="basic-addon2">

                                    <button class="btn btn-default" type="submit" id="button-addon2">Submit</button>
                                </div>
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