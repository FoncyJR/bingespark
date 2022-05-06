<?php

if(isset($_POST["submit"])){

    $username=$_POST["email"];
    $username=$_POST["password"];

    include("../database/dbconn.php");
    include("../partials/functions.php");

    if (emptyInputLogin($username,$pwd) != false) {
        header("location: login.php?error=empty-input");
        exit();
    }


    loginUser($dbconn, $username, $pwd);

}else{

    header("location: ..login.php");
    exit();

}

?>