<?php
session_start();

include_once("../database/dbconn.php");

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
                <h3 class="panel-title">Profile Admin</h3>
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
                                <li role="presentation" class="active"><a href="admin_profile_ml.php">Movies List</a></li>
                                <li role="presentation"><a href="admin_profile_ad.php">Administrators</a></li>
                                <li role="presentation"><a href="admin_profile_ml.php">Users</a></li>
                                <li role="presentation"><a hhref="admin_profile.php">Settings</a></li>
                            </ul>
                        </nav>
                    </div>

                    <div class="col-xs-12 col-sm-8 col-md-8">
                        <div class="panel-heading" id="profile-panel-options">
                        </div>



                        <div class="panel panel-default">
                            <div class="panel-heading" id="profile-panel-heading">
                                <h3 class="panel-title">Administrator</h3>

                            </div>
                            <div class="panel-body" id="profile-panel-body">

                                <a class="btn btn-primary" style="color: #feefdd; background-color: #ff4000; border: none" href="admin_movie-add.php" role="button">Add Admin</a>

                            </div>
                            <div class="panel-body" id="profile-panel-body">



                                <ul>
                                    <div data-bs-spy="scroll" data-bs-target="#navbar-example3" data-bs-offset="0" tabindex="0">

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
                                       
                                            <a href='movie.php?filter=$movie_id'><h4>$movie_title($movie_year)</h4></a>
                                           
                                            ";
                                        }

                                        ?>


                                    </div>
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