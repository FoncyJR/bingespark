<?php
session_start();

include("../partials/functions.php");

//change username
if (isset($_SESSION["change-username"])) {
    $user_id = $_SESSION["user_id"];
    changeUsername($dbconn, $user_id);
    header("profile.php?error-none-username-changed");
}

//change password
if (isset($_SESSION["change-password"])) {
}

//delete account
if (isset($_POST['submitform'])) {
    deleteAccount($dbconn);
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
                                <li role="presentation" class="active"><a href="#">Movies List</a></li>
                                <li role="presentation"><a href="#">User Admin</a></li>
                                <li role="presentation"><a href="#">Settings</a></li>
                            </ul>
                        </nav>
                    </div>

                    <div class="col-xs-12 col-sm-8 col-md-8">
                        <div class="panel-heading" id="profile-panel-options">
                        </div>

                        <ul>

                            <div class="panel panel-default">
                                <div class="panel-heading" id="profile-panel-heading">
                                    <h3 class="panel-title">Options</h3>

                                </div>
                                <div class="panel-body" id="profile-panel-body">
                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?> " method="POST" name="form">

                                        <div class="panel-body" id="profile-panel-body">
                                            <label for="formFile" class="form-label">Change Username</label>
                                            <input type="text" name="change-username" />
                                            <button type="button" class="btn btn-primary">Go</button>
                                        </div>

                                        <div class="panel-body" id="profile-panel-body">
                                            <label for="formFile" class="form-label">Change Password</label>
                                            <input type="text" name="change-password" />
                                            <button type="button" class="btn btn-primary">Go</button>
                                        </div>

                                        <div class="panel-body" id="profile-panel-body">
                                            <div class="mb-3">
                                                <label for="formFile" class="form-label">Upload Profile Picture</label>
                                                <input class="form-control" type="file" id="formFile" id="upload-btn">
                                            </div>
                                        </div>
                                    </form>

                                    <form action="action=" <?php echo $_SERVER['PHP_SELF']; ?> method="POST" name="form">
                                        <div class="panel-body" id="profile-panel-body">
                                            <div><input type="submit" name="submitform" value="Delete Account" /></div>
                                        </div>
                                    </form>
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