<?php
session_start();

include_once("../database/dbconn.php");
include_once("../partials/functions.php");


if (isset($_POST['submitform'])) {

    $title = $_POST['title'];
    $year = $_POST['release-year'];
    $runtime = $_POST['runtime'];
    $revenue = $_POST['revenue'];
    $movie_desc = $_POST['description'];

    $title_esc = mysqli_escape_string($dbconn, $title);
    $movie_desc_esc = mysqli_escape_string($dbconn, $movie_desc);


    addMovie($dbconn, $title_esc, $year, $runtime, $revenue, $movie_desc_esc);
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

                        <ul>

                            <div class="panel panel-default">
                                <div class="panel-heading" id="profile-panel-heading">
                                    <h3 class="panel-title">Movies</h3>

                                </div>
                                <div class="panel-body" id="profile-panel-body">

                                    <a class="btn btn-primary" style="color: #feefdd; background-color: #ff4000; border: none" href="admin_movie-add.php" role="button">Add Movie</a>


                                    <div data-bs-spy="scroll" data-bs-target="#navbar-example3" data-bs-offset="0" tabindex="0">



                                        <div class="mb-3">
                                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" name="form">
                                                <div class="panel-body" id="profile-panel-body">
                                                    <input type="text" class="form-control" name="title" placeholder="Movie Title">
                                                </div>
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
                                                <div class="panel-body" id="profile-panel-body">
                                                    <button type="submit" class="btn btn-primary" name="submitform">Submit Movie</button>
                                                </div>
                                            </form>
                                        </div>




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