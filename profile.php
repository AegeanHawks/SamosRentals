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
    die(include '404.php');
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
    if (islogged() && $_SESSION['userid'] == $GLOBALS['user']) {
        return true;
    }
    return false;
}
?>


<!DOCTYPE html>
<html>
    <head lang="en">
        <?php
        $Page_Title = "Προφίλ - " . $user;
        include 'head.php';
        ?>
        <script>
            $(document).ready(function () {
            $('.mytab').focus(function () {
            var num = this.id.match(/\d+/)[0];
                    $(".tabregion").hide();
                    $("#section_" + num).show();
            });
            });
                    function rotate(id) {
                    var cont = document.getElementById(id).className;
                            if (cont.indexOf('rotateIn') != - 1) {
                    $('#' + id).removeClass('rotateIn');
                    } else {
                    $('#' + id).addClass('animated rotateIn');
                            setTimeout(function () {
                            $('#' + id).removeClass('rotateIn');
                            }, 1000);
                    }
                    }
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
                <div class="center-align col s12 m12">
                    <img id="img_prof" onclick="rotate('img_prof')"
                         class=" circle responsive-img z-depth-1 grey lighten-3" style="padding: 5px"
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
                                if ((isRole("admin") || isRole("hotelier")) && ownsProfile()) {
                                    ?>
                                    <a href="#6" class="collection-item mytab" id="mytab_4">Δημιουργία</a>

                                    <a href="#2" class="collection-item mytab" id="mytab_2">Επεξεργασία</a>
                                    <?php
                                }
                                if (isRole("hotelier") && ownsProfile()) {
                                    ?>
                                    <a href="#3" class="collection-item mytab" id="mytab_3">Βαθμολόγηση</a>
                                    <?php
                                }
                                if (isRole("user") && ownsProfile()) {
                                    ?>
                                    <a href="#2" class="collection-item mytab" id="mytab_11">Ιστορικό</a>
                                    <a href="#3" class="collection-item mytab" id="mytab_10">Βαθμολόγηση</a>
                                <?php }
                                ?>
                            </div>
                        </li>
                        <li>

                        <li>
                            <?php
                            if (ownsProfile() && (isRole("admin") || isRole("hotelier"))) {
                                ?>
                                <a class = "collapsible-header mytab" id = "mytab_6" ><i class = "mdi-maps-hotel"></i>Ξενοδοχεία</a>
                                <div class = "collapsible-body collection">
                                    <?php
                                    if (ownsProfile() && isRole("hotelier")) {
                                        ?>
                                        <a href="#8" class="collection-item mytab" id="mytab_8">Στοιχεία</a>
                                        <a href="#10" class="collection-item mytab" id="mytab_5">Επεξεργασία</a>
                                        <?php
                                    }
                                    if (ownsProfile() && isRole("admin")) {
                                        ?>
                                        <a href="#6" class="collection-item mytab" id="mytab_5">Δημιουργία</a>
                                        <a href="#9" class="collection-item mytab" id="mytab_9">Επεξεργασία</a>
                                    <?php }
                                    ?>
                                </div>

                            <?php }
                            ?>
                        </li>
                        <li>
                            <?php
                            if (ownsProfile() && isRole("admin")) {
                                ?>
                                <a class = "collapsible-header mytab" id = "mytab_6" ><i class = "mdi-social-people"></i>Χρήστες</a>
                                <div class = "collapsible-body collection">
                                    <a href="#12" class="collection-item mytab" id="mytab_13">Δημιουργία</a>
                                    <a href="#13" class="collection-item mytab" id="mytab_12">Επεξεργασία</a>
                                </div>

                            <?php }
                            ?>
                        </li>
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


            <!-- Auctionσ History/Edit -->
            <div class="card col s12 m8 tabregion" id="section_2">
                <div class=" white col s12 " style="padding-top: 15px;padding-bottom: 15px; font-weight: bold">
                    <div class="col s12 m3">Τίτλος</div>                       
                    <div class="col s12 m3">Τιμή Έναρξης</div>               
                    <div class="col s12 m4">Υψηλότερη Πλειοδοσία</div>     
                    <div class="col s12 m2">Επεξεργασία</div>     
                </div>
                <span class="divider col s12"></span>
                <div class="white col s12" style="padding-top: 10px;padding-bottom: 10px;">
                    <a class="col s12 m3 truncate" href="#!"><i class="mdi-action-home"></i> Δωμάτια σε τιμή ευκαιρίας
                        ευκαιρίας ευκαιρίας</a>

                    <div class="col s12 m3 flow-text"><i class="mdi-editor-attach-money"> </i>35</div>
                    <div class="col s12 m4 flow-text"><i class="mdi-editor-attach-money"> </i>55</div>
                    <div class="col s12 m2 flow-text">
                        <div class="btn-floating grey"><i class="mdi-editor-mode-edit"></i></div>
                    </div>
                    <div class="divider"></div>
                </div>
                <span class="divider col s12"></span>
                <div class="white col s12" style="padding-top: 10px;padding-bottom: 10px;">
                    <a class="col s12 m3" href="#!"><i class="mdi-action-home"></i> Δωμάτια σε τιμή ευκαιρίας </a>

                    <div class="col s12 m3 flow-text"><i class="mdi-editor-attach-money"> </i>35</div>
                    <div class="col s12 m4 flow-text"><i class="mdi-editor-attach-money"> </i>40</div>
                    <div class="col s12 m2 flow-text">
                        <div class="btn-floating grey"><i class="mdi-editor-mode-edit"></i></div>
                    </div>
                </div>
                <span class="divider col s12"></span>
                <div class="white col s12" style="padding-top: 20px;padding-bottom: 20px;">
                    <ul class="pagination">
                        <li class="disabled"><a href="#!"><i class="mdi-navigation-chevron-left"></i></a></li>
                        <li class="active"><a href="#!">1</a></li>
                        <li class="waves-effect"><a href="#!">2</a></li>
                        <li class="waves-effect"><a href="#!">3</a></li>
                        <li class="waves-effect"><a href="#!">4</a></li>
                        <li class="waves-effect"><a href="#!">5</a></li>
                        <li class="waves-effect"><a href="#!"><i class="mdi-navigation-chevron-right"></i></a></li>
                    </ul>
                </div>
            </div>
            <!-- Auctionσ History/Edit -->


            <!-- Users evaluation -->
            <div class="col s12 m8 tabregion" id="section_3">
                <div class="z-depth-3 white col s12 " style="padding-top: 15px;padding-bottom: 15px;">                           
                    <div class="col s12 m4 l4">Ονομ/νυμο</div>                       
                    <div class="col s12 m3 l4">Δωμάτιο</div>             
                    <div class="col s12 m5 l4">Βαθμολόγηση</div>     
                </div>
                <div class="z-depth-3 white col s12" style="padding-top: 15px;padding-bottom: 15px;">                           
                    <a class="col s12 m4 l4" href="#!"><i class="mdi-maps-hotel"></i> Κωνσταντίνος Χασιώτης </a>
                    <a class="col s12 m3 l4" href="#!"><i class="mdi-action-home"></i> Δωμάτια σε τιμή ευκαιρίας </a>
                    <div class="col s12 m5 l4">
                        <a onclick="" href="#"><i class="mdi-action-star-rate circle amber accent-3"></i></a>
                        <a onclick="" href="#"><i class="mdi-action-star-rate circle amber accent-3"></i></a>
                        <a onclick="" href="#"><i class="mdi-action-star-rate circle amber accent-3"></i></a>
                        <a onclick="" href="#"><i class="mdi-action-star-rate circle amber accent-3"></i></a>
                        <a onclick="" href="#"><i class="mdi-action-star-rate circle amber accent-3"></i></a>
                    </div>
                </div>
                <div class="z-depth-3 white col s12" style="padding-top: 15px;padding-bottom: 15px;">                           
                    <a class="col s12 m4 l4" href="#!"><i class="mdi-maps-hotel"></i> Κωνσταντίνος Χασιώτης </a>
                    <a class="col s12 m3 l4" href="#!"><i class="mdi-action-home"></i> Δωμάτια σε τιμή ευκαιρίας </a>
                    <div class="col s12 m5 l4">
                        <a onclick="" href="#"><i class="mdi-action-star-rate circle amber accent-3"></i></a>
                        <a onclick="" href="#"><i class="mdi-action-star-rate circle amber accent-3"></i></a>
                        <a onclick="" href="#"><i class="mdi-action-star-rate circle amber accent-3"></i></a>
                        <a onclick="" href="#"><i class="mdi-action-star-rate circle amber accent-3"></i></a>
                        <a onclick="" href="#"><i class="mdi-action-star-rate circle amber accent-3"></i></a>
                    </div>
                </div>
                <span class="divider col s12"></span>
                <div class="white col s12" style="padding-top: 20px;padding-bottom: 20px;">
                    <ul class="pagination">
                        <li class="disabled"><a href="#!"><i class="mdi-navigation-chevron-left"></i></a></li>
                        <li class="active"><a href="#!">1</a></li>
                        <li class="waves-effect"><a href="#!">2</a></li>
                        <li class="waves-effect"><a href="#!">3</a></li>
                        <li class="waves-effect"><a href="#!">4</a></li>
                        <li class="waves-effect"><a href="#!">5</a></li>
                        <li class="waves-effect"><a href="#!"><i class="mdi-navigation-chevron-right"></i></a></li>
                    </ul>
                </div>
            </div>
            <!-- Users evaluation -->




            <?php
            if (ownsProfile()) {
                if ((isRole("admin") || isRole("hotelier"))) {
                    ?>
                    <!-- Create Auction -->
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
                                        <textarea id="AuctionDescriptionInput" class="materialize-textarea" length="500"></textarea>
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

                    <!--Hotel Edit-->
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
                            <textarea id="HotelDescriptionInput" class="materialize-textarea" length="500"></textarea>
                            <label for="HotelDescriptionInput">Περιγραφή</label>
                        </div>
                        <div class="input-field col s12">
                            <i class="mdi-action-face-unlock prefix"></i>
                            <textarea id="HotelDescriptionInput" class="materialize-textarea"></textarea>
                            <label for="HotelDescriptionInput">Ανέσεις</label>
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
                    <!--Hotel Edit-->
                    <?php
                }


                if (isRole("hotelier")) {
                    ?>
                    <!--Hotel Details-->
                    <div class="card row col s12 m8 tabregion" id="section_8">
                        <div class="col offset-s1 s10">
                            <p class="col s4 detailshead">Όνομα: </p>

                            <p class="col s8 detailsbody">Grand Budapest Hotel </p>
                        </div>
                        <div class="col offset-s1 s10 divider"></div>
                        <div class="col offset-s1 s10">
                            <p class="col s4 detailshead">Περιγραφή: </p>

                            <p class="col s8 detailsbody">Ένα από τα πιο γνωστά ξενοδοχεία στο νησί, βρίσκεται στο πιο κεντρικό σημείο της γραφικής πρωτεύουσας Βαθύ. Προσφέρουμε ανέσεις και υπηρεσίες υψηλού επιπέδου στις διακοπές σας ή απλά στον καφέ που απολαμβάνετε κοντά μας. Η διεύθυνση και το προσωπικό καταβάλλουμε κάθε προσπάθεια για ευχάριστη παραμονή και αξέχαστες εμπειρίες. Χαρείτε τη διαμονή σας στη Σάμο, κάθε μέρα...</p>
                        </div>
                        <div class="col offset-s1 s10 divider"></div>
                        <div class="col offset-s1 s10 divider"></div>
                        <div class="col offset-s1 s10">
                            <p class="col s4 detailshead">Τηλέφωνο: </p>

                            <p class="col s8 detailsbody">6982444444</p>
                        </div>
                        <div class="col offset-s1 s10 divider"></div>
                        <div class="col offset-s1 s10">
                            <p class="col s4 detailshead">Βαθμολογία: </p>

                            <p class="col s8 detailsbody">4/5</p>
                        </div>
                    </div>
                    <!--Hotel Details-->
                    <?php
                }

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

                    <!-- Hotel evaluation -->
                    <div class="z-depth-3 col s12 m8 tabregion" id="section_10">
                        <div class="white col s12 " style="padding-top: 15px;padding-bottom: 15px;">                           
                            <div class="col s12 m4 l4">Ξενοδοχείο</div>                       
                            <div class="col s12 m3 l4">Δημοπρασία</div>             
                            <div class="col s12 m5 l4">Βαθμολόγηση</div>     
                        </div>
                        <span class="divider col s12"></span>
                        <div class=" white col s12" style="padding-top: 15px;padding-bottom: 15px;">                           
                            <a class="col s12 m4 l4" href="#!"><i class="mdi-maps-hotel"></i> Grand Budapest Hotel </a>
                            <a class="col s12 m3 l4" href="#!"><i class="mdi-action-home"></i> Δωμάτια σε τιμή ευκαιρίας </a>
                            <div class="col s12 m5 l4">
                                <a onclick="" href="#"><i class="mdi-action-star-rate circle amber accent-3"></i></a>
                                <a onclick="" href="#"><i class="mdi-action-star-rate circle amber accent-3"></i></a>
                                <a onclick="" href="#"><i class="mdi-action-star-rate circle amber accent-3"></i></a>
                                <a onclick="" href="#"><i class="mdi-action-star-rate circle amber accent-3"></i></a>
                                <a onclick="" href="#"><i class="mdi-action-star-rate circle amber accent-3"></i></a>
                            </div>
                        </div>
                        <span class="divider col s12"></span>
                        <div class="white col s12" style="padding-top: 15px;padding-bottom: 15px;">                          
                            <a class="col s12 m4 l4" href="#!"><i class="mdi-maps-hotel"></i> Grand Budapest Hotel </a>
                            <a class="col s12 m3 l4" href="#!"><i class="mdi-action-home"></i> Δωμάτια σε τιμή ευκαιρίας </a>
                            <div class="col s12 m5 l4">
                                <a onclick="" href="#"><i class="mdi-action-star-rate circle amber accent-3"></i></a>
                                <a onclick="" href="#"><i class="mdi-action-star-rate circle amber accent-3"></i></a>
                                <a onclick="" href="#"><i class="mdi-action-star-rate circle amber accent-3"></i></a>
                                <a onclick="" href="#"><i class="mdi-action-star-rate circle amber accent-3"></i></a>
                                <a onclick="" href="#"><i class="mdi-action-star-rate circle amber accent-3"></i></a>
                            </div>
                        </div>
                        <span class="divider col s12"></span>
                        <div class="white col s12" style="padding-top: 20px;padding-bottom: 20px;">
                            <ul class="pagination">
                                <li class="disabled"><a href="#!"><i class="mdi-navigation-chevron-left"></i></a></li>
                                <li class="active"><a href="#!">1</a></li>
                                <li class="waves-effect"><a href="#!">2</a></li>
                                <li class="waves-effect"><a href="#!">3</a></li>
                                <li class="waves-effect"><a href="#!">4</a></li>
                                <li class="waves-effect"><a href="#!">5</a></li>
                                <li class="waves-effect"><a href="#!"><i class="mdi-navigation-chevron-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Hotel evaluation -->

                    <!-- Auctionσ History -->
                    <div class="card col s12 m8 tabregion" id="section_11">
                        <div class=" white col s12 " style="padding-top: 15px;padding-bottom: 15px; font-weight: bold">
                            <div class="col s12 m5">Τίτλος</div>                       
                            <div class="col s12 m3">Τιμή Έναρξης</div>               
                            <div class="col s12 m4">Υψηλότερη Πλειοδοσία</div>  
                        </div>
                        <span class="divider col s12"></span>
                        <div class="white col s12" style="padding-top: 10px;padding-bottom: 10px;">
                            <a class="col s12 m5 truncate" href="#!"><i class="mdi-action-home"></i> Δωμάτια σε τιμή ευκαιρίας
                                ευκαιρίας ευκαιρίας</a>

                            <div class="col s12 m3 flow-text"><i class="mdi-editor-attach-money"> </i>35</div>
                            <div class="col s12 m4 flow-text"><i class="mdi-editor-attach-money"> </i>55</div>
                            <div class="divider"></div>
                        </div>
                        <span class="divider col s12"></span>
                        <div class="white col s12" style="padding-top: 10px;padding-bottom: 10px;">
                            <a class="col s12 m5" href="#!"><i class="mdi-action-home"></i> Δωμάτια σε τιμή ευκαιρίας </a>

                            <div class="col s12 m3 flow-text"><i class="mdi-editor-attach-money"> </i>35</div>
                            <div class="col s12 m4 flow-text"><i class="mdi-editor-attach-money"> </i>40</div>
                        </div>
                        <span class="divider col s12"></span>
                        <div class="white col s12" style="padding-top: 20px;padding-bottom: 20px;">
                            <ul class="pagination">
                                <li class="disabled"><a href="#!"><i class="mdi-navigation-chevron-left"></i></a></li>
                                <li class="active"><a href="#!">1</a></li>
                                <li class="waves-effect"><a href="#!">2</a></li>
                                <li class="waves-effect"><a href="#!">3</a></li>
                                <li class="waves-effect"><a href="#!">4</a></li>
                                <li class="waves-effect"><a href="#!">5</a></li>
                                <li class="waves-effect"><a href="#!"><i class="mdi-navigation-chevron-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Auctionσ History/Edit -->
                    <?php
                }
                if (isRole("admin")) {
                    ?>
                    <!-- Auctionσ Edit -->
                    <div class="card col s12 m8 tabregion" id="section_9">
                        <div class=" white col s12 " style="padding-top: 15px;padding-bottom: 15px; font-weight: bold">
                            <div class="col s12 m5">Ξενοδοχεία</div>                       
                            <div class="col s12 m5">Τηλέφωνο</div>                 
                            <div class="col s12 m2">Επεξεργασία</div>     
                        </div>
                        <span class="divider col s12"></span>
                        <div class="white col s12" style="padding-top: 10px;padding-bottom: 10px;">
                            <a class="col s12 m5 truncate" href="#!"><i class="mdi-action-home"></i> Grand Budapest hotel</a>

                            <div class="col s12 m5 flow-text">6982444444</div>
                            <div class="col s12 m2 flow-text">
                                <div class="btn-floating grey"><i class="mdi-editor-mode-edit"></i></div>
                            </div>
                            <div class="divider"></div>
                        </div>
                        <span class="divider col s12"></span>
                        <div class="white col s12" style="padding-top: 10px;padding-bottom: 10px;">
                            <a class="col s12 m5 truncate" href="#!"><i class="mdi-action-home"></i> Grand Budapest motel</a>

                            <div class="col s12 m5 flow-text">6982444444</div>
                            <div class="col s12 m2 flow-text">
                                <div class="btn-floating grey"><i class="mdi-editor-mode-edit"></i></div>
                            </div>
                        </div>
                        <span class="divider col s12"></span>
                        <div class="white col s12" style="padding-top: 20px;padding-bottom: 20px;">
                            <ul class="pagination">
                                <li class="disabled"><a href="#!"><i class="mdi-navigation-chevron-left"></i></a></li>
                                <li class="active"><a href="#!">1</a></li>
                                <li class="waves-effect"><a href="#!">2</a></li>
                                <li class="waves-effect"><a href="#!">3</a></li>
                                <li class="waves-effect"><a href="#!">4</a></li>
                                <li class="waves-effect"><a href="#!">5</a></li>
                                <li class="waves-effect"><a href="#!"><i class="mdi-navigation-chevron-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Auctionσ Edit -->


                    <!-- Edit User -->
                    <div class="col s12 m8 tabregion" id="section_12">
                        <ul class="collapsible" data-collapsible="accordion">
                            <li>
                                <div class="collapsible-header">
                                    <div id="id" class="col s1 truncate">ID</div>
                                    <div id="username" class="col s3 truncate">Ψευδώνυμο</div>
                                    <div id="name" class="col s2 truncate">Όνομα</div>
                                    <div id="lastname" class="col s3 truncate">Επώνυμο</div>
                                    <div id="email" class="col s3 truncate">E-mail</div>
                                </div>
                                <div class="collapsible-body">
                                    <div class="row col s12">
                                        <div class="input-field col m4 l3 s12">
                                            <i class="mdi-action-account-circle prefix"></i>
                                            <input id="icon_prefix" type="text" class="validate">
                                            <label for="icon_prefix">Όνομα</label>
                                        </div>
                                        <div class="input-field col m4 l3 s12">
                                            <input id="icon_prefix" type="text" class="validate">
                                            <label for="icon_prefix">Επώνυμο</label>
                                        </div>
                                        <div class="input-field col m4 l3 s12">
                                            <i class="mdi-action-assignment-ind prefix"></i>
                                            <input id="icon_prefix" type="text" class="validate">
                                            <label for="icon_prefix">Ψευδώνυμο</label>
                                        </div>
                                        <div class="input-field col m4 l3 s12">
                                            <i class="mdi-communication-vpn-key prefix"></i>
                                            <input id="icon_prefix" type="password" class="validate">
                                            <label for="icon_prefix">Κωδικός</label>
                                        </div>
                                        <div class="input-field col m4 l3 s12">
                                            <i class="mdi-communication-email prefix"></i>
                                            <input id="icon_prefix" type="email" class="validate">
                                            <label for="icon_prefix">Email</label>
                                        </div>
                                        <div class="input-field col m4 l3 s12">
                                            <i class="mdi-action-today prefix"></i>
                                            <input id="icon_prefix" type="date" class="validate">
                                        </div>
                                        <div class="input-field col m4 l3 s12">
                                            <i class="mdi-maps-local-phone prefix"></i>
                                            <input id="icon_prefix" type="tel" class="validate">
                                            <label for="icon_prefix">Τηλέφωνο</label>
                                        </div>
                                        <div class="input-field col m4 l3 s12">
                                            <select>
                                                <option value="1">Άνδρας</option>
                                                <option value="2" selected>Γυναίκα</option>
                                            </select>
                                            <label>Φύλο</label>
                                        </div>

                                        <div class="col s12 m12">
                                            <div class="col s2 m4">
                                                <img class="circle responsive-img " src="images/website/avatar.jpg">
                                            </div>
                                            <div class="col s10 m8 file-field input-field">
                                                <input class="file-path validate" type="text"/>

                                                <div class="btn">

                                                    <span>File</span>
                                                    <input type="file"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a onclick="Materialize.toast(\'<span>Η Αλλαγή Ολοκληρώθηκε!</span><a class=\\\'btn-flat yellow-text\\\' href=\\\'#!\\\'>Αναιρεση<a>\', 5000, \'rounded\')"
                                       class="waves-effect green waves-light btn right"><i class="mdi-content-save left"></i>Αποθήκευση</a>
                                    <a class="waves-effect red waves-light btn modal-trigger left" href="#delete_question"><i
                                            class="mdi-content-save left"></i>Διαγραφή</a>
                                </div>
                            </li>
                            <li>
                                <div class="collapsible-header">
                                    <div id="id" class="col s1 truncate">ID</div>
                                    <div id="username" class="col s3 truncate">Ψευδώνυμο</div>
                                    <div id="name" class="col s2 truncate">Όνομα</div>
                                    <div id="lastname" class="col s3 truncate">Επώνυμο</div>
                                    <div id="email" class="col s3 truncate">E-mail</div>
                                </div>
                                <div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
                            </li>
                            <li>
                                <div class="collapsible-header">
                                    <div id="id" class="col s1 truncate">ID</div>
                                    <div id="username" class="col s3 truncate">Ψευδώνυμο</div>
                                    <div id="name" class="col s2 truncate">Όνομα</div>
                                    <div id="lastname" class="col s3 truncate">Επώνυμο</div>
                                    <div id="email" class="col s3 truncate">E-mail</div>
                                </div>
                                <div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
                            </li>
                        </ul>

                        <ul class="pagination">
                            <li class="disabled"><a href="#!"><i class="mdi-navigation-chevron-left"></i></a></li>
                            <li class="active"><a href="#!">1</a></li>
                            <li class="waves-effect"><a href="#!">2</a></li>
                            <li class="waves-effect"><a href="#!">3</a></li>
                            <li class="waves-effect"><a href="#!">4</a></li>
                            <li class="waves-effect"><a href="#!">5</a></li>
                            <li class="waves-effect"><a href="#!"><i class="mdi-navigation-chevron-right"></i></a></li>
                        </ul>
                    </div>
                    <!-- Edit User -->


                    <!-- Create User -->
                    <div class="card col s12 m8 tabregion" id="section_13">
                        <div class="white col s12" style="padding-top: 15px;padding-bottom: 15px;">
                            <div class="input-field col s6">
                                <i class="mdi-action-account-circle prefix"></i>
                                <input id="Name" type="text" class="validate">
                                <label for="Name">Όνομα</label>
                            </div>
                            <div class="input-field col s6">
                                <i class="mdi-social-group prefix"></i>
                                <input id="Surname" type="text" class="validate">
                                <label for="Surname">Επώνυμο</label>
                            </div>
                            <div class="input-field col s6">
                                <i class="mdi-social-whatshot prefix"></i>
                                <input id="Username" type="text" class="validate">
                                <label for="Username">Ψευδώνυμο</label>
                            </div>
                            <div class="input-field col s6">
                                <i class="mdi-communication-phone prefix"></i>
                                <input id="Phone" type="text" class="validate">
                                <label for="Phone">Τηλέφωνο</label>
                            </div>
                            <div class="input-field col s12">
                                <i class="mdi-communication-email prefix"></i>
                                <input id="Mail" type="text" class="validate">
                                <label for="Mail">E-mail</label>
                            </div>
                            <div class="input-field col s12">
                                <div class="input-field">
                                    <i class="mdi-social-cake prefix"></i>
                                    <input id="birthday" name="birthday" type="text" class="datepicker picker__input"
                                           required form="register">
                                    <label for="birthday">Ημερομηνία Γέννησης</label>
                                </div>
                            </div>
                            <div class="input-field col s12" style="padding-top: 10px; padding-bottom: 10px">
                                <button class="btn waves-effect waves-light" type="submit" name="action">Καταχωρηση
                                    <i class="mdi-content-send right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Create User -->

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
                                        <a onclick="Materialize.toast(\'<span>Ο χρήστης πήρε τον π...</span>\', 3000, \'rounded\')" href="#!"
                                           class=" modal-action modal-close waves-effect waves-green btn-flat">Ναι</a>
                                        <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Όχι</a>
                                    </div>
                                </div>
                                <!-- Modal Structure -->

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
