<?php

session_start();

if (!isset($_SESSION['registration']) && (!isset($_SESSION['user']) || !$_SESSION['login'] == true)) {
    header("location: login.php?error=Please login!");
    die();
}