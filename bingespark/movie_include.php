<?php
session_start();


if (isset($_POST['submitform'])) {

    $user_id = $_SESSION['user_id'];
    $review = $_POST['review'];

    $insert_review = "INSERT INTO `review` (`review_id`, `user_id`, `movie_id`, `user_review`, `user_rating`, `favourite`) 
    VALUES (NULL, '$user_id', '$movie_id', '$review', NULL, default);";

    $insert_result = $dbconn->query($insert_review);

    if (!$insert_result) {
        echo $dbconn->query($insert_review);
    }

}

header("movie.php");