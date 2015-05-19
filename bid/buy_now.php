<?php

//http://localhost:8000/bid/buy_now.php?action=&buy_value=5&auctionID=7
try {
    if (!isset($_GET["buy_value"])) {
        throw new Exception("buy_value is not set");
    }

    //http_get("/bid/highest_bid?auctionID=" + $_GET["auctionID"]);
    include '/highest_bid.php';
    $var = json_decode($highestBid);
    if ($var->value > $_GET["buy_value"]) {
        echo "-1";
    }

    $auctionDetailsStmt = "INSERT INTO bid(Username,BidMoney,idAuction) VALUES (?,?,?)";

    // <editor-fold defaultstate="collapsed" desc="Prepare and run statement">
    // <editor-fold defaultstate="collapsed" desc="Error checking">
    $con = db_connect();
    if (!$auctionDetails = $con->prepare($auctionDetailsStmt)) {
        throw new Exception("\nPrepared '" . $auctionDetailsStmt . "' statement failed. \nDetails: " . mysqli_error($con));
    }
    // </editor-fold>
    $auctionDetails->bind_param('sii', $_SESSION["userid"], $_GET["buy_value"], $_GET["auctionID"]);

    // <editor-fold defaultstate="collapsed" desc="Error checking">
    if (!$auctionDetails->execute()) {
        error_log("Execute error: \"" . $auctionDetailsStmt . "\"" . "\n", 3, $errorpath);
        error_log("Execute failed: (" . $auctionDetails->errno . ") " . $auctionDetails->error . "\"" . "\n", 3, $errorpath);
        throw new Exception("Statement failed to execute");
    }
    // </editor-fold>
    // </editor-fold>

    $resulauctionDetails = $auctionDetails->get_result();
    //$res->num_rows
    if ($auctionDetails->affected_rows == 1) {
        
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
            error_log("Execute error: \"" . $auctionDetailsStmt . "\"" . "\n", 3, $errorpath);
            error_log("Execute failed: (" . $auctionDetails->errno . ") " . $auctionDetails->error . "\"" . "\n", 3, $errorpath);
            throw new Exception("Statement failed to execute");
        }
        // </editor-fold>
        // </editor-fold>

        $resulauctionDetails = $auctionDetails->get_result();
    }

    echo '1';
} catch (Exception $e) {
    error_log("##Error at " . __FILE__ . "\"\nDetails: " . $e->getMessage() . "\"" . "\n", 3, $errorpath);
    echo '-1';
}
?>

