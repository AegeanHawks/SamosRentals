<?php

// <editor-fold defaultstate="collapsed" desc="Requires">
require '../admin/configuration.php';
session_start();
// </editor-fold>

$con = db_connect();

if (strcmp($_POST["SaEdHotAction"], "edit") == 0) {
    $query = "UPDATE hotel SET Name=?, Coordinates=?, Description=?, Comforts=?, Image=?, Tel=?, Manager=? WHERE ID=?";
    $sql = $con->prepare($query);

    if (!isRole("admin")) {
        $_POST["SaEdHotChooseHotelier"] = $_SESSION['userid'];
    }
    $sql->bind_param('sssssssi', $_POST["SaEdHotName"], $_POST["SaEdHotCoordinates"], $_POST["SaEdHotDescription"], $_POST["SaEdHotComforts"], $_POST["SaEdHotImage"], $_POST['SaEdHotTel'], $_POST['SaEdHotChooseHotelier'], $_POST['SaEdHotID']);

    if (!$sql->execute()) {
        echo '{"success":"no"}';
        return;
    } else {
        echo '{"success":"yes"}';
        return;
    }

} else if (strcmp($_POST["SaEdHotAction"], "new") == 0) {
    $query = "INSERT INTO hotel(Name, Coordinates, Description, Comforts, Image, Tel, Manager) VALUES(?,?,?,?,?,?,?)";
    $sql = $con->prepare($query);

    if (!isRole("admin")) {
        $_POST["SaEdHotChooseHotelier"] = $_SESSION['userid'];
    }
    $sql->bind_param('sssssss', $_POST["SaEdHotName"], $_POST["SaEdHotCoordinates"], $_POST["SaEdHotDescription"], $_POST["SaEdHotComforts"], $_POST["SaEdHotImage"], $_POST['SaEdHotTel'], $_POST['SaEdHotChooseHotelier']);

    if (!$sql->execute()) {
        echo '{"success":"no"}';
        return;
    } else {
        echo '{"success":"yes"}';
        return;
    }
}

echo '{"success":"no"}';
