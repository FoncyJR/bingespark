<?php
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Google Fonts Space Mono-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <title>bingespark</title>
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
                    <a class="navbar-brand" href="index.html"><img src="images/bingesparkLogo.png" alt="bingespark logo" id="bingespark-logo"></a>
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
                        <li><a href="#">Explore</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="contact.html">Contact</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Random</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="profile.html" id="profile-btn">Profile<span class="sr-only">(current)</span></a></li>

                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>


        <!--Body-->
        <div class="container-fluid" id="main-body">
            <!--Carousel-->
            <div class="container">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <!--------Come back and add images------------->
                            <img src="https://c4.wallpaperflare.com/wallpaper/92/398/576/music-tenacious-d-wallpaper-preview.jpg" alt="...">
                            <div class="carousel-caption">
                                Tenacious D: The Pick of Destiny (2006)
                            </div>
                        </div>
                        <div class="item">
                            <img src="https://i.pinimg.com/originals/d4/27/b2/d427b2a2c6f3c7d9dc26b26805036305.jpg" alt="...">
                            <div class="carousel-caption">
                                The Mask (1994)
                            </div>
                        </div>
                        <div class="item">
                            <img src="https://i.redd.it/5r2r7jr277i81.jpg" alt="...">
                            <div class="carousel-caption">
                                The Batman (2022)
                            </div>
                        </div>
                        <!---------------Add more cards here------------>
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


            <div class="container pt-4">
                <!---padding top 4 needed atm remove from html and add to css-->
                <!--Categories-->
                <div class="row">

                </div>
            </div>


        </div>
        </div>
        <!--More Body-->
        <div class="container pt-4">
            <!---padding top 4 needed atm remove from html and add to css-->
            <!--Categories-->
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <h3>Categories</h3>
                    <p>
                        <ul>
                            <li><a href="#" class="" id="">Movies</a></li>
                            <li><a href="#" class="" id="">Genres</a></li>
                            <li><a href="#" class="" id="">Actors</a></li>
                            <li><a href="#" class="" id="">Directors</a></li>
                            <li><a href="#" class="" id="">Movies</a></li>
                            <li><a href="#" class="" id="">Movies</a></li>
                        </ul>
                    </p>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <!---Could this be a mini carousel?-->
                    <h3>Top grossing films of all time</h3>
                    <p>
                        <ul>
                            <li><a href="#" class="" id="">Movies</a></li>
                            <li><a href="#" class="" id="">Genres</a></li>
                            <li><a href="#" class="" id="">Actors</a></li>
                            <li><a href="#" class="" id="">Directors</a></li>
                            <li><a href="#" class="" id="">Movies</a></li>
                            <li><a href="#" class="" id="">Movies</a></li>
                        </ul>
                    </p>
                </div>
                <!--News-->
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <h3>Latest News</h3>
                    <ul>
                        <li>a</li>
                        <li>b</li>
                        <li>c</li>
                        <li>d</li>
                        <li>e</li>
                        <li>f</li>
                    </ul>
                </div>
            </div>


        </div>
        </div>

        <!--Footer-->
        <nav class="navbar navbar-default navbar-fixed-bottom" id="footer">
            <div class="container">
                <div class="row">

                    <div class="col-xs-6 col-sm-6 col-md-6" id="social-dropdown">
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
                    <div class="col-xs-4 col-sm-4" col-md-4> <a href="https://github.com/FoncyJR" class="nav navbar-nav navbar-right" id="author">Markus Condren</a>
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