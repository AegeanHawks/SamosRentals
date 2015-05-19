<?php

try {
    if (!isset($_GET["bid_value"]) || !isset($_GET["auctionID"])) {
        throw "Id is not set";
    }

    if (http_get($SERVER . "/bid/highest_bid?auctionID=" + $_GET["auctionID"]) > $_GET["bid_value"]) {
        echo '{"success":"no"}';
    }

    $auctionDetailsStmt = "INSERT INTO bid('Username','BidMoney','idAuction) VALUES (?,?,?)";

    // <editor-fold defaultstate="collapsed" desc="Prepare and run statement">
    // <editor-fold defaultstate="collapsed" desc="Error checking">
    if (!$auctionDetails = $con->prepare($auctionDetailsStmt)) {
        throw new Exception("\nPrepared '" . $auctionDetailsStmt . "' statement failed. \nDetails: " . mysqli_error($con));
    }
    // </editor-fold>
    $auctionDetails->bind_param('sii', $_SESSION["userid"], $_GET["id"],$_GET["auctionID"]);

    // <editor-fold defaultstate="collapsed" desc="Error checking">
    if (!$auctionDetails->execute()) {
        error_log("Execute error: \"" . $auctionDetailsStmt . "\"" . "\n", 3, $errorpath);
        error_log("Execute failed: (" . $auctionDetails->errno . ") " . $auctionDetails->error . "\"" . "\n", 3, $errorpath);
        throw new Exception("Statement failed to execute");
    }
    // </editor-fold>
    // </editor-fold>

    $resulauctionDetails = $auctionDetails->get_result();
    
    echo '{"success":"yes"}';
} catch (Exception $e) {
    error_log("##Error at ".__FILE__."\"\nDetails: " . $e->getMessage() . "\"" . "\n", 3, $errorpath);
    echo '{"success":"no"}';
}
?>

