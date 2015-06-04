<?php

include_once '../admin/configuration.php';
session_start();
try {
    if (!isset($_GET["auctionID"])) {
        throw new Exception("Id is not set");
    }
    $con = db_connect();
    $userBidStmt = "SELECT MAX(BidMoney) as UserBid FROM bid WHERE Username=? AND idAuction=?";

    // <editor-fold defaultstate="collapsed" desc="Prepare and run statement">
    // <editor-fold defaultstate="collapsed" desc="Error checking">
    if (!$userBid = $con->prepare($userBidStmt)) {
        throw new Exception("\nPrepared '" . $userBidStmt . "' statement failed. \nDetails: " . mysqli_error($con));
    }
    // </editor-fold>
    $userBid->bind_param('si', $_SESSION["userid"], $_GET["auctionID"]);

    // <editor-fold defaultstate="collapsed" desc="Error checking">
    if (!$userBid->execute()) {
        trigger_error("Execute error: \"" . $userBidStmt . "\"" . "\n");
        trigger_error("Execute failed: (" . $userBid->errno . ") " . $userBid->error . "\"" . "\n");
        throw new Exception("Statement failed to execute");
    }
    // </editor-fold>
    // </editor-fold>

    $resultUserBid = $userBid->get_result();
    $userBidRow = mysqli_fetch_array($resultUserBid);
    echo '{"success":"yes", "value":"' . $userBidRow["UserBid"] . '"}';
} catch (Exception $e) {
    trigger_error("##Error at " . __FILE__ . "\"\nDetails: " . $e->getMessage() . "\"" . "\n");
    echo $highestBid = '{"success":"no}';
}
?>