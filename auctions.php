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

//Get number of all Auctions in database
$sql = $con->prepare('SELECT COUNT(id) AS allAuction FROM Auction');
$sql->execute();
$result = $sql->get_result();
$row = mysqli_fetch_array($result);
$AllAuction = $row['allAuction'];

//We check for next page request
$page = 1;
if (isset($_GET['page'])) {
    $page = htmlspecialchars($_GET['page']);
}

if (isset($_GET['search'])) {
    // SQL query to fetch information of hotel.
    $search = '%' . str_replace(" ", "%", $_GET['search']) . '%';
    $sql = $con->prepare('SELECT Auction.ID,Auction.Name,Auction.Description,Auction.Closed,Auction.Bid_Price,Auction.Buy_Price,Auction.Hotel,Auction.Images, DATE_FORMAT(Auction.End_Date,\'%M %e, %Y %h:%i:%S\') AS End_Date, Hotel.Name AS HotelName, Hotel.Image AS HotelImage FROM Auction,Hotel WHERE Hotel.ID = Auction.Hotel AND (Auction.Name LIKE ? OR Auction.Description LIKE ?) ORDER BY Auction.id'); //SELECT * FROM Auction
    $sql->bind_param('ss', $search, $search);
    $sql->execute();
    //Calculate pages
    $pages = ceil(mysqli_num_rows($result) / 6);
} else {
    // SQL query to fetch information of hotel.
    $sql = $con->prepare('SELECT Auction.ID,Auction.Name,Auction.Description,Auction.Closed,Auction.Bid_Price,Auction.Buy_Price,Auction.Hotel,Auction.Images, DATE_FORMAT(Auction.End_Date,\'%M %e, %Y %h:%i:%S\') AS End_Date, Hotel.Name AS HotelName, Hotel.Image AS HotelImage FROM Auction,Hotel WHERE Hotel.ID = Auction.Hotel ORDER BY Auction.id DESC LIMIT ? , ?'); //SELECT * FROM Auction
    $id = ($page - 1) * 6;
    $quantity = 6;
    $sql->bind_param('ii', $id, $quantity);
    $sql->execute();
    //Calculate how many page do we need
    $pages = ceil($AllAuction / 6);
}

$result = $sql->get_result();
if (mysqli_num_rows($result) == 0) {
    die(include '404.php');
}

if ($page > $pages || $page < 1) {
    //Returns error that page not found
    die(include '404.php');
}

?>

<!DOCTYPE html>
<html>
<head lang="en">
    <?php
    $Page_Title = "Δημοπρασίες";
    include 'head.php';
    ?>
    <!--Scripts-->
    <script src="js/Masonry.js"></script>
    <script type="text/javascript" src="js/jquery.countdown.min.js"></script>
    <script>
        function flip(id) {
            var cont = document.getElementById(id).className;
            if (cont.indexOf('flipInY') != -1) {
                $('#' + id).removeClass('flipInY');
            } else {
                $('#' + id).addClass('animated flipInY');
                setTimeout(function () {
                    $('#' + id).removeClass('flipInY');
                }, 1000);
            }
        }
        function rotate(id) {
            var cont = document.getElementById(id).className;
            if (cont.indexOf('rotateIn') != -1) {
                $('#' + id).removeClass('rotateIn');
            } else {
                $('#' + id).addClass('animated rotateIn');
                setTimeout(function () {
                    $('#' + id).removeClass('rotateIn');
                }, 1000);
            }
        }
        function SetTimer(id, EndDate) {
            $('#Auction_Time' + id).countdown({
                date: EndDate,
                render: function (data) {
                    $(this.el).html("<div>" +
                    this.leadingZeros(data.days, 3) + " " +
                    "<span>days</span></div><div>" +
                    this.leadingZeros(data.hours, 2) + " " +
                    "<span>hrs</span></div><div>" +
                    this.leadingZeros(data.min, 2) + " " +
                    "<span>min</span></div><div>" +
                    this.leadingZeros(data.sec, 2) + " " +
                    "<span>sec</span></div>");
                }
            });
        }
    </script>

    <!--CSS-->
    <style>
        .countdown-styled div {
            display: inline-block;
            margin: 0 5px 1em;
            font-size: 30px;
            font-weight: 100;
            line-height: 1;
            text-align: right;

            /* IE7 inline-block hack */
            *display: inline;
            *zoom: 1;
        }

        .countdown-styled div:first-child {
            margin-left: 0;
        }

        .countdown-styled div:last-child {
            margin-right: 0;
        }

        .countdown-styled div span {
            display: block;
            border-top: 1px solid #cecece;
            padding-top: 3px;
            font-size: 12px;
            font-weight: normal;
            text-transform: uppercase;
            text-align: left;
        }
    </style>
</head>
<body class="grey lighten-3">

<!--Navigation Menu-->
<?php
include 'header.php';
?>
<!--Navigation Menu-->

<!--Search-->
<div class="row" style="z-index: 100;">
    <nav class="blue z-depth-1">
        <div class="nav-wrapper">
            <form method="get" class="offset-l2 col l8 s12" style="margin-top: 20px;">
                <div class="input-field" style="height: 35px;">
                    <input id="search" name="search" type="search" placeholder="    Αναζητήστε εδώ..."
                           required>
                    <label style="margin-top:-15px" for="search"><i class="mdi-action-search"></i></label>
                    <i style="margin-top:-15px" class="mdi-navigation-close"></i>
                </div>
            </form>
        </div>
    </nav>
</div>
<!--Search-->

<!-- Rooms Auctions -->
<div class="container" style="padding-top: 50px;">
    <div class="row">
        <div id="stream">
            <?php
            while ($row = mysqli_fetch_array($result)) {
                $id = $row['ID'];
                $Name = $row['Name'];
                $Description = $row['Description'];
                $Closed = $row['Closed'];
                $Bid_Price = $row['Bid_Price'];
                $Buy_Price = $row['Buy_Price'];
                //Explode Image to get all images
                $Image = explode(";", $row['Images']);
                $Hotel = $row['Hotel'];
                $HotelName = $row['HotelName'];
                //Explode HotelImage to get all images
                $HotelImage = explode(";", $row['HotelImage']);
                $End_Date = $row['End_Date'];
                ?>
                <div class="col s12 m6 l4">
                    <div id="<?php echo 'Auction_' . $id; ?>" class="card">
                        <div class="card-image waves-effect waves-block waves-light">
                            <img class="activator" onclick="flip('<?php echo 'Auction_' . $id; ?>')"
                                 src="<?php echo $Image[0]; ?>">
                        </div>
                        <div class="card-content">
                        <span onclick="flip('<?php echo 'Auction_' . $id; ?>')" src="images/office1.jpg"
                              class="card-title activator grey-text text-darken-4"><?php echo $Name; ?><i
                                class="mdi-navigation-more-vert right"></i></span>

                            <div
                                class="flow-text grey-text text-darken-2"><?php if ($Closed) echo 'Πωλήθηκε για '; else echo 'Τρέχουσα τιμή:';
                                echo $Bid_Price; ?>
                                Euro
                            </div>
                            <p>
                                <?php
                                if ($Closed) {
                                    echo '<div class="flow-text red center">Έληξε</div>';
                                } else {
                                    echo '<div id="Auction_Time' . $id . '" class="countdown-styled left-align"></div>';
                                    echo '<script>SetTimer(' . $id . ',\'' . $End_Date . '\')</script>';
                                }
                                ?>

                            <p><a href="<?php echo 'auction.php?id=' . $id; ?>"
                                  onclick="$('#<?php echo 'Auction_' . $id; ?>').addClass('animated  pulse')"
                                  src="images/office1.jpg">Διαβάστε
                                    περισσότερα...</a></p>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4"
                                  onclick="flip('<?php echo 'Auction_' . $id; ?>')">Περιγραφή</span>

                            <p><?php echo $Description; ?>

                            <li class="divider"></li>
                            <p>Τιμή Αγοράς: <?php echo $Buy_Price; ?></p>
                            <li class="divider"></li>
                            <div
                                style="padding-top: 10px; font-size: 1.2em;">
                                Ξενοδοχείο: <a href="hotel.php?id=<?php echo $Hotel; ?>"><?php echo $HotelName; ?></a>
                            </div>

                            <div class="center valign-wrapper" style="padding: 5px 50px 0px 50px;">
                                <img id="<?php echo 'img_prof' . $id; ?>"
                                     onclick="rotate('<?php echo 'img_prof' . $id; ?>')"
                                     class=" circle responsive-img z-depth-3 grey lighten-3"
                                     src="<?php echo $HotelImage[0]; ?>" style="height: 200px; width: 200px;">
                            </div>
                            </p>
                        </div>
                    </div>
                </div>
            <?php
            }

            mysqli_free_result($result);
            ?>
        </div>
    </div>

    <?php
    if ($AllAuction > 6) {
        ?>
        <div class="row">
            <div id="pages">
                <ul class="pagination right">
                    <li class=<?php if ($page < 2) echo '"disabled"><a>'; else echo '"waves-effect"><a href="auctions.php?page=' . ($page - 1) . '">'; ?><i
                        class="mdi-navigation-chevron-left"></i></a></li>
                    <?php
                    $i = 1;
                    while ($i <= $pages && $i < 7) {
                        if ($pages > 6 && $i == 6) {
                            echo '<li>...</li><li class="';
                            if ($page == $i) {
                                echo 'active';
                            } else {
                                echo 'waves-effect';
                            }
                            echo '"><a href="auctions.php?page=' . $pages . '">' . $pages . '</a></li>';
                        } else {
                            echo '<li class="';
                            if ($page == $i) {
                                echo 'active';
                            } else {
                                echo 'waves-effect';
                            }
                            echo '"><a href="auctions.php?page=' . $i . '">' . $i . '</a></li>';
                        }
                        $i++;
                    }
                    ?>
                    <li class=<?php if ($page + 1 > $pages) echo '"disabled"><a>'; else echo '"waves-effect"><a href="auctions.php?page=' . ($page + 1) . '">'; ?><i
                        class="mdi-navigation-chevron-right"></i></a></li>
                </ul>
            </div>
        </div>
    <?php
    }
    ?>
</div>
<!-- Rooms Auctions -->

<!--footer-->
<?php
include 'footer.php'
?>
<!--footer-->

</body>
</html>