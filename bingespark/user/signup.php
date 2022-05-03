<?php
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
                                    <input type="text" class="form-control" name="name" placeholder="Name">



                                    <input type="email" class="form-control" name="email" placeholder="Email Address">



                                    <input type="password" class="form-control" name="password" placeholder="Password">


                                    <input type="password" class="form-control" name="password-repeat" placeholder="Repeat Password">


                                    <button type="submit" class="btn btn-primary" name="submit">Sign Up</button>
                                </div>


                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>








        <!--Footer-->
        <?php include('../partials/footer_2.php'); ?>

</body>

</html>