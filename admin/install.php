<!DOCTYPE html>
<html>
<head lang="en">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title>Installer</title>
    <link rel="icon" type="image/png" href="../images/website/favicon.ico"/>

    <!-- CSS  -->
    <link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="../css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>

    <!--  Scripts-->
    <script src="../js/jquery-2.1.1.min.js"></script>
    <script src="../js/materialize.js"></script>
    <script src="../js/init.js"></script>
</head>
<body class="white">

<?php
/**
 * Created by PhpStorm.
 * User: Nickos
 * Date: 2/5/2015
 * Time: 12:16 πμ
 */
include 'configuration.php';

// Create connection
$conn = new mysqli($SERVER, $DB_USERNAME, $DB_PASSWORD);

// Check connection
Print_MSG('Σύνδεση στην βάση...');
if ($conn->connect_error) {
    die("Αποτυχία σύνδεσης: " . $conn->connect_error);
}
Print_MSG("Επιτυχής σύνδεση στην βάση!");

// Create database
$sql = "CREATE DATABASE " . $DB_NAME;
if ($conn->query($sql) === TRUE) {
    Print_MSG("Η βάση " . $DB_NAME . " δημιουργήθηκε επιτυχώς!<br>");
} else {
    die("Πρόβλημα κατά την δημιουργία της βάσης: " . $conn->error . "<br>");
}

//Select Database
$sql = "USE " . $DB_NAME . ";";
if ($conn->query($sql) === FALSE) {
    die("Πρόβλημα κατά την επιλογή της βάσης: " . $conn->error . "<br>");
}

// Create Tables
$sql = "
CREATE TABLE User(
  Username varchar(255) UNIQUE,
  Password  varchar(30) NOT NULL,
  LastName varchar(30) NOT NULL,
  FirstName varchar(30) NOT NULL,
  Sex varchar(20) NOT NULL,
  Mail varchar(255) NOT NULL UNIQUE,
  Birthday date,
  Role int NOT NULL,
  PRIMARY KEY (Username)
);
CREATE TABLE Hotel(
  ID int AUTO_INCREMENT,
  Title varchar(255) NOT NULL,
  Tel varchar(255) NOT NULL,
  Description varchar(255) NOT NULL,
  Coordinates varchar(255) NOT NULL,
  Grade int NOT NULL,
  Manager varchar(255),
  PRIMARY KEY (ID),
  FOREIGN KEY (Manager) REFERENCES User(Username)
);
CREATE TABLE Auction(
  ID int AUTO_INCREMENT,
  Title varchar(255) NOT NULL,
  Description varchar(255) NOT NULL,
  Status int NOT NULL,
  Bid_Price int NOT NULL,
  End_Price int NOT NULL,
  Hotel int,
  PRIMARY KEY (ID),
  FOREIGN KEY (Hotel) REFERENCES Hotel(ID)
);
";

if ($conn->multi_query($sql) === TRUE) {
    Print_MSG("Οι πίνακες δημιουργήθηκαν επιτυχώς!");
} else {
    $conn->query("DROP DATABASE " . $DB_NAME . ";");
    Print_MSG("Πρόβλημα κατά την δημιουργία πινάκων: " . $conn->error);
}

//Close Connection
$conn->close();
Print_MSG("Η σύνδεση με την βάση έκλεισε.");

function Print_MSG($msq)
{
    echo '<span class="flow-text">';
    echo $msq;
    echo '<br>';
    echo '</span>';
}

?>

</body>
</html>