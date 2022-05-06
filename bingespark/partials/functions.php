<?php

include("../database/dbconn.php");

// ----------- Sign Up Functions ----------- //
function emptyInputSignup($name, $email, $password, $password_repeat)
{
    if (empty($name) || empty($email) || empty($password) || empty($password_repeat)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function invalidEmail($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function passwordMatch($password, $password_repeat)
{
    if ($password !== $password_repeat) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function emailExists($dbconn, $email)
{
    // using prepared statements to check if user wmail has been used already
    $sql = "SELECT * FROM user WHERE email = ?;";
    $statement = mysqli_stmt_init($dbconn);

    if (!mysqli_stmt_prepare($statement, $sql)) {
        header("location: signup.php?error=stmt-failed");
        exit();
    }
    mysqli_stmt_bind_param($statement, "s", $email);
    mysqli_stmt_execute($statement);

    $result_data = mysqli_stmt_get_result($statement);

    if ($row = mysqli_fetch_assoc($result_data)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($statement);
}

function userExists($dbconn, $username, $email)
{
    // check user exists
    $check_user = "SELECT * FROM user WHERE username = ? OR email = ?";
    $statement = mysqli_stmt_init($dbconn);
    if (!mysqli_stmt_prepare($statement, $check_user)) {
        header("location: signup.php?error=user-exists");
        exit();
    }
    mysqli_stmt_bind_param($statement, "ss", $username, $email);
    mysqli_stmt_execute($statement);

    $result_data = mysqli_stmt_get_result($statement);

    if ($row = mysqli_fetch_assoc($result_data)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($statement);
}

function createUser($dbconn, $name, $email, $password)
{
    // // Prepared statements not working - revisit
    // $sql = $dbconn->prepare("INSERT INTO `user` (`user_id`,`user_type_id`,`name`, `email`, `username`,`password`,`profile_picture`) 
    //                 VALUES (?, ?, ?, ?, ?, ?, ?);");

    // $usertype = 2;
    // $null = NULL;
    // $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // $sql->bind_param("iissssb", $null, $usertype, $name, $email, $email, $password_hash, $null);
    // $sql->execute();
    // $sql->close();

    // // prepared statement attempt 2
    // $statement = "INSERT INTO `user` (`user_id`,`user_type_id`,`name`, `email`, `username`,`password`,`profile_picture`) 
    //                  VALUES (?, ?, ?, ?, ?, ?, ?);";

    // $insert = mysqli_stmt_init($dbconn);

    // if (!mysqli_stmt_prepare($insert, $statement)) {
    //     header("location: ../user/signup.php?error=stmtfailed");
    //     exit();
    // }

    // $password_hash = password_hash($password, PASSWORD_DEFAULT);
    // $usertype = 2;
    // $null = NULL;

    // mysqli_stmt_bind_param($insert ,"iissssb", $null, $usertype, $name, $email, $email, $password_hash, $null);
    // mysqli_stmt_execute($insert);
    // mysqli_stmt_close($insert);


    $usertype = 2;
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $name = mysqli_escape_string($dbconn, $name);
    $email = mysqli_escape_string($dbconn, $email);
    $password_hash = mysqli_escape_string($dbconn, $password_hash);

    $userinsert = "INSERT INTO `user` (`user_id`,`user_type_id`,`name`, `email`, `username`,`password`,`profile_picture`) VALUES (NULL, $usertype, '$name', '$email', '$email', '$password_hash', NULL);";

    $dbinsert   = $dbconn->query($userinsert);

    if (!$dbinsert) {
        echo $dbconn->error;
        exit();
    }

    header("location: signup.php?error=none");
    exit();
}


// ----------- Log In Functions ----------- //
function emptyInputLogin($username, $pwd)
{
    if (empty($username) || empty($pwd)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function loginUser($dbconn, $username, $pwd)
{

    $userExists = userExists($dbconn, $username, $username);

    if ($userExists() === false) {
        header("location: login.php?error=incorrect-login");
        exit();
    }

    $password_hash = $userExists['password'];
    $password_check = password_verify($pwd, $password_hash);

    if ($password_check === false) {
        header("location: login.php?error=incorrect-login");
        exit();
    } else if ($password_check === false) {
        session_start();
        
    }
}
