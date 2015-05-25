<?php

include_once '../admin/configuration.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

try {
    // <editor-fold defaultstate="collapsed" desc="Check values">
    // <editor-fold defaultstate="collapsed" desc="Check if variables are set">
    if (!isset($_GET["bid_value"]) || !isset($_GET["auctionID"])) {
        throw new Exception("Id is not set");
    }// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="Check if auction is closed">
    ob_start();
    include '/auction_is_closed.php';
    $auctionIsClosed = ob_get_clean();


    $auctionIsClosedjson = json_decode($auctionIsClosed);
    if ($auctionIsClosedjson->success == "no" || $auctionIsClosedjson->closed == "yes") {
        throw new Exception("Auction is closed or there is an error");
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="Check if bid value is bigger than highest bid value">
    ob_start();
    include '/highest_bid.php';
    $highestBid = ob_get_clean();

    $highestBidjson = json_decode($highestBid);
    if ($highestBidjson->value >= $_GET["bid_value"]) {
        throw new Exception("The bid price is lower than the current price");
    }// </editor-fold>
    // </editor-fold>


    // <editor-fold defaultstate="collapsed" desc="Insert values into bid">
    $con = db_connect();
    $auctionDetailsStmt = "INSERT INTO bid(Username,BidMoney,idAuction) VALUES (?,?,?)";

    // <editor-fold defaultstate="collapsed" desc="Prepare and run statement">
    // <editor-fold defaultstate="collapsed" desc="Error checking">
    if (!$auctionDetails = $con->prepare($auctionDetailsStmt)) {
        throw new Exception("\nPrepared '" . $auctionDetailsStmt . "' statement failed. \nDetails: " . mysqli_error($con));
    }
    // </editor-fold>
    $auctionDetails->bind_param('sii', $_SESSION["userid"], $_GET["bid_value"], $_GET["auctionID"]);

    // <editor-fold defaultstate="collapsed" desc="Error checking">
    if (!$auctionDetails->execute()) {
        debug_to_console("Execute error: \"" . $auctionDetailsStmt . "\"" . "\n", 3, $errorpath);
        debug_to_console("Execute failed: (" . $auctionDetails->errno . ") " . $auctionDetails->error . "\"" . "\n", 3, $errorpath);
        throw new Exception("Statement failed to execute");
    }
    // </editor-fold>
    // </editor-fold>

    $resulauctionDetails = $auctionDetails->get_result(); // </editor-fold>


    // <editor-fold defaultstate="collapsed" desc="Set highest bidder">
    $auctionDetailsStmt = "UPDATE auction SET Highest_Bidder=? WHERE ID=?";

    // <editor-fold defaultstate="collapsed" desc="Prepare and run statement">
    // <editor-fold defaultstate="collapsed" desc="Error checking">
    if (!$auctionDetails = $con->prepare($auctionDetailsStmt)) {
        throw new Exception("\nPrepared '" . $auctionDetailsStmt . "' statement failed. \nDetails: " . mysqli_error($con));
    }
    // </editor-fold>
    $auctionDetails->bind_param('si', $_SESSION["userid"], $_GET["auctionID"]);

    // <editor-fold defaultstate="collapsed" desc="Error checking">
    if (!$auctionDetails->execute()) {
        debug_to_console("Execute error: \"" . $auctionDetailsStmt . "\"" . "\n", 3, $errorpath);
        debug_to_console("Execute failed: (" . $auctionDetails->errno . ") " . $auctionDetails->error . "\"" . "\n", 3, $errorpath);
        throw new Exception("Statement failed to execute");
    }
    // </editor-fold>
    // </editor-fold>

    $resulauctionDetails = $auctionDetails->get_result(); // </editor-fold>


    echo '{"success":"yes"}';
} catch (Exception $e) {
    error_log("##Error at " . __FILE__ . "\"\nDetails: " . $e->getMessage() . "\"" . "\n");
    if ($e->getMessage() == "The bid price is lower than the current price") {
        echo '{"success":"no","state":"-1"}';
    } else {
        echo '{"success":"no"}';
    }
}
?>

