<?php
session_start();
require_once 'users.php';

if (!isset($_SESSION['user'])) {
    if (isset($_COOKIE['user'])) {
        $username = $_COOKIE['user'];
        if (isset($users[$username])) {
            $_SESSION['user'] = $username;
        }
    }
    if (!isset($_SESSION['user'])) {
        header('Location: sign-in.php');
        exit();
    }
}
?>
