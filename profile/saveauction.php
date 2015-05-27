<?php

// <editor-fold defaultstate="collapsed" desc="Requires">
require '../admin/configuration.php';
session_start();
// </editor-fold>


// <editor-fold defaultstate="collapsed" desc="Use later">
$image_string_to_database_save;
if (isset($_POST['submit'])) {
    $j = 0; //Variable for indexing uploaded image

    $target_path = "images/"; //Declaring Path for uploaded images
    for ($i = 0; $i < count($_FILES['fileToUpload']['name']); $i++) {//loop to get individual element from the array

        $validextensions = array("jpeg", "jpg", "png");  //Extensions which are allowed
        $ext = explode('.', basename($_FILES['file']['name'][$i]));//explode file name from dot(.)
        $file_extension = end($ext); //store extensions in the variable

        $target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext) - 1];//set the target path with a new name of image
        $j = $j + 1;//increment the number of uploaded images according to the files in array

        if (($_FILES["file"]["size"][$i] < 1000000) //Approx. 100kb files can be uploaded.
            && in_array($file_extension, $validextensions)
        ) {
            if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path)) {//if file moved to uploads folder
                echo $j . ').<span id="noerror">Image uploaded successfully!.</span><br/><br/>';
                $image_string_to_database_save += $target_path . ";";
            } else {//if file was not moved.
                echo $j . ').<span id="error">please try again!.</span><br/><br/>';
            }
        } else {//if file size and file type was incorrect.
            echo $j . ').<span id="error">***Invalid file Size or Type***</span><br/><br/>';
        }
    }
}
// </editor-fold>


$con = db_connect();

if (strcmp($_POST["SaAuDeAction"], "edit") == 0) {
    $query = "UPDATE auction SET Name=?, Description=?, Bid_Price=?, Buy_Price=?, PeopleCount=?, End_Date=?, Images=?, Closed=? WHERE ID=?";
    $sql = $con->prepare($query);
    $sql->bind_param('ssiiisbii', $_POST["AuctionName"], $_POST["Description"], $_POST["Bid_Price"], $_POST["Buy_Price"],
        $_POST["PeopleCount"], $_POST["End_Date"], $_POST["Images"], $_POST["Closed"], $_POST["AuctionID"]);
    $sql->execute();

    //$statement = "UPDATE " . $table . " SET " . $updateColumns . " WHERE ID=" . $_GET["AuctionID"];

} else if (strcmp($_POST["SaAuDeAction"], "new") == 0) {
    $query = "INSERT INTO auction(Name, Description, Bid_Price, Buy_Price, PeopleCount, End_Date, Images, Hotel) VALUES (?,?,?,?,?,?,?,?)";
    $sql = $con->prepare($query);
    $sql->bind_param('ssiiisbi', $_POST["AuctionName"], $_POST["Description"], $_POST["Bid_Price"], $_POST["Buy_Price"],
        $_POST["PeopleCount"], $_POST["End_Date"], $_POST["Images"], $_POST["CrAuHotelID"]);
    $sql->execute();

    //$statement = "INSERT INTO " . $table . "(" . $insertColumns . ")" . " VALUES( " . $insertValues . ")";
}
echo '{"success":"yes"}';
?>
