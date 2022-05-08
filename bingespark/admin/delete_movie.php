<?php

//delete account
if (isset($_POST['submit'])) {

    include_once("../database/dbconn.php");
    include_once("../partials/functions.php");

    $movie_id = $_POST["movieid"];
    deleteMovie($dbconn, $movie_id);

    header("location: admin_profile_ad.php");
}