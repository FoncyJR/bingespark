<?php

// destroy session variables created by login
session_start();
session_unset();
session_destroy();

header("location: ../index.php");