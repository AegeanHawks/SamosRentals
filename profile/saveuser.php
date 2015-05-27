<?php

include "../admin/configuration.php";
session_start();

$con = db_connect();

if (strcmp($_POST["SaUsState"], "edit") == 0) {
    $query = "UPDATE user SET FirstName=?, Lastname=?, Tel=?, Mail=?, Sex=? WHERE Username=?";
    $sql = $con->prepare($query);
    $sql->bind_param('ssssss', $_POST["SaUsFirstName"], $_POST["SaUsLastname"], $_POST["SaUsTel"], $_POST["SaUsMail"], $_POST["SaUsSex"], $_SESSION['userid']);
    $sql->execute();

    if (!empty($_POST["SaUsPassword"])) {
        $query = "UPDATE user SET Password=? WHERE Username=?";
        $sql = $con->prepare($query);
        $sql->bind_param('ss', $_POST["SaUsPassword"], $_SESSION['userid']);
        $sql->execute();
    }
    if (!empty($_POST["SaUsBirthday"])) {
        $query = "UPDATE user SET SaUsPassword=? WHERE Username=?";
        $sql = $con->prepare($query);
        $sql->bind_param('ss', $_POST["SaUsBirthday"], $_SESSION['userid']);
        $sql->execute();

        echo '{"success":"yes"}';
    }

} else if (strcmp($_POST["SaUsState"], "adminedit") == 0) {
    $query = "UPDATE user SET FirstName=?, Lastname=?, Tel=?, Mail=?, Sex=?, Role=? WHERE Username=?";
    $sql = $con->prepare($query);
    $sql->bind_param('sssssis', $_POST["SaUsFirstName"], $_POST["SaUsLastname"], $_POST["SaUsTel"], $_POST["SaUsMail"], $_POST["SaUsSex"], $_POST['SaUsRole'], $_POST['SaUsUsername']);
    $sql->execute();

    if (!empty($_POST["SaUsPassword"])) {
        $query = "UPDATE user SET Password=? WHERE Username=?";
        $sql = $con->prepare($query);
        $sql->bind_param('ss', $_POST["SaUsPassword"], $_POST['SaUsUsername']);
        $sql->execute();
    }
    if (!empty($_POST["SaUsBirthday"])) {
        $query = "UPDATE user SET SaUsPassword=? WHERE Username=?";
        $sql = $con->prepare($query);
        $sql->bind_param('ss', $_POST["SaUsBirthday"], $_POST['SaUsUsername']);
        $sql->execute();
    }

    echo '{"success":"yes"}';

} else if (strcmp($_POST["SaUsState"], "new") == 0) {
    $query = "INSERT INTO user(FirstName, Lastname, Tel, Mail, Sex, Password, Birthday, Username) VALUES(?,?,?,?,?,?,?,?)";
    $sql = $con->prepare($query);
    $sql->bind_param('ssssssss', $_POST["SaUsFirstName"], $_POST["SaUsLastname"], $_POST["SaUsTel"], $_POST["SaUsMail"], $_POST["SaUsSex"], $_POST["SaUsPassword"], $_POST["SaUsBirthday"], $_POST["SaUsUsername"]);
    if (!$sql->execute()) {
        echo '{"success":"no"}';
    } else {
        echo '{"success":"yes"}';
    }

}