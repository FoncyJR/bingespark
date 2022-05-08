<?php

session_start();

// db connection
include("database/dbconn.php");

// MOVIE data
$movie_id = htmlentities(urldecode($_GET["filter"]));

// gather data from db
$explore_query = "SELECT * FROM movie WHERE movie_id = '$movie_id';";

// REFINE TO JUST SELECT THE THINGS YOU NEED FOR ECHO
// $explore_query = "SELECT * FROM movie
// INNER JOIN movie_actor ON movie.movie_id
// INNER JOIN actor ON actor.actor_id
// INNER JOIN movie_genre ON movie.movie_id
// INNER JOIN genre ON genre.genre_id
// INNER JOIN movie_director ON movie.movie_id
// INNER JOIN director ON director.director_id WHERE movie_id = '$movie_id;";

$explore_query_result = $dbconn->query($explore_query);

$movies = array();

if (!$explore_query_result) {
    echo $dbconn->query($explore_query);
}


while ($row = $explore_query_result->fetch_assoc()) {

    $movies[] = $row;
}


//REVIEW data

$reviews_query = "SELECT review.review_id, review.user_review, review.user_rating, 
                    review.favourite, user.user_id, user.name, movie.title, movie.release_year, movie.thumbnail 
                FROM review
                INNER JOIN user
                ON user.user_id = review.user_id
                INNER JOIN movie
                ON movie.movie_id = review.movie_id
                WHERE movie.movie_id = $movie_id;";

$reviews_result = $dbconn->query($reviews_query);

if (!$reviews_result) {
    echo $dbconn->query($reviews_query);
}
$user_reviews = array();

while ($row = $reviews_result->fetch_assoc()) {
    $user_reviews[] = $row;
}


if (mysqli_num_rows($reviews_result) < 1) {

    // POST_BACK reviews
    if (isset($_POST['submitform'])) {

        $user_id = $_SESSION['user_id'];
        $review = $_POST['review'];

        $insert_review = "INSERT INTO `review` (`review_id`, `user_id`, `movie_id`, `user_review`, `user_rating`, `favourite`) 
    VALUES (NULL, '$user_id', '$movie_id', '$review', NULL, default);";

        $insert_result = $dbconn->query($insert_review);

        if (!$insert_result) {
            echo $dbconn->query($insert_review);
        }
    }
}





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('partials/head.php') ?>
    <title>bingespark Movie</title>
</head>

<body>

    <!-- Navbar -->
    <?php include('partials/navbar.php'); ?>

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
                                $movie_thumbnail = 'images/moviePosterPlaceholder.png';
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

                            if (strlen($row["thumbnail"]) > 0) {
                                $movie_thumbnail = $row["thumbnail"];
                            } else {
                                $movie_thumbnail = 'images/moviePosterPlaceholder.png';
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
                                <div class='col-xs-12 col-sm-6 col-md-6'>

                                    <p><b>Description</b><br><br>$movie_description</p>
                                    <p><b>Runtime:</b> $movie_runtime mins <b>Revenue:</b> <span>&#36;</span>$movie_revenue million</p>
                                    <p><b>Director:</b> </p>
                                    <p><b>Actors: </b>
                                </div>

                                  
                                ";
                        }
                        ?>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">

                        <?php
                        echo "<h3 style='color: #50b2c0'>Reviews</h3>";

                        foreach ($user_reviews as $row) {
                            $movietitle = $row["title"];
                            $yearreleased = $row["release_year"];
                            $review_movie = $row["user_review"];
                            $rating_movie = $row["user_rating"];
                            $fave = $row["favourite"];
                            $user = $row["name"];

                            echo
                            "
                                    <div class='panel-body' id='profile-panel-body'>
                                        <div class='panel-body'>
                                        
                                        <h4 style='color: #201e1f'>$user</h4>
                                            <p style='color: #201e1f'>
                                                <br>$review_movie<br>$rating_movie/5
                                            </p>
                                        </div>
                                    </div>
                                ";
                        }

                        ?>
                    </div>
                    <!-- User reviews -->
                    <?php
                    if (isset($_SESSION["user_id"])) {

                        $user_id = $_SESSION["user_id"];

                        $reviews_query = "SELECT review.review_id, review.user_review, review.user_rating, review.favourite, user.user_id, user.name, movie.title, movie.release_year, movie.thumbnail FROM review
                                            INNER JOIN user
                                            ON user.user_id = review.user_id
                                            INNER JOIN movie
                                            ON movie.movie_id = review.movie_id
                                            WHERE user.user_id = $user_id;";

                        $reviews_result = $dbconn->query($reviews_query);

                        if (!$reviews_result) {
                            echo $dbconn->query($reviews_query);
                        }
                        $user_reviews = array();

                        while ($row = $reviews_result->fetch_assoc()) {
                            $user_reviews[] = $row;
                        }

                        if (mysqli_num_rows($reviews_result) > 0) {

                            echo "<div class='col-xs-12 col-sm-6 col-md-6'>
                                    <div class='container-fluid' id='profile-panel'>
                                        <div class='panel panel-default'>
                                            <div class='panel-heading' id='profile-panel-heading-review'>
                                            <h4><a href='user/profile_review.php'>Your Reviews</a>
                                            </div></h4>
                                        </div>
                                    </div>
                                    </div>
                                            ";
                        } else {

                            
                            echo "
                                <div class='col-xs-12 col-sm-6 col-md-6'>
                                <div class='container-fluid' id='profile-panel'>
                                    <div class='panel panel-default'>
                                        <div class='panel-heading' id='profile-panel-heading-review'>
                                            <h3 class='panel-title'>Leave a Review! </h3>
                                        </div>
                                            <div class='panel-body' id='profile-panel-body'>
                                                <form action='<?php echo 'movie.php?filter=$movie_id;?>' method='POST'name='form'>
                                                    <textarea class='form-control' id='message' type='text' placeholder='bingespark' style='height: 10rem;' name='review'></textarea>

                                                    <div class='d-grid gap-2'>
                                                        <button class='btn btn-primary' type='submit' name='submitform'>Submit Review</button>
                                                    </div>

                                                    <div class='row'>
                                                        <div class='col-xs-6 col-sm-4 col-md-4'>

                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                       ";
                        }
                    }


                    ?>
                </div>
                </form>
            </div>

        </div>
    </div>

    </div>

    </div>

    <!--Footer-->
    <?php include('partials/footer.php'); ?>

</body>

</html>