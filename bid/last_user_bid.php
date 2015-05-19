<?php

try {
    $userBidStmt = "SELECT MAX(BidMoney) as UserBid FROM bid WHERE Username=? AND idAuction=?";

    // <editor-fold defaultstate="collapsed" desc="Prepare and run statement">
    // <editor-fold defaultstate="collapsed" desc="Error checking">
    if (!$userBid = $con->prepare($userBidStmt)) {
        throw new Exception("\nPrepared '" . $userBidStmt . "' statement failed. \nDetails: " . mysqli_error($con));
    }
    // </editor-fold>
    $userBid->bind_param('si', $_SESSION["userid"], $_GET["id"]);

    // <editor-fold defaultstate="collapsed" desc="Error checking">
    if (!$userBid->execute()) {
        error_log("Execute error: \"" . $userBidStmt . "\"" . "\n", 3, $errorpath);
        error_log("Execute failed: (" . $userBid->errno . ") " . $userBid->error . "\"" . "\n", 3, $errorpath);
        throw new Exception("Statement failed to execute");
    }
    // </editor-fold>
    // </editor-fold>

    $resultUserBid = $userBid->get_result();
    $userBidRow = mysqli_fetch_array($resultUserBid);
    echo $userBidRow["UserBid"];
} catch (Exception $e) {
    error_log("##Error at ".__FILE__."\"\nDetails: " . $e->getMessage() . "\"" . "\n", 3, $errorpath);
}

?>