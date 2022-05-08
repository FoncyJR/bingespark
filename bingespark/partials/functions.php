<?php

// $currentfile = dirname(__FILE__);

// if ((str_contains($currentfile, "database")) || (str_contains($currentfile, "search")) || (str_contains($currentfile, "user")) || (str_contains($currentfile, "admin"))) {
//     include("../database/dbconn.php");
// } else {
//     include("database/dbconn.php");
// }


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
    // // check user exists
    // $check_user = "SELECT * FROM user WHERE username = ? OR email = ?";
    // $statement = mysqli_stmt_init($dbconn);
    // if (!mysqli_stmt_prepare($statement, $check_user)) {
    //     header("location: signup.php?error=user-exists");
    //     exit();
    // }
    // mysqli_stmt_bind_param($statement, "ss", $username, $email);
    // mysqli_stmt_execute($statement);

    // $result_data = mysqli_stmt_get_result($statement);

    // if ($row = mysqli_fetch_assoc($result_data)) {
    //     return $row;
    // } else {
    //     $result = false;
    //     return $result;
    // }

    // mysqli_stmt_close($statement);

    $check_user = "SELECT * FROM user WHERE username = '$username' OR email = '$email'";

    $dbcheck  = $dbconn->query($check_user);

    if (!$dbcheck) {
        echo $dbconn->error;
        exit();
    }

    if ($row = mysqli_fetch_assoc($dbcheck)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }
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

    if ($userExists === false) {
        header("location: login.php?error=incorrect-login");
        exit();
    }

    $password_hash = $userExists['password'];
    $password_check = password_verify($pwd, $password_hash);

    if ($password_check === false) {
        header("location: login.php?error=incorrect-login");
        exit();
    } else if ($password_check === true) {


        session_start();
        $_SESSION["user_id"] = $userExists["user_id"];
        $_SESSION["user_type_id"] = $userExists["user_type_id"];
        $_SESSION["name"] = $userExists["name"];
        $_SESSION["email"] = $userExists["email"];
        $_SESSION["username"] = $userExists["username"];
        $_SESSION["profile_picture"] = $userExists["profile_picture"];


        header("location: ../index.php");
        exit();
    }
}

function changeUsername($dbconn, $user_id, $new_username)
{

    $sql = "SELECT * FROM user WHERE user_id = $user_id";

    $select   = $dbconn->query($sql);

    if (!$select) {
        echo $dbconn->error;
        exit();
    }

    $new_username_esc = mysqli_real_escape_string($dbconn, $new_username);

    $changeusername = "UPDATE `user` SET `username` = $new_username_esc WHERE `user`.`user_id` = $user_id;";

    $sqlchangeuser = $dbconn->query($changeusername);

    if (!$sqlchangeuser) {
        echo $dbconn->error;
        exit();
    }
}

function changePassword($dbconn, $user_id, $new_password)
{

    $sql = "SELECT * FROM user WHERE user_id = $user_id";

    $select   = $dbconn->query($sql);

    if (!$select) {
        echo $dbconn->error;
        exit();
    }
    $new_password_esc = mysqli_real_escape_string($dbconn, $new_password);
    $new_password_esc_hash = password_hash($new_password, PASSWORD_DEFAULT);

    $changepassword = "UPDATE `user` SET `password` = $new_password_esc_hash WHERE `user`.`user_id` = $user_id;";

    $sqlchangepassword = $dbconn->query($changepassword);

    if (!$sqlchangepassword) {
        echo $dbconn->error;
        exit();
    }
}

function deleteAccount($dbconn)
{

    $user_id = $_SESSION["user_id"];
    $sql = "SELECT * FROM user WHERE user_id = $user_id";

    $select   = $dbconn->query($sql);

    if (!$select) {
        echo $dbconn->error;
        exit();
    }

    $deletesql = "DELETE FROM `user` WHERE `user`.`user_id` = $user_id";

    $sqldelete = $dbconn->query($deletesql);

    if (!$sqldelete) {
        echo $dbconn->error;
        exit();
    }


    session_unset();
    session_destroy();
    header("location: ../index.php");
    exit();
}


/*-----Admin -----*/

function checkAdmin($dbconn, $user_id)
{

    // $user_id = $_SESSION["user_id"];
    $check_user = "SELECT user.user_type_id FROM user WHERE user_id = $user_id";

    $dbcheck  = $dbconn->query($check_user);

    if (!$dbcheck) {
        echo $dbconn->error;
        exit();
    }

    if ($row = mysqli_fetch_assoc($dbcheck)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }

    $usertype = $_SESSION["user_type_id"];

    if ($usertype == 1) {
        $result_type = true;
    } else {
        $result_type = false;
    }
    return $result_type;
}


/*----- Admin Movies -----*/

function addMovie($dbconn, $title_esc, $year, $runtime, $revenue, $movie_desc_esc)
{
    $add_movie = "INSERT INTO movie (`movie_id`, `title`, `release_year`, `runtime`, `revenue`, `movie_desc`, `thumbnail`) 
            VALUES (NULL, '$title_esc', '$year', '$runtime', '$revenue', '$movie_desc_esc', NULL);";



    $add_movie_result = $dbconn->query($add_movie);

    if (!$add_movie_result) {
        echo $dbconn->query($add_movie);
    }

    header("location: admin_profile_ml.php");
}

function editMovie($dbconn, $title_esc, $year, $runtime, $revenue, $movie_desc_esc, $movie_id)
{
    $add_movie = "UPDATE `movie` 
                SET `title` = '$title_esc', `release_year` = '$year', `runtime` = '$runtime', `revenue` = '$revenue', `movie_desc` = '$movie_desc_esc' 
                 WHERE `movie`.`movie_id` = $movie_id;
    ";



    $add_movie_result = $dbconn->query($add_movie);

    if (!$add_movie_result) {
        echo $dbconn->query($add_movie);
    }

    header("location: admin_profile_ml.php");
}

function createAdmin($dbconn, $name, $email, $password)
{

    $usertype = 1;
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $name = mysqli_escape_string($dbconn, $name);
    $email = mysqli_escape_string($dbconn, $email);
    $password_hash = mysqli_escape_string($dbconn, $password_hash);

    $userinsert = "INSERT INTO `user` (`user_id`,`user_type_id`,`name`, `email`, `username`,`password`,`profile_picture`) 
    VALUES (NULL, $usertype, '$name', '$email', '$email', '$password_hash', NULL);";

    $dbinsert   = $dbconn->query($userinsert);

    if (!$dbinsert) {
        echo $dbconn->error;
        exit();
    }

    header("location: signup.php?error=none");
    exit();
}
function deleteAdminAccount($dbconn, $user_id)
{

    $sql = "SELECT * FROM user WHERE user_id = $user_id";

    $select   = $dbconn->query($sql);

    if (!$select) {
        echo $dbconn->error;
        exit();
    }

    $deletesql = "DELETE FROM `user` WHERE `user`.`user_id` = $user_id";

    $sqldelete = $dbconn->query($deletesql);

    if (!$sqldelete) {
        echo $dbconn->error;
        exit();
    }
    header("location: ../admin/admin_profile.php");
    exit();
}