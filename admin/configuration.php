<?php

// load enviromental variables
require __DIR__.'/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();
$dotenv->required(['DB_SERVER_NAME', 'DB_USERNAME', 'DB_PASSWORD', 'DB_NAME'])->notEmpty();

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
$SERVER = $_ENV['DB_SERVER_NAME'];
$DB_USERNAME = $_ENV['DB_USERNAME'];
$DB_PASSWORD = $_ENV['DB_PASSWORD'];
$DB_NAME = $_ENV['DB_NAME'];

function db_connect() {
    global $SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME;

    // Establishing Connection with Server
    $mysqli = new mysqli($_ENV['DB_SERVER_NAME'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'], $_ENV['DB_NAME']);


    if ($mysqli->connect_error) {
        $Error_404 = "<b>Η βάση δεδομένων</b> φαίνεται να είναι offline, παρακαλώ προσπαθείστε αργότερα.";
        die(include '404.php');
    }

    mysqli_set_charset($mysqli, "utf8");

    return $mysqli;
}

function islogged() {
    //check session
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
            //ask database
            $con = db_connect();
            // SQL query to fetch information of registerd users and finds user match.
            $sql = $con->prepare('select Active,Role from user WHERE Username=?');
            $sql->bind_param('s', $_SESSION["userid"]);
            $sql->execute();

            $result = $sql->get_result();
            $row = mysqli_fetch_array($result);
            if ($row['Active'] == '0') {
                return false;
            }
            $_SESSION['role'] = $row['Role'];

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