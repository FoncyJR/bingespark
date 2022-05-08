<?php


// add admin
if (isset($_POST["submit"])) {
    include_once("../database/dbconn.php");
    include_once("..//partials/functions.php");


    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $password_repeat = $_POST["password-repeat"];



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

    if (emailExists($dbconn, $email) !== false) {
        header("location: signup.php?error=email-taken");
        exit();
    }

    createAdmin($dbconn, $name, $email, $password);


} else {
    header("location: admin_profile?error=admin-not-added.php");
    exit();
}
