<?php
/**
 * Created by PhpStorm.
 * User: Nickos
 * Date: 2/5/2015
 * Time: 12:18 πμ
 */

mb_internal_encoding( 'UTF-8' );

//Server and Database
$SERVER = "localhost";
$DB_USERNAME = "root";
$DB_PASSWORD = "";
$DB_NAME = "samosrentals";

function db_connect()
{
    global $SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME;

    // Establishing Connection with Server
    $mysqli = new mysqli($SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
    mysqli_set_charset($mysqli, "utf8");

    return $mysqli;
}

function islogged()
{
    if (isset($_SESSION['expire'])) {
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

function isAdmin()
{
    if (isset($_SESSION['role']) && $_SESSION['role'] == 0) {
        return true;
    }
    return false;
}

function debug_to_console($data)
{
    if (is_array($data) || is_object($data)) {
        echo("<script>console.log('PHP: " . json_encode($data) . "');</script>");
    } else {
        echo("<script>console.log('PHP: " . $data . "');</script>");
    }
}

?>