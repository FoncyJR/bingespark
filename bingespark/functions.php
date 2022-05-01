<?php

function titleFilter()
{
}

function genreFilter()
{
    include("database/dbconn.php");

    $movie_genre = htmlentities($_GET["genre"]);

    // gather data from db
    $explore_query = "SELECT * FROM movie INNER JOIN movie_genre ON movie.movie_id INNER JOIN genre ON genre.genre_id WHERE genre = '$movie_genre';";

    $explore_query_result = $dbconn->query($explore_query);



    if (!$explore_query_result) {
        echo $dbconn->query($explore_query);
    }
    $movies = array();

    while ($row = $explore_query_result->fetch_assoc()) {

        $movies[] = $row;
    }

    foreach ($movies as $row) {
        $movie_genre = $row["genre"];

        echo "<li> <a href='movie_genre.php?filter=$movie_genre'>$movie_genre</a> </li>";
    }
}

function actorFilter()
{
}

function directorFilter()
{
}
