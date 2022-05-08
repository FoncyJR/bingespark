<?php
session_start();

include_once("../database/dbconn.php");
include_once("../partials/functions.php");

// gather data from db
$user_query = "SELECT * FROM user;";

$user_query_result = $dbconn->query($user_query);

if (!$user_query_result) {
    echo $dbconn->query($user_query);
}
$users = array();

while ($row = $user_query_result->fetch_assoc()) {
    $users[] = $row;
}

// add admin
if (isset($_POST["submitadminform"])) {


    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $password_repeat = $_POST["password-repeat"];



    if (emptyInputSignup($name, $email, $password, $password_repeat) != false) {
        header("location: signup.php?error=empty-input");
        exit();
    }

    if (invalidEmail($email) !== false) {
        header("location: signup.php?error=invalid-email");
        exit();
    }

    if (passwordMatch($password, $password_repeat) !== false) {
        header("location: signup.php?error=passwords-dont-match");
        exit();
    }

    if (emailExists($dbconn, $email) !== false) {
        header("location: signup.php?error=email-taken");
        exit();
    }

    createAdmin($dbconn, $name, $email, $password);

    header("admin_profile.php");
} else {
    header("location: admin_profile_ad.php");
    exit();
}

//delete account
if (isset($_POST['submitform'])) {
    $user_id = $row["user_id"];
    deleteAdminAccount($dbconn, $user_id);
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
                                <li role="presentation"><a href="admin_profile_ml.php">Movies List</a></li>
                                <li role="presentation" class="active"><a href="admin_profile_ad.php">Administrators</a></li>
                                <li role="presentation"><a href="admin_profile_ml.php">Users</a></li>
                                <li role="presentation"><a hhref="admin_profile.php">Settings</a></li>
                            </ul>
                        </nav>
                    </div>

                    <div class="col-xs-12 col-sm-8 col-md-8">
                        <div class="panel-heading" id="profile-panel-options">
                            <h3>Add New Admin</h3>
                        </div>

                        <div class="panel-body" id="profile-panel-body">

                            <div data-bs-spy="scroll" data-bs-target="#navbar-example3" data-bs-offset="0" tabindex="0">

                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" name="form">

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
                                            <input type="number" class="form-control" name="usertype" placeholder="User Type (Admin-1)">
                                        </div>
                                        <div class="panel-body" id="profile-panel-body">
                                            <button type="submit" class="btn btn-primary" name="submitadminform">Submit Admin</button>
                                        </div>
                                    </div>


                                </form>




                            </div>


                            <div class="panel panel-default">
                                <div class="panel-heading" id="profile-panel-heading">
                                    <h3 class="panel-title">Administrators</h3>

                                </div>
                                <div class="panel-body" id="profile-panel-body">

                                    <a class="btn btn-primary" href="admin_admin-add.php" style="color: #feefdd; background-color: #ff4000; border: none" role="button">New Admin</a>

                                </div>
                                <div class="panel-body" id="profile-panel-body">



                                    <ul>
                                        <div data-bs-spy="scroll" data-bs-target="#navbar-example3" data-bs-offset="0" tabindex="0">


                                            <?php

                                            foreach ($users as $row) {

                                                $user_id = $row["user_id"];
                                                $user_type_id = $row["user_type_id"];
                                                $name = $row["name"];
                                                $username = $row["username"];

                                                $action = $_SERVER['PHP_SELF'];

                                                if ($user_type_id == 1) {
                                                    echo
                                                    "
                                               <h4>$name(Admin)</h4>
                                            
                                                <form action='$action' method='POST' name='form'>
                                                <div class='panel-body' id='profile-panel-body'>
                                                    <div><input type='submit' name='submitform' value='Delete Account' /></div>
                                                </div>
                                                </form>
                                                ";
                                                }
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