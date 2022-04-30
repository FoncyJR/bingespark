<?php
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include('partials/head.php')?>
        <title>bingespark</title>
    </head>

    <body>
        <!--Navbar-->
       <?php include('partials/navbar.php');?>

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
                         <!---Thinking this will be explore.php changed by id?--->
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
        <?php include('partials/footer.php');?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
    </body>
    </html>