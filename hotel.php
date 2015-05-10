<?php
include 'admin/configuration.php';
session_start();

//Check if logged
$logged = false;
if (islogged()) {
    $logged = true;
}

//Connect
$con = db_connect();
if ($con->connect_errno) {
    return;
}

// SQL query to fetch information of hotel.
$sql = $con->prepare('SELECT * FROM Hotel WHERE ID= ?');
$sql->bind_param('s', $_GET['id']);
$sql->execute();

$result = $sql->get_result();
$num_row = mysqli_num_rows($result);
if ($num_row == 1) {
    //Fetch all hotel's information
    $row = mysqli_fetch_array($result);

    $Name = $row['Name'];
    $Comforts = $row['Comforts'];
    $Tel = $row['Tel'];
    $Description = $row['Description'];
    $Coordinates = $row['Coordinates'];
    $Grade = $row['Grade'];
    $Manager = $row['Manager'];
    //$website = $row['Website'];
    $Image = $row['Image'];

    // SQL query to fetch information of Manager.
    $sql = $con->prepare('SELECT LastName,FirstName,Image FROM User WHERE Username= ?');
    $sql->bind_param('s', $Manager);
    $sql->execute();
    $result = $sql->get_result();
    $num_row = mysqli_num_rows($result);
    if ($num_row == 1) {
        //Fetch user's information
        $row = mysqli_fetch_array($result);
        $lname = $row['LastName'];
        $fname = $row['FirstName'];
        $m_image = $row['Image'];
    }
} else {
    //Returns error that page not found
    die(include '404.php');
}
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <?php
    $Page_Title = "Ξενοδοχείο - " . $Name;
    include 'head.php';
    ?>
    <!--CSS-->
    <link href="css/star-rating.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!--Scripts-->
    <script src="js/star-rating.min.js"></script>

    <style>
        .video-container {
            position: relative;
            overflow: hidden;
        }

        iframe {
            position: absolute;
        }
    </style>
</head>
<body class="white">

<?php
include 'header.php';
?>

<div class="parallax-container" style="height: 600px">
    <div class="parallax"><img src="images/hotel1.jpg"></div>
</div>

<div class="row container">

    <!--Title and Description-->
    <div class="section no-pad-bot" style="margin-top: -5%;">
        <div class="row">
            <div class="col offset-l2 l8 s12 white z-depth-3">
                <div class="col l12 m8 s12">
                    <h4 class="grey-text darken-2 light center"><?php echo $Name; ?></h4>

                    <p class="grey-text darken-3"><?php echo $Description; ?></p>
                </div>
            </div>
        </div>
    </div>
    <!--Title and Description-->

    <!--Information-->
    <div class="card row" style="padding: 10px;margin-top: 40px;margin-bottom: 40px;">
        <ul class="z-depth-1 col s12 l6 collection">
            <li class="collection-item avatar">
                <img
                    src="<?php echo $m_image; ?>"
                    class="valign circle left">
                <span class="title truncate">Μάνατζερ Ξενοδοχείου</span>

                <p>
                    <a href="profile.php?user=<?php echo $Manager; ?>"><?php echo $lname . ' ' . $fname; ?></a>
                </p>
            </li>

            <li class="collection-item avatar">
                <i class="mdi-action-wallet-giftcard circle orange"></i>
                <span class="title truncate">Ανέσεις</span>

                <p>
                    <?php echo $Comforts; ?>
                </p>
            </li>

            <!--<li class="collection-item avatar">
                <i class="mdi-communication-messenger circle orange"></i>
                <span class="title truncate">Σελίδα ξενοδοχείου</span>

                <p><a href="<?php echo $website; ?>">
                        Ιστότοπος
                    </a>
                </p>
            </li>-->

            <li class="collection-item avatar">
                <i class="mdi-communication-phone circle green"></i>
                <span class="title">Τηλέφωνο επικοινωνίας</span>

                <p>
                    <?php echo $Tel; ?>
                </p>
            </li>
            <li class="collection-item avatar">
                <i class="mdi-action-trending-up circle blue"></i>
                <span class="title">Βαθμολογία ξενοδοχείου: <?php echo round($Grade, 1); ?></span><br>

                <input id="input-id" type="number" class="rating" value="<?php echo $Grade; ?>" max="5"
                       readonly="true" data-size="xs">
            </li>
        </ul>
        <!--Google Map-->
        <div class="col s12 l6">
            <div class="z-depth-1 video-container">
                <iframe
                    frameborder="0"
                    src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCd_JYBOj9Se48naYvNkIRAITiAwteJzbU&q=<?php echo $Coordinates; ?>">
                </iframe>
            </div>
        </div>
        <!--Google Map-->

        <!--SlideShow Images-->
        <div class="slider col s12" style="margin-top: 15px;">
            <ul class="slides ">
                <?php
                //Explode Image to get all images
                $Images = explode(";", $Image);
                foreach ($Images as $img) {
                    ?>
                    <li>
                        <img
                            src="<?php echo $img; ?>">
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>
        <!--SlideShow Images-->
    </div>
    <!--Information-->

    <!--All Auctions-->
    <div class="card row">
        <div class="col s12" id="section_2">
            <div class=" white col s12 " style="padding-top: 15px;padding-bottom: 15px; font-weight: bold">
                <div class="col s12 m3">Τίτλος</div>
                <div class="col s12 m3">Υψηλότερη Πλειοδοσία</div>
                <div class="col s12 m4">Τιμή Αγοράς</div>
                <div class="col s12 m2">Ενεργά</div>
            </div>
            <?php
            // SQL query to fetch information all auctions of a hotel.
            $sql = $con->prepare('SELECT ID,Name,Closed,Bid_Price,End_Price FROM Auction WHERE Hotel= ?');
            $sql->bind_param('s', $_GET['id']);
            $sql->execute();

            $result = $sql->get_result();
            while ($row = mysqli_fetch_array($result)) {
                $ID = $row['ID'];
                $Name = $row['Name'];
                $Closed = $row['Closed'];
                $Bid_Price = $row['Bid_Price'];
                $End_Price = $row['End_Price'];
                ?>
                <li class="divider col s12"></li>
                <div class="white col s12" style="padding-top: 10px;padding-bottom: 10px;">
                    <a class="col s12 m3 truncate" href="auction.php?id=<?php echo $ID; ?>"><i
                            class="mdi-action-home"></i> <?php echo $Name; ?></a>

                    <div class="col s12 m3 flow-text"><i class="mdi-editor-attach-money"> </i><?php echo $Bid_Price; ?>
                    </div>
                    <div class="col s12 m4 flow-text"><i class="mdi-editor-attach-money"> </i><?php echo $End_Price; ?>
                    </div>
                    <div class="col s12 m2 flow-text">
                        <div class="btn-floating disabled green"><i class="<?php if ($Closed) {
                                echo 'mdi-av-stop red';
                            } else {
                                echo 'mdi-av-play-circle-outline';
                            } ?>"></i></div>
                    </div>
                    <div class="divider"></div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <!--All Auctions-->

</div>

<?php
include 'footer.php';
?>
</body>
</html>