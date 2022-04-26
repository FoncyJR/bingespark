<?php ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('partials/head.php') ?>
    <title>bingespark profile</title>
</head>

<body>

    <!-- Navbar -->
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

                <div class="col-sm-6">
                    <form class="navbar-form navbar-right">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search">
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>

                <ul class="nav navbar-nav">

                    <li role="separator" class="divider"></li>
                    <li><a href="explore.php">Explore</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="random.php">Random</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="profile.php" id="profile-btn">Profile<span class="sr-only">(current)</span></a></li>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>


    <!--Body-->

    <div class="container-fluid" id="profile-panel">
        <div class="panel panel-default">
            <div class="panel-heading" id="profile-panel-heading">
                <h3 class="panel-title">Profile </h3>
                <!---Change to dynamic username?-->
            </div>
            <div class="panel-body" id="profile-panel-body">

                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-4"><img src="#" alt="profile picture"></div>
                    <div class="col-xs-8 col-sm-8 col-md-8">
                        <ul>
                            <li>First Name Last Name</li>
                            <li>username (email)</li>
                            <li role="separator" class="divider"></li>
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
                    <div class="col-xs-8 col-sm-8 col-md-8">
                        <div class="panel-heading" id="profile-panel-options">
                            <h3 class="panel-title">Options within each menu section- example Settings </h3>
                            <!---Change to dynamic username?-->
                        </div>

                        <ul>
                            <li>Change Name</li>
                            <li>Change Password</li>
                            <li>Change Profile picture</li>

                            <li>Delete account etc...</li>
                            <li>Settings</li>
                        </ul>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="panel-heading" id="profile-panel-options">
                            <h3 class="panel-title">Profile Options </h3>
                            <!---Change to dynamic username?-->
                        </div>
                        <nav id="profile-pills">
                            <ul class="nav nav-pills nav-stacked">
                                <li role="presentation" class="active"><a href="#">Favourites</a></li>
                                <li role="presentation"><a href="#">Reviews</a></li>
                                <li role="presentation"><a href="#">Settings</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>



            </div>

        </div>
    </div>
    </div>





    <!--Footer-->
    <nav class="navbar navbar-default navbar-fixed-bottom" id="footer">
        <div class="container">
            <div class="row">

                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="btn-group dropup">
                        <button type="button" class="btn btn-default">Social Media</button>
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="https://www.instagram.com"><img src="images/instagram.png" alt="instagram link"> Instagram</a>
                            </li>
                            <li>
                                <a href="https://www.twitter.com"><img src="images/twitter.png" alt="twitter link"> Youtube</a>
                            </li>
                            <li>
                                <a href="https://www.facebook.com"><img src="images/facebook.png" alt="facebook link"> Facebook</a>
                            </li>
                            <li>
                                <a href="https://www.youtube.com"><img src="images/youtube.png" alt="youtube link"> Youtube</a>
                            </li>
                        </ul>
                    </div>

                </div>
                <div class="col-xs-4 col-sm-4" col-md-4> <a href="#" class="nav navbar-nav navbar-right" id="author">Markus Condren</a>
                </div>

            </div>


        </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>