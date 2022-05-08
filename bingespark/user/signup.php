<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('../partials/head_2.php') ?>
    <title>bingespark Sign Up</title>
</head>

<body>
    <!--Navbar-->
    <?php include('../partials/navbar_2.php'); ?>

    <!--Body-->

    <div class="container-fluid" id="main-body">

        <div class="container-fluid" id="profile-panel">
            <div class="panel panel-default">
                <div class="panel-heading" id="profile-panel-heading">
                    <h3 class="panel-title">Sign Up</h3>
                </div>

                <div class="panel-body" id="profile-panel-body">

                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <form action="signup_include.php" method="POST">

                                <div class="mb-3">
                                    <div class="panel-body" id="profile-panel-body">
                                        <input type="text" class="form-control" name="name" placeholder="Name">
                                    </div>
                                    <div class="panel-body" id="profile-panel-body">
                                        <input type="email" class="form-control" name="email" placeholder="Email Address">
                                    </div>
                                    <div class="panel-body" id="profile-panel-body">
                                        <input type="password" class="form-control" name="password" placeholder="Password">
                                    </div>
                                    <div class="panel-body" id="profile-panel-body">
                                        <input type="password" class="form-control" name="password-repeat" placeholder="Repeat Password">
                                    </div>
                                    <div class="panel-body" id="profile-panel-body">
                                        <button type="submit" class="btn btn-primary" name="submit">Sign Up</button>
                                    </div>
                                </div>

                                <?php

                                // sign up error and success messages
                                if (isset($_GET["error"])) {

                                    if ($_GET["error"] == "empy-input") {

                                        echo "<p>Uh oh, fill all fields!</p>";
                                    } else if (isset($_GET["error"]) == "invalid-email") {

                                        echo "<p>Please enter a valid email address.</p>";
                                    } else if (isset($_GET["error"]) == "passwords-dont-match") {

                                        echo "<p>Passwords don't match.</p>";
                                    } else if (isset($_GET["error"]) == "email-taken") {

                                        echo "<p>Sorry, this email is in use. Please try another..</p>";
                                    } else if (isset($_GET["error"]) == "none") {

                                        echo "<p>Welcome to BingeSpark!";
                                        header("location: profile.php");
                                    } else {
                                        echo "<p> Error. Please try again later.</p>";
                                    }
                                }

                                ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>








            <!--Footer-->
            <?php include('../partials/footer_2.php'); ?>

</body>

</html>