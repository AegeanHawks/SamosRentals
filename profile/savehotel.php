<?php

// <editor-fold defaultstate="collapsed" desc="Requires">
require '../admin/configuration.php';
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Variables' declare">
$table = "hotel";

$dbColumns = array("Name", "Coordinates", "Description", "Comforts", "Image", "Tel");
$formGetNames = array("SaEdHotName", "SaEdHotCoordinates", "SaEdHotDescription", "SaEdHotComforts", "SaEdHotImage", "SaEdHotTel");
if(strcmp($_GET["SaEdHotAction"], "edit") != 0)
{
    array_push($dbColumns, "ID","Manager");
    array_push($formGetNames, "SaEdHotID","SaEdHotChooseHotelier");
}
$formValues = array();

//error_log("Con: " . $_GET["SaEdHotComforts"] . "\t Test: \"" . "\"" . "\n", 3, $errorpath);
//$_GET["End_Date"] = DateTime::createFromFormat('d F, Y', $_GET["End_Date"])->format('Y-m-d') . " 23:59:59";
for ($i = 0; $i < count($formGetNames); $i++) {
    $formValues[] = $_GET[$formGetNames[$i]];
}
//error_log("Date: " . $_GET["End_Date"] . "\t Test: \"" . "\"" . "\n", 3, $errorpath);
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
    //error_log("Statement: " . $statement . "\"" . "\n", 3, $errorpath);
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