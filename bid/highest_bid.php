<?php


include_once '../admin/configuration.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//http://localhost:8000/bid/highest_bid.php?auctionID=7

try {
    if (!isset($_GET["auctionID"])) {
        throw new Exception("Id is not set");
    }
    $con = db_connect();
    $auctionDetailsStmt = "SELECT MAX(BidMoney) as BidMoney FROM bid, auction WHERE auction.ID=? AND bid.idAuction=auction.ID";

    // <editor-fold defaultstate="collapsed" desc="Prepare and run statement">
    // <editor-fold defaultstate="collapsed" desc="Error checking">
    if (!$auctionDetails = $con->prepare($auctionDetailsStmt)) {
        throw new Exception("\nPrepared '" . $auctionDetailsStmt . "' statement failed. \nDetails: " . mysqli_error($con));
    }
    // </editor-fold>
    $auctionDetails->bind_param('i', $_GET["auctionID"]);


    // <editor-fold defaultstate="collapsed" desc="Error checking">
    if (!$auctionDetails->execute()) {
        trigger_error("Execute error: \"" . $auctionDetailsStmt . "\"" . "\n");
        trigger_error("Execute failed: (" . $auctionDetails->errno . ") " . $auctionDetails->error . "\"" . "\n");
        throw new Exception("Statement failed to execute");
    }
    // </editor-fold>

    $resulauctionDetails = $auctionDetails->get_result();
    if (mysqli_num_rows($resulauctionDetails) > 1) {
        throw new Exception("Wrong number of results");
    }
    // </editor-fold>

    $auctionDetailsRow = mysqli_fetch_array($resulauctionDetails);
    if ($resulauctionDetails->num_rows == 0) {
        $highestBid = '{"success":"yes", "value":"0"}';
        echo $highestBid;
    } else {
        $highestBid = '{"success":"yes", "value":"' . $auctionDetailsRow["BidMoney"] . '"}';
        echo $highestBid;
    }
} catch (Exception $e) {
    trigger_error("##Error at " . __FILE__ . "\"\nDetails: " . $e->getMessage() . "\"" . "\n");
    $highestBid = '{"success":"no"}';
    echo $highestBid;
}
?>

