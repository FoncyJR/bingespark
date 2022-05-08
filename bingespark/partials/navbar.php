<?php
// session_start();
include("functions.php");
include("database/dbconn.php");

if (isset($_SESSION["user_id"])) {


    $usertype = $_SESSION['user_type_id'];
}
?>

<nav class="navbar navbar-default" id="navbar">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"><img src="images/bingesparkLogo.png" alt="bingespark logo" id="bingespark-logo"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <!--Search bar-->
            <div class="col-sm-6">
                <form action="search/explore_search.php" method="POST" class="navbar-form navbar-right">
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input type="text" name="search" value="" class="form-control" placeholder="Search" aria-label="Search bar" aria-describedby="basic-addon2">
                            <div class="control">
                                <button class="btn btn-default" type="submit" id="button-addon2">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <ul class="nav navbar-nav">

                <li role="separator" class="divider"></li>
                <li><a href="explore.php">Explore</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="contact.php">Contact</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="random.php">Random</a></li>
                <li role="separator" class="divider"></li>
                <?php

                if (isset($_SESSION["user_id"])) {

                    if ($usertype == 1) {

                        echo "
                        <li><a href='user/logout_include.php'>Log Out</a></li>
                        </ul>
                        <ul class='nav navbar-nav navbar-right'>
                            <li class='active'><a href='admin/admin_profile.php' id='profile-btn'>Admin<span class='sr-only'>(current)</span></a></li>

                        ";
                    } else if ($usertype == 2) {
                        echo "
                        <li><a href='user/logout_include.php'>Log Out</a></li>
                        </ul>
                        <ul class='nav navbar-nav navbar-right'>
                            <li class='active'><a href='user/profile.php' id='profile-btn'>Profile<span class='sr-only'>(current)</span></a></li>
            
                        ";
                    }
                } else {
                    echo "
                        <li><a href='user/signup.php'>Sign Up</a></li>
                        </ul>
                        <ul class='nav navbar-nav navbar-right'>
                            <li class='active'><a href='user/login.php' id='profile-btn'>Log In<span class='sr-only'>(current)</span></a></li>
            
                        ";
                }

                ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>