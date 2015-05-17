<?php

// <editor-fold defaultstate="collapsed" desc="Requires">
require '../admin/configuration.php';
session_start();
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Variables' declare">
$table = "auction";

$dbColumns = array("Name", "Description", "Bid_Price", "Buy_Price", "PeopleCount", "End_Date", "Images");
$formGetNames = array("AuctionName", "Description", "Bid_Price", "Buy_Price", "PeopleCount", "End_Date", "Images", );

if (strcmp($_GET["SaAuDeAction"], "new") == 0) {
    array_push($dbColumns, "Hotel");
    array_push($formGetNames, "CrAuHotelID");
} else if (strcmp($_GET["SaAuDeAction"], "edit") == 0) {
    array_push($dbColumns, "Closed", "ID");
    array_push($formGetNames, "Closed","AuctionID");
}

$formValues = array();

//$_GET["End_Date"] = DateTime::createFromFormat('d F, Y', $_GET["End_Date"])->format('Y-m-d') . " 23:59:59";
for ($i = 0; $i < count($formGetNames); $i++) {
    $formValues[] = $_GET[$formGetNames[$i]];
}
error_log("Date: " . $_GET["End_Date"] . "\t Test: \"" . "\"" . "\n", 3, $errorpath);

// </editor-fold>

if (strcmp($_GET["SaAuDeAction"], "edit") == 0) {

    // <editor-fold defaultstate="collapsed" desc="Connect to database">
    $con = db_connect();
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="Construct insert statement">
    $updateColumns = "";
    for ($j = 0; $j < count($dbColumns) - 1; $j++) {

        $updateColumns = $updateColumns . $dbColumns[$j] . "='" . $formValues[$j] . "',";
    }

    $updateColumns = $updateColumns . $dbColumns[count($dbColumns) - 1] . "='" . $formValues[count($dbColumns) - 1] . "'";

    $statement = "UPDATE " . $table . " SET " . $updateColumns . " WHERE ID=" . $_GET["AuctionID"];
    error_log("Statemnt: " . $statement . "\"" . "\n", 3, $errorpath);
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="Run query">
    $result = mysqli_query($con, $statement);
    if ($result == NULL) {
        error_log("Could not run query: \"" . $statement . "\"" . "\n", 3, $errorpath);
        echo "0";
    } else {
        echo "1";
    }
    // </editor-fold>
    mysqli_close($con);
    /* error_log("The word parameter is empty" . "\n", 3, $errorpath);
      echo "0";
      exit(); */
} else {

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="Connect to database">
    $con = db_connect();
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="Construct insert statement">
    $insertColumns = "";
    $insertValues = "'";
    for ($j = 0; $j < count($dbColumns) - 1; $j++) {
        $insertColumns = $insertColumns . $dbColumns[$j] . ",";
        $insertValues = $insertValues . $formValues[$j] . "','";
    }
    $insertColumns = $insertColumns . $dbColumns[count($dbColumns) - 1];
    $insertValues = $insertValues . $formValues[count($dbColumns) - 1] . "'";
    $statement = "SELECT " . $insertColumns . " FROM " . $table;
    $statement = "INSERT INTO " . $table . "(" . $insertColumns . ")" . " VALUES( " . $insertValues . ")";
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="Run query">
    $result = mysqli_query($con, $statement);
    if ($result == NULL) {
        error_log("Could not run query: \"" . $statement . "\"" . "\n", 3, $errorpath);
        echo "0";
    } else {
        echo "1";
    }
    // </editor-fold>
    mysqli_close($con);
}
?>