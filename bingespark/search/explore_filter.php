<?php

// genre query
$genre_query = "SELECT * FROM genre ORDER BY genre.genre";

$genre_query_result = $dbconn->query($genre_query);

if (!$genre_query_result) {
    echo $dbconn->query($genre_query);
}
$genres = array();

while ($row = $genre_query_result->fetch_assoc()) {
    $genres[] = $row;
}

foreach($genres as $row){
    $genre = $row["genre"];
}

// actor query
$actor_query = "SELECT * FROM actor ORDER BY actor.actor";

$actor_query_result = $dbconn->query($actor_query);

if (!$actor_query_result) {
    echo $dbconn->query($actor_query);
}
$actors = array();

while ($row = $actor_query_result->fetch_assoc()) {
    $actors[] = $row;
}

foreach($actors as $row){
    $actor = $row["actor"];
}

// director query
$director_query = "SELECT * FROM director ORDER BY director.director";

$director_query_result = $dbconn->query($director_query);

if (!$director_query_result) {
    echo $dbconn->query($director_query);
}
$directors = array();

while ($row = $director_query_result->fetch_assoc()) {
    $directors[] = $row;
}

foreach($directors as $row){
    $director = $row["director"];
}

?>