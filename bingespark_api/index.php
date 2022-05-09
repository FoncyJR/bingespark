<?php

// set object to json
header('Content-Type: application/json');

include("../bingespark/database/dbconn.php");

// key: 'all' returns all the data from db relating to all moviesß
if (isset($_GET['all'])) {

    $all = "SELECT movie.movie_id, movie.title, movie.release_year, movie.runtime, movie.movie_desc, movie.thumbnail, actor.actor, director.director, genre.genre
    FROM movie
    
    INNER JOIN movie_genre
    ON movie.movie_id = movie_genre.movie_id
    
    INNER JOIN genre
    ON movie_genre.genre_id = genre.genre_id
    
    INNER JOIN movie_actor
    ON movie.movie_id = movie_actor.movie_id
    
    INNER JOIN actor
    ON movie_actor.actor_id = actor.actor_id
    
    INNER JOIN movie_director
    ON movie.movie_id = movie_director.movie_id
    
    INNER JOIN director
    ON movie_director.director_id = director.director_id;";

    $result = $dbconn->query($all);

    $data = array();

    while ($row = $result->fetch_assoc()) {

        $data[] = $row;
    }

    // actor and genre md arrays




    // encode data from array intoo json object
    echo json_encode($data);
}

