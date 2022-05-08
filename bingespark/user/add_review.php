<?php
session_start();

if (isset($_POST['submit'])) {


    include_once("../database/dbconn.php");
    include_once("..//partials/functions.php");

    $user_id = $_SESSION['user_id'];
    $review = $_POST['review'];
    $rating = $_POST['rating'];
    $movie_id = $_POST['movieid'];
    $favourite = isset($_POST['selected']) && $_POST['selected']  ? "1" : "0";

    $review_esc = mysqli_escape_string($dbconn, $review);



    addReview($dbconn, $user_id, $movie_id, $review, $rating, $favourite);
}