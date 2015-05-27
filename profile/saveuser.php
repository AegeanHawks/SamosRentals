<?php

include "../admin/configuration.php";
session_start();

$con = db_connect();

if (strcmp($_POST["SaUsState"], "edit") == 0) {
    $query = "UPDATE user SET FirstName=?, Lastname=?, Tel=?, Mail=?, Sex=? WHERE Username=?";
    $sql = $con->prepare($query);
    $sql->bind_param('ssssss', $_POST["SaUsFirstName"], $_POST["SaUsLastname"], $_POST["SaUsTel"], $_POST["SaUsMail"], $_POST["SaUsSex"], $_SESSION['userid']);
    $sql->execute();
    unset($sql);

    if (!empty($_POST["SaUsPassword"])) {
        $query = "UPDATE user SET Password=? WHERE Username=?";
        $sql = $con->prepare($query);
        $sql->bind_param('ss', $_POST["SaUsPassword"], $_SESSION['userid']);
        $sql->execute();
    }
    if (!empty($_POST["SaUsBirthday"])) {
        $query = "UPDATE user SET Birthday=? WHERE Username=?";
        $sql = $con->prepare($query);
        $sql->bind_param('ss', $_POST["SaUsBirthday"], $_SESSION['userid']);
        $sql->execute();
    }

    echo '{"success":"yes"}';
    // </editor-fold>
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
        $query = "UPDATE user SET Birthday=? WHERE Username=?";
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

// <editor-fold defaultstate="collapsed" desc="Upload Image">
$image_str = "";
$j = 0; //Variable for indexing uploaded image
$target_path = "../images/"; //Declaring Path for uploaded images

if (isset($_FILES['fileToUpload']['name'])) {

    for ($i = 0; $i < count($_FILES['fileToUpload']['name']); $i++) {//loop to get individual element from the array
        $validextensions = array("jpeg", "jpg", "png");  //Extensions which are allowed
        $ext = explode('.', basename($_FILES['fileToUpload']['name']));//explode file name from dot(.)  !!!warning [$i]
        $file_extension = end($ext); //store extensions in the variable

        $target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext) - 1];//set the target path with a new name of image
        $j = $j + 1;//increment the number of uploaded images according to the files in array

        if (($_FILES["fileToUpload"]["size"][$i] < 1000000) //Approx. 1000kb files can be uploaded.
            && in_array($file_extension, $validextensions)
        ) {
            if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_path)) {//if file moved to uploads folder
                $image_str = $image_str . str_replace("../", "", $target_path);
            } else {//if file was not moved.
                die('{"success":"no","message":" please try again to upload image!"}');
            }
        } else {//if file size and file type was incorrect.
            die('{"success":"no","message":" Invalid file Size or Type!"}');
        }
    }

    if (strcmp($_POST["SaUsState"], "edit") == 0) {
        $query = "UPDATE user SET Image=? WHERE Username=?";
        $sql = $con->prepare($query);
        $sql->bind_param('ss', $image_str, $_SESSION['userid']);
        $sql->execute();
    }
    if (strcmp($_POST["SaUsState"], "adminedit") == 0 || strcmp($_POST["SaUsState"], "new") == 0) {
        $query = "UPDATE user SET Image=? WHERE Username=?";
        $sql = $con->prepare($query);
        $sql->bind_param('ss', $image_str, $_POST['SaUsUsername']);
        $sql->execute();
    }

}