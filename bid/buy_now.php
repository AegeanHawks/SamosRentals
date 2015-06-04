<?php

//http://localhost:8000/bid/buy_now.php?action=&buy_value=5&auctionID=7
session_start();
include_once '../admin/configuration.php';

try {
    if (!isset($_GET["auctionID"])) {
        throw new Exception("buy_value is not set");
    }


    
    // <editor-fold defaultstate="collapsed" desc="Check if auction is closed">
    ob_start();
    include './auction_is_closed.php';
    $auctionIsClosed = ob_get_clean();
    

    $auctionIsClosedjson = json_decode($auctionIsClosed);
    if ($auctionIsClosedjson->success == "no") {
        throw new Exception("There is an error in auction_is_closed.php");
    }
    if ($auctionIsClosedjson->closed == "yes") {
        throw new Exception("Auction is closed");
    }
    // </editor-fold>


    $auctionDetailsStmt = "INSERT INTO bid(Username,BidMoney,idAuction) VALUES (?,(SELECT Buy_Price FROM auction WHERE ID=?),?)";

    // <editor-fold defaultstate="collapsed" desc="Prepare and run statement">
    // <editor-fold defaultstate="collapsed" desc="Error checking">
    $con = db_connect();
    if (!$auctionDetails = $con->prepare($auctionDetailsStmt)) {
        throw new Exception("\nPrepared '" . $auctionDetailsStmt . "' statement failed. \nDetails: " . mysqli_error($con));
    }
    // </editor-fold>
    $auctionDetails->bind_param('sii', $_SESSION["userid"], $_GET["auctionID"], $_GET["auctionID"]);

    // <editor-fold defaultstate="collapsed" desc="Error checking">
    if (!$auctionDetails->execute()) {
        trigger_error("Execute error: \"" . $auctionDetailsStmt . "\"" . "\n");
        trigger_error("Execute failed: (" . $auctionDetails->errno . ") " . $auctionDetails->error . "\"" . "\n");
        throw new Exception("Statement failed to execute");
    }
    // </editor-fold>
    // </editor-fold>

    $resulauctionDetails = $auctionDetails->get_result();
    //$res->num_rows
    if ($auctionDetails->affected_rows == 1) {

        $auctionDetailsStmt = "UPDATE auction SET Highest_Bidder=?, Closed=1 WHERE ID=?";

        // <editor-fold defaultstate="collapsed" desc="Prepare and run statement">
        // <editor-fold defaultstate="collapsed" desc="Error checking">
        if (!$auctionDetails = $con->prepare($auctionDetailsStmt)) {
            throw new Exception("\nPrepared '" . $auctionDetailsStmt . "' statement failed. \nDetails: " . mysqli_error($con));
        }
        // </editor-fold>
        $auctionDetails->bind_param('si', $_SESSION["userid"], $_GET["auctionID"]);

        // <editor-fold defaultstate="collapsed" desc="Error checking">
        if (!$auctionDetails->execute()) {
            trigger_error("Execute error: \"" . $auctionDetailsStmt . "\"" . "\n");
            trigger_error("Execute failed: (" . $auctionDetails->errno . ") " . $auctionDetails->error . "\"" . "\n");
            throw new Exception("Statement failed to execute");
        }
        // </editor-fold>
        // </editor-fold>

        $resulauctionDetails = $auctionDetails->get_result();
    }

    echo '{"success":"yes"}';
} catch (Exception $e) {
    trigger_error("##Error at " . __FILE__ . "\"\nDetails: " . $e->getMessage() . "\"" . "\n");
    echo '{"success":"no"}';
}
?>

