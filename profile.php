<?php
include 'admin/configuration.php';
session_start();


//Check if user is not logged and he's requesting for Noone!
if (!islogged() && empty($_GET['user'])) {
    die("<script>window.history.back()</script>");
}

//Connect
$con = db_connect();
if ($con->connect_errno) {
    return;
}

//Check if user want to get another user's profile or his own
if (!empty($_GET['user'])) {
    $user = htmlspecialchars($_GET['user']);
} else {
    $user = $_SESSION['userid'];
}

// SQL query to fetch information of user.
$sql = $con->prepare('SELECT * FROM user WHERE Username= ?');
$sql->bind_param('s', $user);
$sql->execute();

$result = $sql->get_result();
$num_row = mysqli_num_rows($result);
if ($num_row == 1) {
//Fetch all user's information
    $row = mysqli_fetch_array($result);

    $username = $row['Username'];
    $fname = $row['FirstName'];
    $lname = $row['LastName'];
    $tel = $row['Tel'];
    $mail = $row['Mail'];
    $sex = $row['Sex'];
    $birthday = $row['Birthday'];
    if ($row['Role'] == 0) {
        $role = "Διαχειριστής";
    } else if ($row['Role'] == 1) {
        $role = "Μάνατζερ";
    } else {
        $role = "Χρήστης";
    }
    $image = $row['Image'];

//Εδώ πρέπει να παρθούν και άλλες πληροφορίες δημοπρασίες hoteliers κτλ
} else {
//Returns error that page not found
    die(include '404.html');
}

function isRole($role) {
    if (!islogged()) {
        return false;
    }

    $level = $_SESSION['role'];
    if ($level == 0 && $role == "admin") {
        return true;
    } else if ($level == 1 && $role == "hotelier") {
        return true;
    } else if ($level == 2 && $role == "user") {
        return true;
    } else {
        return false;
    }
}

function ownsProfile() {
    if (!islogged()) {
        return false;
    }



    if ($_SESSION['userid'] == $GLOBALS['user']) {
        return true;
    } else {
        return false;
    }
}
?>

<!DOCTYPE html>
<html>
    <head lang="en">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <title>Samos Rentals</title>
        <link rel="icon" type="image/png" href="images/website/favicon.ico"/>

        <!-- CSS  -->
        <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>

        <!--  Scripts  -->
        <script src="js/jquery-2.1.1.min.js"></script>
        <script src="js/materialize.js"></script>
        <script src="js/init.js"></script>
        <script>
            $(document).ready(function () {
                $('.mytab').focus(function () {
                    var num = this.id.match(/\d+/)[0];

                    $(".tabregion").hide();
                    $("#section_" + num).show();
                });
            });
        </script>
        <style>
            .tabregion{
                display: none;
            }
            .detailshead{
                font-weight: bold; 
                font-size: 20px;
            }
            .detailsbody{
                font-size: 20px;
            }
        </style>
    </head>
    <body class="white">

        <!--Navigation Menu-->
        <?php
        include 'header.php';
        ?>
        <!--Navigation Menu-->

        <div class="row container" style="padding-top: 60px">
            <div class="col s12 m4">
                <div class="center-align col s12 m12 materialboxed">
                    <img class=" circle responsive-img z-depth-1 grey lighten-3" style="padding: 5px"
                         src="<?php echo $image; ?>">
                </div>
                <div class="col s12 m12">
                    <ul class="collapsible popout" data-collapsible="accordion">

                        <li>
                            <a class="collapsible-header active mytab" id="mytab_1" href="#"><i
                                    class="mdi-action-perm-contact-cal"></i>Πληροφορίες</a>
                                <?php
                                if (ownsProfile()) {
                                    ?>
                                <div class="collapsible-body"><p>Επεξεργαστείτε προσωπικές πληροφορίες.</p></div>
                            <?php }
                            ?>
                        </li>

                        <li>
                            <a class="collapsible-header mytab"><i class="mdi-social-notifications-on"></i>Δημοπρασίες</a>
                            <div class="collapsible-body collection">
                                <?php
                                if (!isRole("admin")) {
                                    ?>
                                    <a href="#2" class="collection-item mytab" id="mytab_2">Ιστορικό</a>
                                    <a href="#3" class="collection-item mytab" id="mytab_3">Βαθμολόγηση</a>
                                <?php }
                                ?>
                                <?php
                                if ((isRole("admin") || isRole("hotelier")) && ownsProfile()) {
                                    ?>
                                    <a href="#6" class="collection-item mytab" id="mytab_4">Δημιουργία</a>
                                <?php }
                                ?>
                            </div>
                        </li>
                        <?php
                        if (ownsProfile() && isRole("hotelier")) {
                            ?>
                            <li>
                                <a class="collapsible-header mytab" id="mytab_5"  href="#"><i class="mdi-maps-hotel"></i>Ξενοδοχείο</a>
                            </li>
                        <?php }
                        ?>
                        <?php
                        if (isRole("user")) {
                            ?>
                            <li>
                                <a class="collapsible-header mytab" id="mytab_6"  href="#"><i class="mdi-social-person-add"></i>Aναβάθμιση</a>
                            </li>
                            <?php
                        }
                        if (ownsProfile()) {
                            ?>
                            <li>
                                <a class="collapsible-header mytab" href="#" id="mytab_7"><i class="mdi-action-delete"></i>Διαγραφή</a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <!--Tab Panels-->

            <!--User Details-->
            <div class="card row col s12 m8 tabregion" id="section_1" style="display: inline">
                <div class="col offset-s1 s10">
                    <p class="col s4 detailshead">Όνομα: </p>

                    <p class="col s8 detailsbody"><?php echo $fname; ?></p>
                </div>
                <div class="col offset-s1 s10 divider"></div>
                <div class="col offset-s1 s10">
                    <p class="col s4 detailshead">Επώνυμο: </p>

                    <p class="col s8 detailsbody"><?php echo $lname; ?></p>
                </div>
                <div class="col offset-s1 s10 divider"></div>
                <div class="col offset-s1 s10">
                    <p class="col s4 detailshead">Ψευδώνυμο: </p>

                    <p class="col s8 detailsbody"><?php echo $username; ?></p>
                </div>
                <div class="col offset-s1 s10 divider"></div>
                <div class="col offset-s1 s10">
                    <p class="col s4 detailshead">Τηλέφωνο: </p>

                    <p class="col s8 detailsbody"><?php echo $tel; ?></p>
                </div>
                <div class="col offset-s1 s10 divider"></div>
                <div class="col offset-s1 s10">
                    <p class="col s4 detailshead">E-mail: </p>

                    <p class="col s8 detailsbody"><?php echo $mail; ?></p>
                </div>
                <div class="col offset-s1 s10 divider"></div>
                <div class="col offset-s1 s10">
                    <p class="col s4 detailshead">Ημερομηνία γέννησης: </p>

                    <p class="col s8 detailsbody"><?php echo $birthday; ?></p>
                </div>
                <div class="col offset-s1 s10 divider"></div>
                <div class="col offset-s1 s10">
                    <p class="col s4 detailshead">Ρόλος: </p>

                    <p class="col s8 detailsbody"><?php echo $role; ?></p>
                </div>
            </div>
            <!--User Details-->

            <!-- Auction History -->
            <div class="col s12 m8 tabregion" id="section_2" >
                <div class="z-depth-3 white col s12" style="padding-top: 15px;padding-bottom: 15px;">                           
                    <a class="col s12 m4" href="#!"><i class="mdi-maps-hotel"></i> Grand Budapest Hotel </a>
                    <a class="col s12 m5" href="#!"><i class="mdi-action-home"></i> Δωμάτια σε τιμή ευκαιρίας </a>
                    <a class="col s11 m2" href="#!" ><i class="mdi-editor-attach-money"> </i>35</a>
                    <div class="col s1"><i class="mdi-navigation-check"> </i></div>
                </div>
                <div class="z-depth-3 white col s12" style="padding-top: 15px;padding-bottom: 15px;">                           
                    <a class="col s12 m4" href="#!"><i class="mdi-maps-hotel"></i> Grand Budapest Hotel </a>
                    <a class="col s12 m5" href="#!"><i class="mdi-action-home"></i> Δωμάτια σε τιμή ευκαιρίας </a>
                    <a class="col s11 m2" href="#!" ><i class="mdi-editor-attach-money"> </i>35</a>
                    <div class="col s1"><i class="mdi-navigation-close"> </i></div>
                </div>
            </div>
            <!-- Auction History -->

            <!-- Auctions won -->
            <div class="col s12 m8 tabregion" id="section_3">
                <div class="z-depth-3 white col s12" style="padding-top: 15px;padding-bottom: 15px;">                           
                    <a class="col s12 m4" href="#!"><i class="mdi-maps-hotel"></i> Grand Budapest Hotel </a>
                    <a class="col s12 m4" href="#!"><i class="mdi-action-home"></i> Δωμάτια σε τιμή ευκαιρίας </a>
                    <a class="col s11 m2" href="#!" ><i class="mdi-editor-attach-money"> </i>35</a>
                    <div class="col s12 m4 l2">
                        <i class="mdi-action-star-rate circle amber accent-3"></i>
                        <i class="mdi-action-star-rate circle amber accent-3"></i>
                        <i class="mdi-action-star-rate circle amber accent-3"></i>
                        <i class="mdi-action-star-rate circle grey accent-3"></i>
                        <i class="mdi-action-star-rate circle grey accent-3"></i>
                    </div>
                </div>
                <div class="z-depth-3 white col s12" style="padding-top: 15px;padding-bottom: 15px;">                           
                    <a class="col s12 m4" href="#!"><i class="mdi-maps-hotel"></i> Grand Budapest Motel </a>
                    <a class="col s12 m4" href="#!"><i class="mdi-action-home"></i> Δωμάτια σε τιμή ανευκαιρίας </a>
                    <a class="col s11 m2" href="#!" ><i class="mdi-editor-attach-money"> </i>120</a>
                    <div class="col s12 m4 l2">
                        <i class="mdi-action-star-rate circle amber accent-3"></i>
                        <i class="mdi-action-star-rate circle amber accent-3"></i>
                        <i class="mdi-action-star-rate circle amber accent-3"></i>
                        <i class="mdi-action-star-rate circle amber accent-3"></i>
                        <i class="mdi-action-star-rate circle grey accent-3"></i>
                    </div>
                </div>
            </div>
            <!-- Auctions won -->


            <!-- Create Auction -->

            <?php
            if (ownsProfile()) {
                if ((isRole("admin") || isRole("hotelier"))) {
                    ?>
                    <div class="card col s12 m8 tabregion" id="section_4">
                        <div class="white col s12" style="padding-top: 15px;padding-bottom: 15px;">
                            <div class="input-field col s12">
                                <i class="mdi-action-account-circle prefix"></i>
                                <input id="AuctionTitleInput" type="text" class="validate">
                                <label for="AuctionTitleInput">Τίτλος</label>
                            </div>
                            <form class="col s12">
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="mdi-social-people prefix"></i>
                                        <textarea id="AuctionDescriptionInput" class="materialize-textarea"></textarea>
                                        <label for="AuctionDescriptionInput">Περιγραφή</label>
                                    </div>
                                </div>
                            </form>
                            <div class="input-field col s12 m12 l6">
                                <i class="mdi-editor-attach-money prefix"></i>
                                <input id="AuctionStartPrice" type="text" class="validate">
                                <label for="AuctionStartPrice">Τιμή εκκίνησης</label>
                            </div>
                            <div class="input-field col s12 m12 l6">
                                <i class="mdi-editor-attach-money prefix"></i>
                                <input id="AuctionBuyPriceInput" type="text" class="validate">
                                <label for="AuctionBuyPriceInput">Τιμή αγοράς</label>
                            </div>
                            <div class="input-field col s12">
                                <i class="mdi-action-description prefix"></i>
                                <input id="AuctionPeopleInput" type="text" class="validate">
                                <label for="AuctionPeopleInput">Αριθμός ατόμων</label>
                            </div>
                            <div class="input-field col s12">
                                <button class="btn waves-effect waves-light" type="submit" name="action">Υποβολή
                                    <i class="mdi-content-send right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Create Auction -->

                    <!--Hotel details-->
                    <div class="z-depth-3 col s12 m8 tabregion" id="section_5">   

                        <div class="col s12" style="padding-top: 20px; padding-bottom: 30px;">
                            <a class="waves-effect waves-light orange darken-1 btn">ΠΡΟΒΟΛΗ ΣΕΛΙΔΑΣ</a>
                        </div>
                        <div class="input-field col s6">
                            <i class="mdi-action-account-circle prefix"></i>
                            <input id="HotelNameInput" type="text" class="validate">
                            <label for="HotelNameInput">Όνομα ξενοδοχείου</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="mdi-communication-location-on prefix"></i>
                            <input id="HotelLocationInput" type="text" class="validate">
                            <label for="HotelLocationInput">Τοποθεσία</label>
                        </div>
                        <div class="input-field col s12">
                            <i class="mdi-action-description prefix"></i>
                            <textarea id="HotelDescriptionInput" class="materialize-textarea"></textarea>
                            <label for="HotelDescriptionInput">Περιγραφή</label>
                        </div>
                        <div class="input-field col s12">
                            <i class="mdi-action-face-unlock prefix"></i>
                            <textarea id="HotelDescriptionInput" class="materialize-textarea"></textarea>
                            <label for="HotelDescriptionInput">Ανέσεις</label>
                        </div>
                        <div class="col s12 m12 l5 file-field input-field">
                            <form action="#">
                                <div class="file-field input-field">
                                    <input placeholder="Φωτογραφία" class="file-path validate" type="text"/>
                                    <div class="btn">
                                        <span>File</span>
                                        <input type="file" />
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col s6 m6 l5 file-field input-field">
                            <form action="#">
                                <div class="file-field input-field">
                                    <input placeholder="Φωτογραφία" class="file-path validate" type="text"/>
                                    <div class="btn">
                                        <span>File</span>
                                        <input type="file" />
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col s12" style="padding-bottom: 20px;padding-top: 40px">
                            <button class="btn waves-effect waves-light" type="submit" name="action">ΚΑΤΑΧΩΡΗΣΗ
                                <i class="mdi-content-send right"></i>
                            </button>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <!--Hotel details-->

                <?php
                if (isRole("user")) {
                    ?>
                    <!--Upgrade user-->
                    <div class="col s12 m8 tabregion" id="section_6">
                        <div class="col s12 m12">
                            <div class="center-align card" style="height: 400px;">
                                <div class="flow-text" style="padding: 20px">
                                    <p>Με την αναβάθμιση του λογαριασμού σας έχετε το δικαίωμα να θέτετε σε δημοπρασία τα
                                        δωμάτια του ξενοδοχείου σας</p>
                                </div>
                                <button class="btn waves-effect waves-light" type="submit" name="action">ΑΝΑΒΑΘΜΙΣΗ ΤΩΡΑ
                                    <i class="mdi-content-send right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!--Upgrade user-->
                    <?php
                }
                ?>
                <!--Delete user-->
                <div class="col s12 m8 tabregion" id="section_7">
                    <div class="col s12 m12">
                        <div class="card white" style="height: 400px;">
                            <div class="center-align" style="padding: 20px">
                                <p class="flow-text">Επιλέγοντας να διαγραφεί ο λογαριασμός σας τα προσωπικά σας
                                    δεδομένα διαγράφονται από το Samos Rentals</p>
                                <!-- Modal Trigger -->
                                <a class="waves-effect waves-light btn modal-trigger" href="#modal1">ΔΙΑΓΡΑΦΗ
                                    ΛΟΓΑΡΙΑΣΜΟΥ</a>

                                <!-- Modal Structure -->
                                <div id="modal1" class="modal">
                                    <div class="modal-content">
                                        <h4>Διαγραφή λογαριασμού</h4>

                                        <p>Η διαγραφή του λογαριασμού σας είναι μη αναστρέψιμη. Είστε σίγουροι ότι
                                            θέλετε να συνεχίσετε;</p>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="#!"
                                           class=" modal-action modal-close waves-effect waves-green btn-flat">Επιστροφή</a>
                                        <a href="delete.php?account=my"
                                           class=" modal-action modal-close waves-effect waves-green btn-flat">Διαγραφή
                                            λογαριασμού</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Delete user-->
                <?php
            }
            ?>
            <!--Tab Panels-->

        </div>

        <?php
        include 'footer.php';
        ?>
    </body>
</html>