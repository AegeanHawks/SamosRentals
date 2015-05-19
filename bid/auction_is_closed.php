<?php

include_once '../admin/configuration.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
////require '../admin/configuration.php';
//http://localhost:8000/bid/highest_bid.php?auctionID=7

try {
    if (!isset($_GET["auctionID"])) {
        throw new Exception("Id is not set");
    }
    $connectCloAu = db_connect();
    $auctionClosedStmt = "SELECT Closed FROM auction WHERE ID=?";

    // <editor-fold defaultstate="collapsed" desc="Prepare and run statement">
    // <editor-fold defaultstate="collapsed" desc="Error checking">
    if (!$auctionClosed = $connectCloAu->prepare($auctionClosedStmt)) {
        throw new Exception("\nPrepared '" . $auctionClosedStmt . "' statement failed. \nDetails: " . mysqli_error($connectCloAu));
    }
    // </editor-fold>
    $auctionClosed->bind_param('i', $_GET["auctionID"]);


    // <editor-fold defaultstate="collapsed" desc="Error checking">
    if (!$auctionClosed->execute()) {
        debug_to_console("Execute error: \"" . $auctionClosedStmt . "\"" . "\n", 3, $errorpath);
        debug_to_console("Execute failed: (" . $auctionClosed->errno . ") " . $auctionClosed->error . "\"" . "\n", 3, $errorpath);
        throw new Exception("Statement failed to execute");
    }
    // </editor-fold>

    $resulauctionClosed = $auctionClosed->get_result();
    // </editor-fold>

    $auctionClosedRow = mysqli_fetch_array($resulauctionClosed);
    if ($auctionClosedRow["Closed"] == 1) {
        $auctionIsClosed = '{"success":"yes","closed":"yes"}';
        echo $auctionIsClosed;
    } else if ($auctionClosedRow["Closed"] == 0){
        $auctionIsClosed = '{"success":"yes","closed":"no"}';
        echo $auctionIsClosed;
    }
} catch (Exception $e) {
    debug_to_console("##Error at " . __FILE__ . "\"\nDetails: " . $e->getMessage() . "\"" . "\n", 3, $errorpath);
    $auctionIsClosed = '{"success":"no"}';
    echo $auctionIsClosed;
}
?>

