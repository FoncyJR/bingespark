<?php
session_start();
include_once("database/dbconn.php");

//REVIEW data

$reviews_query = "SELECT review.review_id, review.user_review, review.user_rating, 
                    review.favourite, user.user_id, user.name, movie.title, movie.release_year, movie.thumbnail 
                FROM review
                INNER JOIN user
                ON user.user_id = review.user_id
                INNER JOIN movie
                ON movie.movie_id = review.movie_id
                WHERE review.favourite = 1 LIMIT 3;";

$reviews_result = $dbconn->query($reviews_query);

if (!$reviews_result) {
    echo $dbconn->query($reviews_query);
}
$user_reviews = array();

while ($row = $reviews_result->fetch_assoc()) {
    $user_reviews[] = $row;
}


if (mysqli_num_rows($reviews_result) < 1) {
}

//REVIEW data by year

$movies_query_year = "SELECT movie.title, movie.release_year, movie.thumbnail FROM movie
                    WHERE movie.release_year = 2000 LIMIT 3;";
// set to 2021 for demo purposes as no newer films in database
// Set to YEAR(CURDATE()) normally

$movies_result_year = $dbconn->query($movies_query_year);

if (!$movies_result_year) {
    echo $dbconn->query($movies_query);
}
$movies_year = array();

while ($row = $movies_result_year->fetch_assoc()) {
    $movies_year[] = $row;
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('partials/head.php') ?>
    <title>bingespark Home</title>
</head>

<body>
    <!--Navbar-->
    <?php include('partials/navbar.php'); ?>

    <!--Body-->
    <div class="container-fluid" id="main-body">
        <?php
        if (isset($_SESSION["user_id"])) {

            echo "
        <div class='panel panel-default'>
            <div class='panel-heading' id='profile-panel-heading-signedin'>
                <h3 class='panel-title'>Hello " . $_SESSION["name"] . "</h3>
            </div>
        </div>
        ";
        }
        ?>
        <!--Carousel-->
        <div class="container-fluid" id="profile-panel">
            <div class="panel panel-default">
                <div class="panel-heading" id="profile-panel-heading">
                    <h3 class="panel-title">Staff Picks</h3>
                </div>
                <div class="panel-body" id="profile-panel-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 col-sm-6 col-md-6 col-lg-6">
                                <h4>Current Favourite Movies</h4>

                                <div id="carousel-example-generic-classic" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                        <li data-target="#carousel-example-generic-classic" data-slide-to="0" class="active"></li>
                                        <li data-target="#carousel-example-generic-classic" data-slide-to="1"></li>
                                        <li data-target="#carousel-example-generic-classic" data-slide-to="2"></li>
                                    </ol>

                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                        <?php

                                        $movie_thumbnail0 = $user_reviews[0]["thumbnail"];
                                        $movie_thumbnail1 = $user_reviews[1]["thumbnail"];
                                        $movie_thumbnail2 = $user_reviews[2]["thumbnail"];

                                        $movie_title0 = $user_reviews[0]["title"];
                                        $movie_title1 = $user_reviews[1]["title"];
                                        $movie_title2 = $user_reviews[2]["title"];

                                        echo "
                                
                                <div class='item active' id='index-carousel'>
                                    <img src='$movie_thumbnail0' alt='...'>
                                    <div class='carousel-caption'>
                                    $movie_title0
                                    </div>
                                </div>

                                <div class='item'>
                                    <img src='$movie_thumbnail1' alt='...'>
                                    <div class='carousel-caption'>
                                    $movie_title1
                                    </div>
                                </div>

                                <div class='item'>
                                    <img src='$movie_thumbnail2' alt='...'>
                                    <div class='carousel-caption'>
                                    $movie_title2
                                    </div>
                                </div>
                                        ";

                                        ?>

                                    </div>

                                    <!-- Controls -->
                                    <a class="left carousel-control" href="#carousel-example-generic-classic" role="button" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="right carousel-control" href="#carousel-example-generic-classic" role="button" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>

                            </div>



                            <!--News-->
                            <div class="col-sm-12 col-sm-6 col-md-6 col-lg-6">
                                <h4>Classics</h4>

                                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                                    </ol>

                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                        <?php

                                        if (strlen($movies_year[0]["thumbnail"]) > 0) {
                                            $movie_thumbnail0 = $movies_year[0]["thumbnail"];
                                        } else {
                                            $movie_thumbnail0 = 'images/moviePosterPlaceholder.png';
                                        };

                                        if (strlen($movies_year[1]["thumbnail"]) > 0) {
                                            $movie_thumbnail1 = $movies_year[1]["thumbnail"];
                                        } else {
                                            $movie_thumbnail1 = 'images/moviePosterPlaceholder.png';
                                        };

                                        if (strlen($movies_year[2]["thumbnail"]) > 0) {
                                            $movie_thumbnail2 = $movies_year[2]["thumbnail"];
                                        } else {
                                            $movie_thumbnail2 = 'images/moviePosterPlaceholder.png';
                                        };
                                        $movie_title0 = $movies_year[0]["title"];
                                        $movie_title1 = $movies_year[1]["title"];
                                        $movie_title2 = $movies_year[2]["title"];

                                        echo "
                                
                                <div class='item active' id='index-carousel'>
                                    <img src='$movie_thumbnail0' alt='...'>
                                    <div class='carousel-caption'>
                                    $movie_title0
                                    </div>
                                </div>

                                <div class='item'>
                                    <img src='$movie_thumbnail1' alt='...'>
                                    <div class='carousel-caption'>
                                    $movie_title1
                                    </div>
                                </div>

                                <div class='item'>
                                    <img src='$movie_thumbnail2' alt='...'>
                                    <div class='carousel-caption'>
                                    $movie_title2
                                    </div>
                                </div>
                                        ";

                                        ?>

                                    </div>

                                    <!-- Controls -->
                                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>

                            </div>

                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>



    <!--Footer-->
    <?php include('partials/footer.php'); ?>

</body>

</html>