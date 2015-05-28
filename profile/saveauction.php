<?php

// <editor-fold defaultstate="collapsed" desc="Requires">
require '../admin/configuration.php';
session_start();
// </editor-fold>

$con = db_connect();
if (isset($_POST["End_Date"])) {
    $_POST["End_Date"] = str_replace(',', '', $_POST["End_Date"]);
    $vardate = date('Y-m-d H:i:s', strtotime($_POST["End_Date"]));
}

if (strcmp($_POST["SaAuDeAction"], "edit") == 0) {
    $query = "UPDATE auction SET Name=?, Description=?, Bid_Price=?, Buy_Price=?, PeopleCount=?, End_Date=?, Closed=? WHERE ID=?";
    $sql = $con->prepare($query);
    $sql->bind_param('ssiiisii', $_POST["AuctionName"], $_POST["Description"], $_POST["Bid_Price"], $_POST["Buy_Price"],
        $_POST["PeopleCount"], $vardate, $_POST["Closed"], $_POST["AuctionID"]);
} else if (strcmp($_POST["SaAuDeAction"], "new") == 0) {
    $query = "INSERT INTO auction(Name, Description, Bid_Price, Buy_Price, PeopleCount, End_Date, Hotel) VALUES (?,?,?,?,?,?,?)";
    $sql = $con->prepare($query);
    $sql->bind_param('ssiiisi', $_POST["AuctionName"], $_POST["Description"], $_POST["Bid_Price"], $_POST["Buy_Price"],
        $_POST["PeopleCount"], $vardate, $_POST["CrAuHotelID"]);
}

if (!$sql->execute()) {
    echo '{"success":"no","message":"ελέξτε όλα τα στοιχεία ότι είναι σωστά!"}';
} else {
    if (!isset($_POST["AuctionID"])) {
        $query = "Select LAST_INSERT_ID() as id";
        $sql = $con->prepare($query);
        $sql->execute();
        $result = $sql->get_result();
        $id = mysqli_fetch_array($result)['id'];
    } else {
        $id = $_POST["AuctionID"];
    }

    $eventName = $_POST["AuctionName"] . $id;
    //$mysqlDate = date('Y-m-d H:i:s', strtotime($_POST["End_Date"]));

    $query = "DROP EVENT IF EXISTS " . $eventName . "; CREATE EVENT " . $eventName . " ON SCHEDULE AT '" . $vardate . "' DO UPDATE Auction SET Closed = 1 WHERE ID=" . $id;

    if ($con->multi_query($query) === FALSE) {
        die('{"success":"no","message":"Η λήξη της αγγελίας επέτυχε ' . $con->error . '"}');
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
                    $image_str = $image_str . str_replace("../", "", $target_path) . ";";
                } else {//if file was not moved.
                    die('{"success":"no","message":" please try again to upload image!"}');
                }
            } else {//if file size and file type was incorrect.
                die('{"success":"no","message":" Invalid file Size or Type!"}');
            }
        }

        $query = " UPDATE Auction SET Images=? WHERE ID=? ;";
        $con = db_connect(); ///Προσοχή χρειάζετε διότι η σύνδεση έκλεινε. Fuck my life and the fucking SQL bullshit!!!!!
        $sql = $con->prepare($query);
        $sql->bind_param("ss", $image_str, $id);

        if (!$sql->execute()) {
            die('{"success":"no","message":"Η ενημέρωση της εικόνας απέτυχε!"}');
        }

    }
    // </editor-fold>

    echo '{"success":"yes"}';
}
