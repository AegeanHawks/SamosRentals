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
} else if (strcmp($_POST["SaEdHotAction"], "new") == 0) {
    $query = "INSERT INTO hotel(Name, Coordinates, Description, Comforts, Image, Tel, Manager) VALUES(?,?,?,?,?,?,?)";
    $sql = $con->prepare($query);

    if (!isRole("admin")) {
        $_POST["SaEdHotChooseHotelier"] = $_SESSION['userid'];
    }
    $sql->bind_param('sssssss', $_POST["SaEdHotName"], $_POST["SaEdHotCoordinates"], $_POST["SaEdHotDescription"], $_POST["SaEdHotComforts"], $_POST["SaEdHotImage"], $_POST['SaEdHotTel'], $_POST['SaEdHotChooseHotelier']);
} else {
    die('{"success":"no","message":"intruder!"}');
}

if (!$sql->execute()) {
    echo '{"success":"no","message":"ελέξτε όλα τα στοιχεία ότι είναι σωστά!"}';
} else {
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
                    $image_str = $image_str . str_replace("../", "", $target_path) . ";";
                } else {//if file was not moved.
                    die('{"success":"no","message":" please try again to upload image!"}');
                }
            } else {//if file size and file type was incorrect.
                die('{"success":"no","message":" Invalid file Size or Type!"}');
            }
        }

        if (isset($_POST['SaEdHotID'])) {
            $query = "UPDATE Hotel SET Image=? WHERE ID=?";
            $sql = $con->prepare($query);
            $sql->bind_param('si', $image_str, $_POST['SaEdHotID']);
            $sql->execute();
        } else {
            $query = "UPDATE Hotel SET Image=? WHERE ID=LAST_INSERT_ID()";
            $sql = $con->prepare($query);
            $sql->bind_param('s', $image_str);
            $sql->execute();
        }

    }
    // </editor-fold>

    echo '{"success":"yes"}';
}


