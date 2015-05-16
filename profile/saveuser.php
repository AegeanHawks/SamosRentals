<?php

// <editor-fold defaultstate="collapsed" desc="Requires">
require '../admin/configuration.php';
session_start();
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Variables' declare">
$table = "user";
$dbColumns = array("FirstName", "Lastname", "Tel", "Password", "Mail", "Birthday", "Sex");
$formGetNames = array("SaUsFirstName", "SaUsLastname", "SaUsTel", "SaUsPassword", "SaUsMail", "SaUsBirthday", "SaUsSex");
if ($_SESSION['role'] == 0) {
    array_push($dbColumns, "Role");
    array_push($formGetNames, "SaUsRole");

    if (strcmp($_GET["SaUsState"], "new") == 0) {
        array_push($dbColumns, "Username");
        array_push($formGetNames, "SaUsUsername");
    }
}

// <editor-fold defaultstate="collapsed" desc="Personal data edit">
// </editor-fold>

$formValues = array();

//error_log("Con: " . $_GET["SaEdHotComforts"] . "\t Test: \"" . "\"" . "\n", 3, $errorpath);
//$_GET["SaUsBirthday"] = DateTime::createFromFormat('d F, Y', $_GET["SaUsBirthday"])->format('Y-m-d');
for ($i = 0; $i < count($formGetNames); $i++) {
    $formValues[] = $_GET[$formGetNames[$i]];
}
//error_log("Date: " . $_GET["End_Date"] . "\t Test: \"" . "\"" . "\n", 3, $errorpath);
// </editor-fold>

if (strcmp($_GET["SaUsState"], "edit") == 0) {
    // <editor-fold defaultstate="collapsed" desc="Connect to database">
    $con = db_connect();
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="Construct insert statement">
    $updateColumns = "";
    for ($j = 0; $j < count($dbColumns) - 1; $j++) {

        $updateColumns = $updateColumns . $dbColumns[$j] . "='" . $formValues[$j] . "',";
    }

    $updateColumns = $updateColumns . $dbColumns[count($dbColumns) - 1] . "='" . $formValues[count($dbColumns) - 1] . "'";

    $statement = "UPDATE " . $table . " SET " . $updateColumns . " WHERE Username='" . $_SESSION['userid']."'";
    
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="Run query">
    $result = mysqli_query($con, $statement);
    if ($result == NULL) {
        error_log("Could not run query: \"" . $statement . "\"" . "\n", 3, $errorpath);
        error_log("Error: \"" . mysqli_error($con) . "\"" . "\n", 3, $errorpath);
        echo "0";
    } else {
        echo "1";
    }
    // </editor-fold>
    mysqli_close($con);
} else if (strcmp($_GET["SaUsState"], "new") == 0) {

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
        error_log("Error: \"" . mysqli_error($con) . "\"" . "\n", 3, $errorpath);
        echo "0";
    } else {
        echo "1";
    }
    // </editor-fold>
    mysqli_close($con);
}
?>