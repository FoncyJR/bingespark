<?php

//delete account
if (isset($_POST['submit'])) {

    include_once("../database/dbconn.php");
    include_once("../partials/functions.php");

    $user_id = $_POST["userid"];
    deleteAdminAccount($dbconn, $user_id);

    header("location: admin_profile.php");
}