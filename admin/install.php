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
$sql = "CREATE DATABASE " . $DB_NAME . " COLLATE utf8_general_ci;";;
if ($conn->query($sql) === TRUE) {
    Print_MSG("Η βάση " . $DB_NAME . " δημιουργήθηκε επιτυχώς!<br>");
} else {
    die("Πρόβλημα κατά την δημιουργία της βάσης: " . $conn->error . "<br>");
}

//Select Database
$db = mysqli_select_db($conn, $DB_NAME);

// Create Tables
$sql = "
SET CHARACTER SET 'utf8';
SET NAMES 'utf8';
CREATE TABLE User (
  Username  VARCHAR(255) UNIQUE,
  Password  VARCHAR(30)  NOT NULL,
  LastName  VARCHAR(30)  NOT NULL,
  FirstName VARCHAR(30)  NOT NULL,
  Sex       VARCHAR(20)  NOT NULL,
  Tel       VARCHAR(20),
  Mail      VARCHAR(255) NOT NULL UNIQUE,
  Birthday  VARCHAR(255),
  Image     TEXT,
  Role      INT          NOT NULL,
  PRIMARY KEY (Username)
);

CREATE TABLE Hotel (
  ID          INT UNIQUE AUTO_INCREMENT,
  Name        VARCHAR(255) NOT NULL,
  Tel         VARCHAR(255) NOT NULL,
  Description VARCHAR(255) NOT NULL,
  Coordinates VARCHAR(255) NOT NULL,
  Grade       INT          NOT NULL,
  Manager     VARCHAR(255),
  PRIMARY KEY (ID),
  FOREIGN KEY (Manager) REFERENCES User (Username)
);

CREATE TABLE Auction (
  ID          INT UNIQUE AUTO_INCREMENT,
  Name        VARCHAR(255) NOT NULL,
  Description VARCHAR(255) NOT NULL,
  Status      INT          NOT NULL,
  Bid_Price   INT          NOT NULL,
  End_Price   INT          NOT NULL,
  Hotel       INT,
  PRIMARY KEY (ID),
  FOREIGN KEY (Hotel) REFERENCES Hotel (ID)
);
INSERT INTO User (username, Password, FirstName, LastName, sex, mail, Role, Birthday, Image)
VALUE ('rambou', 'admin', 'Νικόλαος', 'Μπούσιος', 'male', 'rambou@samosrentals.gr', 0, '9 September,1992','https://avatars2.githubusercontent.com/u/4427553?v=3&s=460');
INSERT INTO User (username, Password, FirstName, LastName, sex, mail, Role, Birthday, Image)
VALUE ('armageddonas', 'admin', 'Κωνσταντίνος', 'Χασιώτης', 'male', 'armageddonas@samosrentals.gr', 0, '9 September,1992','images/website/avatar.jpg');
";

if ($conn->multi_query($sql) === TRUE) {
    Print_MSG("Οι πίνακες δημιουργήθηκαν επιτυχώς!");
} else {
    Print_MSG("Πρόβλημα κατά την δημιουργία πινάκων: " . $conn->error);
    mysqli_query($conn, "DROP DATABASE " . $DB_NAME . ";");
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