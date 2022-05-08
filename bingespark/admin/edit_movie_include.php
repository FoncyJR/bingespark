<?php

if (isset($_POST['submit'])) {


    include_once("../database/dbconn.php");
    include_once("..//partials/functions.php");

    $title = $_POST['title'];
    $year = $_POST['release-year'];
    $runtime = $_POST['runtime'];
    $revenue = $_POST['revenue'];
    $movie_desc = $_POST['description'];
    $movie_id = $_POST['userid'];

    $title_esc = mysqli_escape_string($dbconn, $title);
    $movie_desc_esc = mysqli_escape_string($dbconn, $movie_desc);


    editMovie($dbconn, $title_esc, $year, $runtime, $revenue, $movie_desc_esc, $movie_id);
}