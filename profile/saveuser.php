<?php
// Report all PHP errors (see changelog)
error_reporting(E_ALL);

// <editor-fold defaultstate="collapsed" desc="Requires">
require '../admin/configuration.php';
session_start();
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Variables' declare">
$table = "user";
$dbColumns = array("FirstName", "Lastname", "Tel", "Password", "Mail", "Sex");
$formGetNames = array("SaUsFirstName", "SaUsLastname", "SaUsTel", "SaUsPassword", "SaUsMail", "SaUsSex");
if (!empty($_GET["SaUsBirthday"])) {
    array_push($dbColumns, "Birthday");
    array_push($formGetNames, "SaUsBirthday");
}
if ($_SESSION['role'] == 0) {
    array_push($dbColumns, "Role");
    array_push($formGetNames, "SaUsRole");

    if (strcmp($_GET["SaUsState"], "new") == 0 || strcmp($_GET["SaUsState"], "adminedit") == 0) {
        array_push($dbColumns, "Username");
        array_push($formGetNames, "SaUsUsername");
    }
}

// <editor-fold defaultstate="collapsed" desc="Personal data edit">
// </editor-fold>

$formValues = array();

for ($i = 0; $i < count($formGetNames); $i++) {
    $formValues[] = addslashes($_GET[$formGetNames[$i]]);
}

// </editor-fold>

if (strcmp($_GET["SaUsState"], "edit") == 0) {
    $con = db_connect();

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
        echo("Could not run query: \"" . $statement . "\"" . "\n");
        echo("Error: \"" . mysqli_error($con) . "\"" . "\n");
        echo '{"success":"no"}';
    } else {
        echo '{"success":"yes"}';
    }
    // </editor-fold>
    mysqli_close($con);
} else if (strcmp($_GET["SaUsState"], "adminedit") == 0) {
    $con = db_connect();

    // <editor-fold defaultstate="collapsed" desc="Construct insert statement">
    $updateColumns = "";
    for ($j = 0; $j < count($dbColumns) - 1; $j++) {

        $updateColumns = $updateColumns . $dbColumns[$j] . "='" . $formValues[$j] . "',";
    }

    $updateColumns = $updateColumns . $dbColumns[count($dbColumns) - 1] . "='" . $formValues[count($dbColumns) - 1] . "'";

    $statement = "UPDATE " . $table . " SET " . $updateColumns . " WHERE Username='" . $_GET['SaUsUsername'] . "'";

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="Run query">
    $result = mysqli_query($con, $statement);
    if ($result == NULL) {
        //error_reporting("Could not run query: \"" . $statement . "\"" . "\n");
        //error_reporting("Error: \"" . mysqli_error($con) . "\"" . "\n");
        echo '{"success":"no"}';
    } else {
        echo '{"success":"yes"}';
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
        //error_reporting("Could not run query: \"" . $statement . "\"" . "\n");
        //error_reporting("Error: \"" . mysqli_error($con) . "\"" . "\n");
        echo '{"success":"no"}';
    } else {
        echo '{"success":"yes"}';
    }
    // </editor-fold>
    mysqli_close($con);
}
?>