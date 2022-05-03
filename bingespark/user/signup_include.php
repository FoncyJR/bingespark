<?php

if (isset($_POST["submit"])) {

    $name = $_POST["name"];
    $email = $POST["email"];
    $password = $POST["password"];
    $password_repeat = $POST["password-repeat"];

    require_once('../database/dbconn.php');
    require_once('../partials/functions.php');

    if (emptyInputSignup($name, $email, $password, $password_repeat) != false) {
        header("location: signup.php?error=empty-input");
        exit();
    }

    if (invalidEmail($email) !== false) {
        header("location: signup.php?error=invalid-email");
        exit();
    }

    if (passwordMatch($password, $password_repeat) !== false) {
        header("location: signup.php?error=passwords-dont-match");
        exit();
    }

    if (emailExists($dbconn, $email) !== false){
        header("location: signup.php?error=email-taken");
        exit();
    }

    createUser($dbconn, $name, $email, $password);


} else {
    header("location: signup.php");
    exit();
}
