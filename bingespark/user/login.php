<?php
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
                            <form action="" method="POST">
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="inputEmail3">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="inputPassword3">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Log In</button>

                            </form>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                           <a href="signup.php"><button type="submit" class="btn btn-primary">Sign Up</button></a>
                        </div>
                    </div>
                </div>
            </div>

            <!--Footer-->
            <?php include('../partials/footer_2.php'); ?>

</body>

</html>