<?php

// <editor-fold defaultstate="collapsed" desc="Requires">
require '../admin/configuration.php';
session_start();
// </editor-fold>

if (empty($_GET["SaEdHotName"])) {
    echo '{"success":"no"}';
    return;
}
// <editor-fold defaultstate="collapsed" desc="Variables' declare">
$table = "hotel";

$dbColumns = array("Name", "Coordinates", "Description", "Comforts", "Image", "Tel", "Manager");
$formGetNames = array("SaEdHotName", "SaEdHotCoordinates", "SaEdHotDescription", "SaEdHotComforts", "SaEdHotImage", "SaEdHotTel", "SaEdHotChooseHotelier");

if (strcmp($_GET["SaEdHotAction"], "edit") == 0) {
    array_push($dbColumns, "ID");
    array_push($formGetNames, "SaEdHotID");
}
if (!isAdmin()) {
    $_GET["SaEdHotChooseHotelier"] = $_SESSION['userid'];
}
$formValues = array();

//debug_to_console("Con: " . $_GET["SaEdHotComforts"] . "\t Test: \"" . "\"" . "\n", 3, $errorpath);
//$_GET["End_Date"] = DateTime::createFromFormat('d F, Y', $_GET["End_Date"])->format('Y-m-d') . " 23:59:59";
for ($i = 0; $i < count($formGetNames); $i++) {
    $formValues[] = addslashes($_GET[$formGetNames[$i]]);
}
//debug_to_console("Date: " . $_GET["End_Date"] . "\t Test: \"" . "\"" . "\n", 3, $errorpath);
// </editor-fold>

if (strcmp($_GET["SaEdHotAction"], "edit") == 0) {

    // <editor-fold defaultstate="collapsed" desc="Connect to database">
    $con = db_connect();
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="Construct insert statement">
    $updateColumns = "";
    for ($j = 0; $j < count($dbColumns) - 1; $j++) {

        $updateColumns = $updateColumns . $dbColumns[$j] . "='" . $formValues[$j] . "',";
    }

    $updateColumns = $updateColumns . $dbColumns[count($dbColumns) - 1] . "='" . $formValues[count($dbColumns) - 1] . "'";

    $statement = "UPDATE " . $table . " SET " . $updateColumns . " WHERE ID=" . $_GET["SaEdHotID"];
    //debug_to_console("Statement: " . $statement . "\"" . "\n", 3, $errorpath);
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="Run query">
    $result = mysqli_query($con, $statement);
    if ($result == NULL) {
        //debug_to_console("Could not run update query: \"" . $statement . "\"" . "\n", 3, $errorpath);
        //debug_to_console("Cause: \"" . mysqli_error($con) . "\"" . "\n", 3, $errorpath);
        echo '{"success":"no"}';
    } else {
        echo '{"success":"yes"}';
    }
    // </editor-fold>
    mysqli_close($con);
    /* debug_to_console("The word parameter is empty" . "\n", 3, $errorpath);
      echo "0";
      exit(); */
} else if (strcmp($_GET["SaEdHotAction"], "new") == 0) {

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
        //debug_to_console("Could not run insert query: \"" . $statement . "\"" . "\n", 3, $errorpath);
        //debug_to_console("Cause: \"" . mysqli_error($con) . "\"" . "\n", 3, $errorpath);
        echo '{"success":"no"}';
    } else {
        echo '{"success":"yes"}';
    }
    // </editor-fold>
    mysqli_close($con);
} else {
    //debug_to_console("SaEdHotAction is empty \"\"" . "\n", 3, $errorpath);
}
?>