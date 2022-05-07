<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('../partials/head_2.php') ?>
    <title>bingespark Log In</title>
</head>

<body>
    <!--Navbar-->
    <?php include('../partials/navbar_2.php'); ?>

    <!--Body-->

    <div class="container-fluid" id="main-body">

        <div class="container-fluid" id="profile-panel">
            <div class="panel panel-default">
                <div class="panel-heading" id="profile-panel-heading">
                    <h3 class="panel-title">Log In</h3>

                </div>
                <div class="panel-body" id="profile-panel-body">

                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">

                            <form action="login_include.php" method="POST">
                                <div class="panel-body" id="profile-panel-body">
                                    <input type="text" class="form-control" name="email" placeholder="Email Address/Username">
                                </div>
                                <div class="panel-body" id="profile-panel-body">
                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                </div>
                                <div class="panel-body" id="profile-panel-body">
                                    <button type="submit" class="btn btn-primary" name="submit" id="log-in">Log In</button>
                                </div>

                            </form>
                            <?php

                            // sign up error and success messages
                            if (isset($_GET["error"])) {

                                if ($_GET["error"] == "empy-input") {

                                    echo "<p>Uh oh, fill all fields!</p>";
                                } else if (isset($_GET["error"]) == "invalid-email") {

                                    echo "<p>Incorrect login. Please try again.</p>";
                                } else if (isset($_GET["error"]) == "incorrect-login") {

                                    echo "<p>Passwords don't match.</p>";
                                } else {
                                    echo "<p> Error. Please try again later.</p>";
                                }
                            }

                            ?>

                        </div>
                    </div>
                </div>
            </div>

            <!--Footer-->
            <?php include('../partials/footer_2.php'); ?>

</body>

</html>