<?php
include_once "../admin/configuration.php";
session_start();

$con = db_connect();
// SQL query to fetch information of registerd users and finds user match.
$sql = $con->prepare('UPDATE user SET Active=0 WHERE Username=?');

if (isRole('admin')) {
    if (isset($_GET["userID"]) && !empty($_GET["userID"])) {
        $sql->bind_param('s', $_GET["userID"]);
        $sql->execute();

        if ($_SESSION['userid'] == $_GET["userID"]) {
            session_destroy();

            header('location: profile.php?user=' . $_GET["userID"]);
        }
    } else {
        $sql->bind_param('s', $_SESSION['userid']);
        $sql->execute();
        session_destroy();

        header('location: ../profile.php?user=' . $_SESSION['userid']);
    }
} else {
    $sql->bind_param('s', $_SESSION['userid']);
    $sql->execute();
    session_destroy();

    header('location: ../profile.php?user=' . $_SESSION['userid']);
}