<?php

include("../database/dbconn.php");
require("../partials/functions.php");

if (isset($_POST["submit"])) {



    $username = $_POST["email"];
    $pwd = $_POST["password"];


    if (emptyInputLogin($username, $pwd) === true) {
        header("location: login.php?error=empty-input");
        exit();
    }


    loginUser($dbconn, $username, $pwd);
} else {

    header("location: login.php?error=login-failed");
    exit();
}
