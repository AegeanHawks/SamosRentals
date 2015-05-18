<?php

try {
    if (!isset($_GET["auctionID"])) {
        throw "Id is not set";
    }
    $auctionDetailsStmt = "SELECT BidMoney FROM bid, auction WHERE auction.ID=? AND bid.idAuction=auction.ID";

    // <editor-fold defaultstate="collapsed" desc="Prepare and run statement">
    // <editor-fold defaultstate="collapsed" desc="Error checking">
    if (!$auctionDetails = $con->prepare($auctionDetailsStmt)) {
        throw new Exception("\nPrepared '" . $auctionDetailsStmt . "' statement failed. \nDetails: " . mysqli_error($con));
    }
    // </editor-fold>
    $auctionDetails->bind_param('i', $_GET["id"]);


    // <editor-fold defaultstate="collapsed" desc="Error checking">
    if (!$auctionDetails->execute()) {
        error_log("Execute error: \"" . $auctionDetailsStmt . "\"" . "\n", 3, $errorpath);
        error_log("Execute failed: (" . $auctionDetails->errno . ") " . $auctionDetails->error . "\"" . "\n", 3, $errorpath);
        throw new Exception("Statement failed to execute");
    }
    // </editor-fold>

    $resulauctionDetails = $auctionDetails->get_result();
    if (mysqli_num_rows($resulauctionDetails) != 1) {
        throw new Exception("Wrong number of results");
    }
    // </editor-fold>

    $auctionDetailsRow = mysqli_fetch_array($resulauctionDetails);
    echo '{"success":"yes", "value":"' . $auctionDetailsRow["BidMoney"] . '"}';
} catch (Exception $e) {
    error_log("##Error at auction details: \"" . $e->getMessage() . "\"" . "\n", 3, $errorpath);
    echo '{"success":"no"}';
}
?>

