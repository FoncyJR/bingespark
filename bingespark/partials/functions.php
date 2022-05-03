<?php

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

function createUser($dbconn, $name, $email, $password)
{

    $sql = "INSERT INTO `user` (`name`, `email`, `password`) VALUES (?, ?, ?);";
    $statement = mysqli_stmt_init($dbconn);

    if (!mysqli_stmt_prepare($statement, $sql)) {
        header("location: signup.php?error=stmt-failed");
        exit();
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($statement, "sss", $name, $email, $password_hash);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);

    header("location: signup.php?error=none");
    exit();
}
