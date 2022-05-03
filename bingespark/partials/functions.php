<?php

function emptyInputSignup($name, $email, $password, $password_repeat)
{
    $result = NULL;

    if (empty($name) || empty($email) || empty($password) || empty($password_repeat)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function invalidEmail($email)
{
    $result = NULL;

    if (!preg_match('/^[a-zA-Z0-9]*$/'), $email) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function passwordMatch($password, $password_repeat)
{
}

function emailExists($dbconn, $email)
{
}

function createUser($dbconn, $name, $email, $password)
{
}
