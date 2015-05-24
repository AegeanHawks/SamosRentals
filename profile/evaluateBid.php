<?php
include_once "../admin/configuration.php";
session_start();

if (!isset($_GET["Grade"]) or empty($_GET["Grade"])) {
    echo '{"success":"no"}';
    return;
}
if (!isset($_GET["auctionID"]) or empty($_GET["auctionID"])) {
    echo '{"success":"no"}';
    return;
}
$con = db_connect();
$sql = $con->prepare("UPDATE auction SET Evaluation=? WHERE Highest_Bidder=? AND ID=?");
$sql->bind_param('isi', $_GET["Grade"], $_SESSION["userid"], $_GET["auctionID"]);
$sql->execute();

$result = $sql->get_result();
if ($sql->affected_rows == 1) {
    echo '{"success":"yes"}';
} else {
    echo '{"success":"no","cause":"rows"}';
}
