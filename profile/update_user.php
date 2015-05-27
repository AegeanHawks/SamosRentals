<?php
include_once "../admin/configuration.php";

if (isset($_GET["userID"]) && !empty($_GET["userID"])) {
    $con = db_connect();
    // SQL query to fetch information of registerd users and finds user match.
    $sql = $con->prepare('UPDATE user SET Role=1, Upgrade=0 WHERE Username=?');
    $sql->bind_param('s', $_GET["userID"]);
    $sql->execute();
}
