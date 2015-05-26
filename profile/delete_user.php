<?php
include_once "../admin/configuration.php";
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_GET["userID"]) && !empty($_GET["userID"])) {
    $con = db_connect();
    // SQL query to fetch information of registerd users and finds user match.
    $sql = $con->prepare('DELETE FROM user WHERE Username=?');
    $sql->bind_param('s', $_GET["userID"]);
    $sql->execute();
}
