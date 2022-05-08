<?php
session_start();

include_once("../partials/functions.php");
// db connection
include("../database/dbconn.php");


// session vars
$user_id = $_SESSION["user_id"];

// gather data from db
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

// "INSERT INTO `review` (`review_id`, `user_id`, `movie_id`, `user_review`, `user_rating`, `favourite`) 
// VALUES (NULL, '$user_id', '$movie_id', '$review', '$rating', '$favourite');"


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('../partials/head_2.php') ?>
    <title>bingespark Profile</title>
</head>

<body>

    <!-- Navbar -->
    <?php include('../partials/navbar_2.php'); ?>


    <!--Body-->

    <div class="container-fluid" id="profile-panel">
        <div class="panel panel-default">
            <div class="panel-heading" id="profile-panel-heading">
                <h3 class="panel-title">Profile </h3>
                <!---Change to dynamic username?-->
            </div>
            <div class="panel-body" id="profile-panel-body">

                <div class="row">
                    <div class="col-xs-6 col-sm-4 col-md-4">
                        <?php
                        if (strlen($_SESSION["profile_picture"]) === NULL) {

                            $pic = $_SESSION["profile_picture"];

                            echo "<img src='$pic' alt='profile picture' width='200px'>";
                        } else {

                            echo "<img src='../images/avatar.webp' alt='profile picture' width='20%'>
                       ";
                        }

                        ?>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-4">
                        <ul>
                            <?php
                            if (isset($_SESSION["user_id"])) {

                                echo "<h3>" . $_SESSION['name'] . "<h3>";
                            }
                            ?>
                        </ul>

                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <ul>

                            <?php
                            if (isset($_SESSION["user_id"])) {

                                echo "<h3>" . $_SESSION['username'] . "</h3>";
                            }
                            ?>

                        </ul>

                    </div>


                </div>

            </div>
        </div>
    </div>
    <div class="container-fluid" id="profile-panel">
        <div class="panel panel-default">

            <div class="panel-body" id="profile-panel-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <div class="panel-heading" id="profile-panel-options">
                        </div>

                        <nav id="profile-pills">
                            <ul class="nav nav-pills nav-stacked" id="pills-stacked">
                                <!-- Make active pill #FF4000-->

                                <li role="presentation"><a href="profile_favourites.php">Favourites</a></li>
                                <li role="presentation" class="active"><a href="profile_review.php">Reviews</a></li>
                                <li role="presentation"><a href="profile.php">Settings</a></li>
                            </ul>
                        </nav>
                    </div>

                    <div class="col-xs-12 col-sm-8 col-md-8">
                        <div class="panel-heading" id="profile-panel-options">
                        </div>

                        <ul>

                            <div class="panel panel-default">
                                <div class="panel-heading" id="profile-panel-heading">
                                    <h2 class="panel-title">My Reviews</h2>


                                    <div class='panel-body' id='profile-panel-body'>
                                        <?php

                                        foreach ($user_reviews as $row) {
                                            $movietitle = $row["title"];
                                            $yearreleased = $row["release_year"];
                                            $review_movie = $row["user_review"];
                                            $rating_movie = $row["user_rating"];
                                            $fave = $row["favourite"];

                                            echo
                                            "
                                                <div class='panel-body' id='profile-panel-body'>
                                                    <div class='panel-body'>
                                                    <h3 style='color: #201e1f'>$movietitle($yearreleased)</h3>
                                                        <p style='color: #201e1f'>
                                                            $review_movie
                                                        </p>
                                                    </div>
                                                </div>
                                            ";
                                        }
                                        ?>
                                        <!-- <label class='form-label' for='message'>Add Review</label>
                                        <textarea class='form-control' id='message' type='text' placeholder='Message' style='height: 10rem;'></textarexa>
                                            <button type='button' class='btn btn-primary'>Submit Review</button> -->
                                        </div>

                                </div>
                                <div class="panel-body" id="profile-panel-body">


                        </ul>
                    </div>
                </div>




            </div>

        </div>
    </div>
    </div>





    <!--Footer-->
    <?php include('../partials/footer_2.php'); ?>

</body>