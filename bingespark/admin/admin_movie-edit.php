<?php
session_start();

include_once("../database/dbconn.php");
include_once("../partials/functions.php");


if (isset($_POST['submit'])) {

    $title = $_POST['title'];
    $year = $_POST['release-year'];
    $runtime = $_POST['runtime'];
    $revenue = $_POST['revenue'];
    $movie_desc = $_POST['description'];

    $title_esc = mysqli_escape_string($dbconn, $title);
    $movie_desc_esc = mysqli_escape_string($dbconn, $movie_desc);


    editMovie($dbconn, $title_esc, $year, $runtime, $revenue, $movie_desc_esc, $movie_id);
}

header("location: admin_profile");



?>

<!-- <div class='mb-3'>
                            <form action='admin/admin_movie-edit.php' method='POST' name='form'>
                                <div class='panel-body' id='profile-panel-body'>
                                <h3>Edit Movie</h3>
                                    <input type='text' class='form-control' name='title' placeholder='Movie Title'>
                                </div>
                                <div class='panel-body' id='profile-panel-body'>
                                    <input type='number' class='form-control' name='release-year' placeholder='Release Year'>
                                </div>
                                <div class='panel-body' id='profile-panel-body'>
                                    <input type='number' class='form-control' name='runtime' placeholder='Runtime (mins)'>
                                </div>
                                <div class='panel-body' id='profile-panel-body'>
                                    <input type='number' class='form-control' name='revenue' placeholder='Revenue (millions)'>
                                </div>
                                <div class='panel-body' id='profile-panel-body'>
                                    <input type='text' class='form-control' name='description' placeholder='Movie Description'>
                                </div>
                                <div class='panel-body' id='profile-panel-body'>
                                    <div class='mb-3'>
                                        <label for='formFile' class='form-label'>Movie Poster</label>
                                        <input class='form-control' type='file' id='formFile' id='upload-btn'>
                                    </div>
                                </div>
                                <div class='panel-body' id='profile-panel-body'>
                                    <button type='submit' class='btn btn-primary' name='submit'>Edit Movie</button>
                                </div> -->


                                