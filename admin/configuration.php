<?php

//Check if browser is internet Explorer and die, multiple times....
$firefox = strpos($_SERVER["HTTP_USER_AGENT"], 'Firefox') ? true : false;
$safari = strpos($_SERVER["HTTP_USER_AGENT"], 'Safari') ? true : false;
$chrome = strpos($_SERVER["HTTP_USER_AGENT"], 'Chrome') ? true : false;

if (!($firefox || $safari || $chrome)) {
    $Error_404 = "<b>Ο Internet Explorer</b> προς το παρών <b>δεν</b> υποστηρίζεται. Παρακαλώ δοκιμάστε άλλον περιηγητή!";
    die(include '404.php');
}

mb_internal_encoding('UTF-8');

//Server and Database
$SERVER = "localhost";
$DB_USERNAME = "root";
$DB_PASSWORD = "root";
$DB_NAME = "samosrentals";

function db_connect() {
    global $SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME;

    // Establishing Connection with Server
    $mysqli = @new mysqli($SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);


    if ($mysqli->connect_error) {
        $Error_404 = "<b>Η βάση δεδομένων</b> φαίνεται να είναι offline, παρακαλώ προσπαθείστε αργότερα.";
        die(include '404.php');
    }

    mysqli_set_charset($mysqli, "utf8");

    return $mysqli;
}

function islogged() {
    if (isset($_SESSION['expire']) && session_status() == PHP_SESSION_ACTIVE) {
        $now = time();
        if ($now > $_SESSION['expire']) {
            session_destroy();
            return false;
        }
        //renew expiration
        $_SESSION['start'] = time(); // Taking now logged in time.
        $_SESSION['expire'] = $_SESSION['start'] + (30 * 60);

        if (isset($_SESSION['role']) && $_SESSION['role'] >= 0) {
            return true;
        }
    }
    return false;
}

function isAdmin() {
    if (isset($_SESSION['role']) && $_SESSION['role'] == 0) {
        return true;
    }
    return false;
}

function debug_to_console($data) {
    if (is_array($data) || is_object($data)) {
        echo("<script>console.log('PHP: " . json_encode($data) . "');</script>");
    } else {
        echo("<script>console.log('PHP: " . $data . "');</script>");
    }
}

function cropOutput($str, $val) {
    return strlen($str) <= $val ? $str : substr($str, 0, $val) . '...';
}

function isRole($role) {
    if (!islogged()) {
        return false;
    }

    $level = $_SESSION['role'];
    if ($level == 0 && $role == "admin") {
        return true;
    } else if ($level == 1 && $role == "hotelier") {
        return true;
    } else if ($level == 2 && $role == "user") {
        return true;
    } else {
        return false;
    }
}