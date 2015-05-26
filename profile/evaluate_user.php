<?php
include_once "../admin/configuration.php";

if (!isset($_GET["Grade"]) or empty($_GET["Grade"])) {
    echo '{"success":"no"}';
    return;
}
if (!isset($_GET["userID"]) or empty($_GET["userID"])) {
    echo '{"success":"no"}';
    return;
}
$con = db_connect();
$sql = $con->prepare("UPDATE auction SET GradeOfUser=? WHERE Highest_Bidder=?");
$sql->bind_param('is', $_GET["Grade"], $_GET["userID"]);
$sql->execute();

$result = $sql->get_result();
if ($sql->affected_rows == 1) {
    echo '{"success":"yes"}';
} else {
    echo '{"success":"no","cause":"rows"}';
}
