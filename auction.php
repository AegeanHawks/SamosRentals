<?php
include 'admin/configuration.php';
session_start();

if (!isset($_GET["id"])) {
    include("404.php");
    die;
}
?>
<!DOCTYPE html>
<html>
    <head lang="en">
        <?php
        $Page_Title = "Δημοπρασία";
        include 'head.php';
        ?>

        <style>
            .bidnumber{
                font-size: 80px !important; 
                color: white !important;   
                text-shadow: -2px 0 orange, 0 2px orange, 2px 0 orange, 0 -2px orange !important;
                text-align: center;
            }
            .bidheader{
                text-align: center;

            }
        </style>
        <script src="js/bid_scripts.js"></script>
    </head>
    <body onload="initFuncIntervals(<?php echo $_GET["id"] ?>)">
        <?php
        include 'header.php';
        ?>

        <?php
        try {
            // SQL query to fetch 
            $con = db_connect();

            $auctionDetailsStmt = "SELECT auction.ID as auctionID, hotel.Name as hotelName, auction.Name as auctionName, auction.Description, PeopleCount, Closed, Bid_Price, "
                    . "Buy_Price, Hotel, Images, End_Date, Highest_Bidder, Tel, Grade FROM auction, hotel WHERE hotel.ID=auction.Hotel AND auction.ID=?";

            // <editor-fold defaultstate="collapsed" desc="Prepare and run statement">
            // <editor-fold defaultstate="collapsed" desc="Error checking">
            if (!$auctionDetails = $con->prepare($auctionDetailsStmt)) {
                throw new Exception("\nPrepared '" . $auctionDetailsStmt . "' statement failed. \nDetails: " . mysqli_error($con));
            }
            // </editor-fold>
            $auctionDetails->bind_param('i', $_GET["id"]);


            // <editor-fold defaultstate="collapsed" desc="Error checking">
            if (!$auctionDetails->execute()) {
                debug_to_console("Execute error: \"" . $auctionDetailsStmt . "\"" . "\n", 3, $errorpath);
                debug_to_console("Execute failed: (" . $auctionDetails->errno . ") " . $auctionDetails->error . "\"" . "\n", 3, $errorpath);
                throw new Exception("Statement failed to execute");
            }
            // </editor-fold>

            $resulauctionDetails = $auctionDetails->get_result();
            if (mysqli_num_rows($resulauctionDetails) != 1) {
                throw new Exception("Wrong number of results");
            }
            // </editor-fold>

            $auctionDetailsRow = mysqli_fetch_array($resulauctionDetails);
            //$_SESSION["CurrentViewingAuctionBidPrice"]=$auctionDetailsRow["Bid_Price"];
        } catch (Exception $e) {
            debug_to_console("##Error at " . __FILE__ . "\"\nDetails: " . $e->getMessage() . "\"" . "\n", 3, $errorpath);
            $errormessage = "<div class=\"col offset-s1 s10\">
                            <p class=\"col s12\">Κάτι πήγε στραβά </p></div>";
            echo $errormessage;
        }
        ?>
        <div class="parallax-container">
            <div class="parallax"><img src="http://static2.wallpedes.com/wallpaper/beach/beach-wallpapers-widescreen-best-desktop-3d-hd-wallpapers-beach-house-wallpaper-download-for-pc-android-mobile-windows-7-name-nature-animation.jpg"></div>
        </div>

        <div class="container">
            <div class="section no-pad-bot" style="margin-top: -5%;">
                <div class="row">
                    <div class="col offset-l2 l8 s12 white z-depth-3">
                        <div class="col l12 m8 s12">
                            <h4 class="grey-text darken-2 light"><?php echo $auctionDetailsRow["auctionName"]; ?></h4>
                            <p class="grey-text darken-3"><?php echo $auctionDetailsRow["Description"]; ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" >
                <div class="col s12 m12 l4">
                    <ul class="collection">
                        <li class="collection-item avatar" >
                            <i class="mdi-action-accessibility circle blue"></i>
                            <span class="title truncate">Αριθμός ατόμων</span>
                            <p>
                                <?php echo $auctionDetailsRow["PeopleCount"]; ?>
                            </p>                                            
                        </li>
                        <li class="collection-item avatar">
                            <i class="mdi-communication-messenger circle orange"></i>
                            <span class="title truncate">Πληροφορίες ξενοδοχείου</span>
                            <p><a href="#">
                                    <?php echo $auctionDetailsRow["hotelName"]; ?>
                                </a>
                            </p>                                            
                        </li>

                        <li class="collection-item avatar" >
                            <i class="mdi-communication-phone circle green"></i>
                            <span class="title">Τηλέφωνο επικοινωνίας</span>
                            <p>
                                <?php echo $auctionDetailsRow["Tel"]; ?>
                            </p>
                        </li>
                        <li class="collection-item" >
                            <span class="title" ><?php echo $auctionDetailsRow["Grade"]; ?></span><br>
                            <i class="mdi-action-star-rate circle amber accent-3"></i>
                            <i class="mdi-action-star-rate circle amber accent-3"></i>
                            <i class="mdi-action-star-rate circle amber accent-3"></i>
                            <i class="mdi-action-star-rate circle amber accent-3"></i>
                            <i class="mdi-action-star-rate circle amber accent-3"></i>
                        </li>
                    </ul>
                </div>
                <div class="col s12 m12 l8 center-align">
                    <div class="col s12 m6 l6 z-depth-1" style="padding: 10px; height: 200px;">
                        <h5 class="grey-text bidheader truncate">ΤΡΕΧΟΥΣΑ ΤΙΜΗ</h5>

                        <p class="bidnumber" id="parAuctionHighestBid">
                            <?php
                            if ($auctionDetailsRow["Highest_Bidder"] == null) {
                                echo $auctionDetailsRow["Bid_Price"];
                            }
                            ?></p>
                    </div>
                    <?php
                    if (isRole("user")) {
                        ?>
                        <div class="col s12 m6 l6 z-depth-1" style="padding: 10px; height: 200px;">
                            <h5 class="grey-text bidheader truncate">ΠΛΕΙΟΔΟΤΗΣΑΤΕ</h5>

                            <p class="bidnumber" id="LastUserBid"><?php
                    if ($auctionDetailsRow["Highest_Bidder"] != null) {
                        //include "bid/last_user_bid.php";
                    }
                        ?></p>
                        </div>
                        <form id="auctionBidForm" method="Get">
                            <div class="col s12 m6 l6 z-depth-1" style="padding: 10px; height: 200px;">
                                <a class="btn waves-effect waves-light" onclick="userBid(<?php echo $_GET["id"]; ?>)" name="action">Πλειοδοτησε 
                                </a>
                                <input id="auctionUserBid" class="validate bidnumber" style="height: 90px; margin-top: 45px" placeholder="" size="90" name="bid_value" type="text" >
                                <input name="auctionID" style="display: none" value="<?php echo $_GET["id"]; ?>">
                            </div>
                        </form>
                        <?php
                        if ($auctionDetailsRow["Buy_Price"] != 0) {
                            ?>
                            <form id="auctionBuyForm" method="Get">
                                <div class="col s12 m6 z-depth-1" style="padding: 10px; height: 190px;">
                                    <a class="btn waves-effect waves-light" name="action" onclick="auctionBuyNow(<?php echo $_GET["id"]; ?>)">Αγορασε τωρα</a>
                                    <p class="bidnumber" id="BuyNowValue">
                                        <?php echo $auctionDetailsRow["Buy_Price"]; ?>
                                    </p>
                                </div>
                                <?php
                            }
                            ?>
                        </form>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <!--Slider-->
            <div class="slider col s8 offset-s2" >
                <ul class="slides" >
                    <li>
                        <img src="http://www.gabelliconnect.com/wp-content/uploads/2014/08/luxury-hotel-rooms-pamilla-cape-town.jpg"> <!-- random image -->
                        <div class="caption center-align">
                            <h3>This is our big Tagline!</h3>
                            <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
                        </div>
                    </li>
                    <li>
                        <img src="http://hoteldolphinkatra.co.in/wp-content/gallery/dolphin/four-bed.jpg"> <!-- random image -->
                        <div class="caption left-align">
                            <h3>Left Aligned Caption</h3>
                            <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
                        </div>
                    </li>
                    <li>
                        <img src="http://www.themresort.com/media/gallery/images/HOTEL-ROOMS/M-Resort-Hotel-Room-One-Bedroom-2.jpg"> <!-- random image -->
                        <div class="caption right-align">
                            <h3>Right Aligned Caption</h3>
                            <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
                        </div>
                    </li>
                    <li>
                        <img src="http://www.hotelpanorama.com.hk/d/panaroma/media/__thumbs_980_490_crop/Room_1_Superior_Silver_twin-bed47a2ae.jpg?1362096164"> <!-- random image -->
                        <div class="caption center-align">
                            <h3>This is our big Tagline!</h3>
                            <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
                        </div>
                    </li>
                </ul>
            </div>
            <!--Slider End-->
        </div>

        <?php
        include 'footer.php';
        ?>
    </body>
</html>