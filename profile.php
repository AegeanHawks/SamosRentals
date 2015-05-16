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
            function CurrentTab() {
            var url = window.location.href;
                    var num = url.match(/#.*/);
                    //alert(num);

                    if (num == null) {
            $("#section_1").show();
            } else {
            num = num[0].match(/\d+/)[0];
                    $(".tabregion").hide();
                    $("#section_" + num).show();
            }
            }

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
            function UserEditsProfile(edits) {
            if (edits == true) {
            $(".detailsbody").hide();
                    $(".hidden_form_s_1").show();
            } else {
            $(".detailsbody").show();
                    $(".hidden_form_s_1").hide();
            }
            return true;
                    //detailsbody
            }
        </script>
        <script>
            $(document).ready(function () {
            $('.mytab').focus(function () {
            var num = this.id.match(/\d+/)[0];
                    $(".tabregion").hide();
                    $("#section_" + num).show();
                    /*if (this.id == "mytabE_13") {
                     document.getElementById("SaUsState").value = "edit";
                     document.getElementById("SaUsTitle").innerHTML = "Επεξεργασία";
                     } else if (this.id == "mytab_13") {
                     document.getElementById("SaUsState").value = "new";
                     document.getElementById("SaUsTitle").innerHTML = "Προσθήκη";
                     }*/
            });
            });</script>
        <style>
            .tabregion{
                display: none;
            }
            .hidden_form_s_1{
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
    <body class="white" onload="CurrentTab()">

        <!--Navigation Menu-->
        <?php
        include 'header.php';
        ?>
        <!--Navigation Menu-->

        <div class="row container" style="padding-top: 60px">
            <!--Tab Panels-->
            <div class="col s12 m4">
                <div class="center-align col s12 m12">
                    <img id="img_prof" onclick="rotate('img_prof')"
                         class=" circle responsive-img z-depth-1 grey lighten-3" style="padding: 5px"
                         src="<?php echo $image; ?>">
                </div>
                <div class="col s12 m12">
                    <ul class="collapsible popout" data-collapsible="accordion">

                        <li>
                            <a class="collapsible-header active mytab" id="mytab_1" href="#gomytab_1"><i
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
                                    <a href="#gomytab_4" class="collection-item mytab" id="mytab_4">Δημιουργία</a>

                                    <a href="#gomytab_2" class="collection-item mytab" id="mytab_2">Επεξεργασία</a>
                                    <?php
                                }
                                if (isRole("hotelier") && ownsProfile()) {
                                    ?>
                                    <a href="#gomytab_3" class="collection-item mytab" id="mytab_3">Βαθμολόγηση</a>
                                    <?php
                                }
                                if (isRole("user") && ownsProfile()) {
                                    ?>
                                    <a href="#gomytab_11" class="collection-item mytab" id="mytab_11">Ιστορικό</a>
                                    <a href="#gomytab_10" class="collection-item mytab" id="mytab_10">Βαθμολόγηση</a>
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
                                        <a href="#gomytab_8" class="collection-item mytab" id="mytab_8">Στοιχεία</a>
                                        <a href="#gomytab_5" class="collection-item mytab" id="mytab_5">Επεξεργασία</a>
                                        <?php
                                    }
                                    if (ownsProfile() && isRole("admin")) {
                                        ?>
                                        <a href="#gomytab_5" class="collection-item mytab" id="mytab_5">Δημιουργία</a>
                                        <a href="#gomytab_9" class="collection-item mytab" id="mytab_9">Επεξεργασία</a>
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
                                    <a href="#gomytab_13" class="collection-item mytab" id="mytab_13">Δημιουργία</a>
                                    <a href="#gomytab_12" class="collection-item mytab" id="mytab_12">Επεξεργασία</a>
                                </div>

                            <?php }
                            ?>
                        </li>
                        <?php
                        if (isRole("user")) {
                            ?>
                            <li>
                                <a class="collapsible-header mytab" id="mytab_6"  href="#gomytab_6"><i class="mdi-social-person-add"></i>Aναβάθμιση</a>
                            </li>
                            <?php
                        }
                        if (ownsProfile()) {
                            ?>
                            <li>
                                <a class="collapsible-header mytab" href="#gomytab_7" id="mytab_7"><i class="mdi-action-delete"></i>Διαγραφή</a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <!--Tab Panels-->

            <!--User Details-->
            <div class="card row col s12 m8 tabregion" id="section_1" style="display: none">
                <?php if (ownsProfile()) {
                    ?>
                    <div class="col offset-s1 s12" style='padding-bottom: 20px'>
                        <a class="waves-effect waves-light btn" href="#gomytab_1" onclick="return UserEditsProfile(true)" id='mytabE_13'><i class="mdi-editor-mode-edit right"></i>Επεξεργασια</a>
                    </div>  
                <?php }
                ?>
                <form action="profile/saveuser.php" method="Get" id="EditUserForm">
                    <div class="col offset-s1 s10">
                        <p class="col s4 detailshead">Όνομα: </p>

                        <p class="col s8 detailsbody"><?php echo $fname; ?></p>
                        <div class="input-field col s6 hidden_form_s_1">
                            <input name="SaUsFirstName" type="text" class="validate" value="<?php echo $fname; ?>">
                        </div>
                    </div>
                    <div class="col offset-s1 s10 divider"></div>
                    <div class="col offset-s1 s10">
                        <p class="col s4 detailshead">Επώνυμο: </p>

                        <p class="col s8 detailsbody"><?php echo $lname; ?></p>
                        <div class="input-field col s6 hidden_form_s_1">
                            <input name="SaUsLastname" type="text" class="validate" value="<?php echo $lname; ?>">
                        </div>
                    </div>
                    <div class="col offset-s1 s10 divider"></div>
                    <div class="col offset-s1 s10">
                        <p class="col s4 detailshead">Ψευδώνυμο: </p>

                        <p class="col s8 detailsbody"><?php echo $username; ?></p>
                        <p class="col s8 hidden_form_s_1"><?php echo $username; ?></p>
                    </div>
                    <div class="col offset-s1 s10 divider"></div>
                    <div class="col offset-s1 s10">
                        <p class="col s4 detailshead">Τηλέφωνο: </p>

                        <p class="col s8 detailsbody"><?php echo $tel; ?></p>
                        <div class="input-field col s6 hidden_form_s_1">
                            <input name="SaUsTel" type="text" pattern='[0-9]{0,12}' class="validate" value="<?php echo $tel; ?>">
                        </div>
                    </div>
                    <div class="col offset-s1 s10 divider"></div>
                    <div class="col offset-s1 s10">
                        <p class="col s4 detailshead">E-mail: </p>

                        <p class="col s8 detailsbody"><?php echo $mail; ?></p>
                        <div class="input-field col s6 hidden_form_s_1">
                            <input name="SaUsMail" type="text" class="validate" value="<?php echo $mail; ?>">
                        </div>
                    </div>
                    <div class="col offset-s1 s10 divider"></div>
                    <div class="col offset-s1 s10">
                        <p class="col s4 detailshead">Ημερομηνία γέννησης: </p>

                        <p class="col s8 detailsbody"><?php echo $birthday; ?></p>
                        <div class="col s6 input-field hidden_form_s_1">
                            <input  name="SaUsBirthday" type="text" class="datepicker picker__input" value="<?php echo $birthday; ?>"
                                    required form="EditUserForm">
                        </div>
                    </div>
                    <div class="col offset-s1 s10 divider hidden_form_s_1"></div>
                    <div class="col offset-s1 s10 hidden_form_s_1">
                        <p class="col s4 detailshead">Κωδικός: </p>

                        <div class="col s8 input-field tooltipped" data-position="top" data-delay="50"
                             data-tooltip="Ο κωδικός είναι 8 χαρακτήρων και περιέχει τουλάχιστον 1 αριθμό,κεφαλαίο και μικρό γράμμα.">
                            <input name="SaUsPassword" type="password" pattern='(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}'
                                   onchange="form.reenter_password.pattern = this.value;"
                                   maxlength="30" class="validate">
                        </div>
                    </div>
                    <div class="col offset-s1 s10 divider"></div>
                    <div class="col offset-s1 s10">
                        <p class="col s4 detailshead">Φύλλο: </p>

                        <p class="col s8 detailsbody"><?php echo $sex; ?></p>
                        <div class="input-field col s6 hidden_form_s_1">
                            <select name="SaUsSex" class="validate" required form="EditUserForm">
                                <option value="male">Άνδρας
                                </option>
                                <option value="female">Γυναίκα
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col offset-s1 s10 divider"></div>
                    <div class="col offset-s1 s10 hidden_form_s_1">
                        <p class="col s4 detailshead">Ρόλος: </p>

                        <p class="col s8 detailsbody"><?php echo $role; ?></p>
                        <?php
                        if (isRole("admin")) {
                            ?>
                            <div class="offset-s1 input-field col s6 hidden_form_s_1">
                                <select id="SaUsRole" name="SaUsRole" class="validate" required form="EditUserForm">
                                    <option value="0">Administrator
                                    </option>
                                    <option value="1">Hotelier
                                    </option>
                                    <option value="2">User
                                    </option>
                                </select>
                                <label for="SaUsSex">Τύπος</label>
                            </div>
                            <?php
                        } else {
                            ?>
                            <p class="col s6 hidden_form_s_1"><?php echo $role; ?></p>
                            <?php
                        }
                        ?>
                    </div>   
                    <?php if (ownsProfile()) {
                        ?> 
                        <div class="col offset-s1 s12 hidden_form_s_1" style='padding-bottom: 20px'>
                            <button class="btn waves-effect waves-light" type="submit">Υποβολή
                                <i class="mdi-content-send right"></i>
                            </button>
                        </div>  
                        <div class="col offset-s1 s12 hidden_form_s_1" style='padding-bottom: 20px'>
                            <a class="waves-effect waves-light btn" href="#gomytab_1" onclick="return UserEditsProfile(false)" id='mytabE_13'><i class="mdi-editor-mode-edit right"></i>Ακύρωση</a>
                        </div>    
                    <?php } ?>

                    <input name="SaUsState" id="SaUsState" style='display: none' value="edit">
                </form>
            </div>
            <!--User Details-->


            <!-- Auctions History/Edit -->
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
            <!-- Auctions History/Edit -->


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
                            <form id="CreateEditAuction" action="profile/saveauction.php" method="GET">
                                <div class="input-field col s6">
                                    <i class="mdi-action-account-circle prefix"></i>
                                    <input name="AuctionName" id="AuctionTitleInput" type="text" class="validate">
                                    <label for="AuctionTitleInput">Τίτλος</label>
                                </div>
                                <div class="input-field col s6">
                                    <select name="CreateAuctionHotelID" form="CreateEditAuction">
                                        <option value="" disabled selected>Επιλέξτε εδώ</option>
                                        <?php
                                        // SQL query to fetch all hotels
                                        $allhotelsStatement;
                                        if (isRole("admin")) {
                                            $allhotelsStatement = "SELECT Name,ID FROM hotel ORDER BY Name";
                                        } else {
                                            $allhotelsStatement = "SELECT Name,ID FROM hotel WHERE Manager=? ORDER BY Name";
                                        }
                                        if (!$allhotels = $con->prepare($allhotelsStatement)) {
                                            error_log("Error: \"" . $allhotelsStatement . "\"" . "\n", 3, $errorpath);
                                        } else {
                                            $allhotels->bind_param('s', $_SESSION['userid']);

                                            if (!$allhotels->execute()) {
                                                error_log("Error: \"" . $allhotelsStatement . "\"" . "\n", 3, $errorpath);
                                                error_log("Execute failed: (" . $allhotels->errno . ") " . $allhotels->error . "\"" . "\n", 3, $errorpath);
                                            } else {
                                                $resultHotels = $allhotels->get_result();
                                                for ($i = 0; $i < mysqli_num_rows($resultHotels); $i++) {
                                                    $hotelsRow = mysqli_fetch_array($resultHotels);
                                                    echo '<option value="' . $hotelsRow["ID"] . '">' . $hotelsRow["Name"] . '</option>';
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                    <label>Ξενοδοχεία</label>
                                </div>
                                <div class="col s12">
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <i class="mdi-social-people prefix"></i>
                                            <textarea name="Description" id="AuctionDescriptionInput" class="materialize-textarea" length="500"></textarea>
                                            <label for="AuctionDescriptionInput">Περιγραφή</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-field col s12 m12 l6">
                                    <i class="mdi-editor-attach-money prefix"></i>
                                    <input name="Bid_Price" id="AuctionStartPrice" type="text" pattern="[0-9]{0,6}" class="validate">
                                    <label for="AuctionStartPrice">Τιμή εκκίνησης</label>
                                </div>
                                <div class="input-field col s12 m12 l6">
                                    <i class="mdi-editor-attach-money prefix"></i>
                                    <input name="Buy_Price" id="AuctionBuyPriceInput" type="text" pattern="[0-9]{0,6}" class="validate">
                                    <label for="AuctionBuyPriceInput">Τιμή αγοράς</label>
                                </div>
                                <div class="input-field col s12">
                                    <i class="mdi-action-description prefix"></i>
                                    <input name="PeopleCount" id="AuctionPeopleInput" type="text" pattern="[0-9]{0,2}" class="validate">
                                    <label for="AuctionPeopleInput">Αριθμός ατόμων</label>
                                </div>                            
                                <div class="input-field col s12">
                                    <div class="input-field">
                                        <i class="mdi-social-cake prefix"></i>
                                        <input name="End_Date" id="birthday" type="text" class="datepicker picker__input">
                                        <label for="birthday">Ημερομηνία λήξης</label>
                                    </div>
                                </div>
                                <div class="col s12 file-field input-field">
                                    <div class="file-field input-field">
                                        <input name="Images" placeholder="Φωτογραφία" class="file-path validate" type="text"/>
                                        <div class="btn">
                                            <span>File</span>
                                            <input type="file" />
                                        </div>
                                    </div>
                                </div>
                                <div class="input-field col s12" style="display: none;">
                                    <input value="null" name="AuctionIDSave" type="text">
                                </div>  
                                <div class="input-field col s12">
                                    <button class="btn waves-effect waves-light" type="submit">Υποβολή
                                        <i class="mdi-content-send right"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Create Auction -->

                    <!--Create hotel-->
                    <div class="z-depth-3 col s12 m8 tabregion" id="section_5">   

                        <div class="col s12" style="padding-top: 20px; padding-bottom: 30px;">
                            <a class="waves-effect waves-light orange darken-1 btn">ΠΡΟΒΟΛΗ ΣΕΛΙΔΑΣ</a>
                        </div>

                        <form action="profile/savehotel.php" method="GET" id="CreateEditHotel">
                            <div class="input-field col s6">
                                <i class="mdi-action-account-circle prefix"></i>
                                <input name="SaEdHotName" id="HotelNameInput" type="text" class="validate">
                                <label for="HotelNameInput">Όνομα ξενοδοχείου</label>
                            </div>
                            <?php
                            if (isRole("admin")) {
                                ?>
                                <div class="input-field col s6">
                                    <select name="SaEdHotChooseHotelier" form="CreateEditHotel">
                                        <option value="" disabled selected>Επιλέξτε εδώ</option>
                                        <?php
                                        // SQL query to fetch all hotels
                                        $allhoteliersQuery = "SELECT Username FROM user WHERE role<2 ORDER BY Username";

                                        if (!$allhoteliers = $con->prepare($allhoteliersQuery)) {
                                            error_log("Error: \"" . $allhotelsStatement . "\"" . "\n", 3, $errorpath);
                                        } else {
                                            $allhoteliers->execute();

                                            if ($allhoteliers == NULL) {
                                                error_log("Could not run query: \"" . $allhoteliersQuery . "\"" . "\n", 3, $errorpath);
                                            }
                                            $resultHoteliers = $allhoteliers->get_result();

                                            for ($i = 0; $i < mysqli_num_rows($resultHoteliers); $i++) {
                                                $hoteliersRow = mysqli_fetch_array($resultHoteliers);
                                                echo '<option value="' . $hoteliersRow["Username"] . '">' . $hoteliersRow["Username"] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                    <label>Ξενοδόχοι</label>
                                </div>
                                <?php
                            }
                            ?>
                            <div class="input-field col s6">
                                <i class="mdi-communication-phone prefix"></i>
                                <input name="SaEdHotTel" id="SaEdHotTel" type="text" class="validate">
                                <label for="SaEdHotTel">Τηλέφωνο</label> 
                            </div>
                            <div class="input-field col s6">
                                <i class="mdi-communication-location-on prefix"></i>
                                <input name="SaEdHotCoordinates" id="HotelLocationInput" type="text" class="validate">
                                <label for="HotelLocationInput">Τοποθεσία</label>
                            </div>
                            <div class="input-field col s12">
                                <i class="mdi-action-description prefix"></i>
                                <textarea name="SaEdHotDescription" id="HotelDescriptionInput" class="materialize-textarea" length="500"></textarea>
                                <label for="HotelDescriptionInput">Περιγραφή</label>
                            </div>
                            <div class="input-field col s12">
                                <i class="mdi-action-face-unlock prefix"></i>
                                <textarea name="SaEdHotComforts" id="HotelDescriptionInput" class="materialize-textarea"></textarea>
                                <label for="HotelDescriptionInput">Ανέσεις</label>
                            </div>
                            <div class="col s6 m6 l5 file-field input-field">
                                <div class="file-field input-field">
                                    <input name="SaEdHotImage" placeholder="Φωτογραφία" class="file-path validate" type="text"/>
                                    <div class="btn">
                                        <span>File</span>
                                        <input type="file" />
                                    </div>
                                </div>
                            </div>
                            <div class="input-field col s12" style="display: none;">
                                <input value="null" name="SaEdHotID" type="text">
                            </div>                              
                            <div class="col s12" style="padding-bottom: 20px;padding-top: 40px">
                                <button class="btn waves-effect waves-light" type="submit" name="action">ΚΑΤΑΧΩΡΗΣΗ
                                    <i class="mdi-content-send right"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <!--Create hotel-->
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

                    <!-- Auctions History -->
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
                    <!-- Auctions History/Edit -->
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


                    <!-- User Edit -->
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
                    <!-- User Edit -->
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

                <!-- User Create -->
                <div class="card col s12 m8 tabregion" id="section_13">
                    <div class="white col s12" style="padding-top: 15px;padding-bottom: 15px;">
                        <h4 id='SaUsTitle'></h4>
                        <form id="SaveCreateUser" action="profile/saveuser.php" method="Get">
                            <div class="input-field col s6">
                                <i class="mdi-action-account-circle prefix"></i>
                                <input name="SaUsFirstName" id="SaUsFirstName" type="text" class="validate">
                                <label for="SaUsFirstName">Όνομα</label>
                            </div>
                            <div class="input-field col s6">
                                <i class="mdi-social-group prefix"></i>
                                <input name="SaUsLastname" id="SaUsLastname" type="text" class="validate">
                                <label for="SaUsLastname">Επώνυμο</label>
                            </div>
                            <div class="input-field col s6">
                                <i class="mdi-social-whatshot prefix"></i>
                                <input name="SaUsUsername" id="SaUsUsername" type="text" class="validate">
                                <label for="SaUsUsername">Ψευδώνυμο</label>
                            </div>
                            <div class="input-field col s6">
                                <i class="mdi-communication-phone prefix"></i>
                                <input name="SaUsTel" id="SaUsTel" type="text" pattern='[0-9]{0,12}' class="validate">
                                <label for="SaUsTel">Τηλέφωνο</label>
                            </div>
                            <div class="col s12 input-field tooltipped" data-position="top" data-delay="50"
                                 data-tooltip="Ο κωδικός είναι 8 χαρακτήρων και περιέχει τουλάχιστον 1 αριθμό,κεφαλαίο και μικρό γράμμα.">
                                <i class="mdi-communication-vpn-key prefix"></i>
                                <input name="SaUsPassword" type="password" pattern='(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}'
                                       onchange="form.reenter_password.pattern = this.value;" id="SaUsPassword"
                                       maxlength="30" class="validate">
                                <label for="SaUsPassword">Κωδικός</label>
                            </div>
                            <div class="col s12 input-field">
                                <i class="mdi-action-verified-user prefix"></i>
                                <input type="password" name="password" id="reenter_password" maxlength="30" class="validate"
                                       required>
                                <label for="reenter_password">Ξαναβάλε τον κωδικό</label>
                            </div> 
                            <div class="input-field col s12">
                                <i class="mdi-communication-email prefix"></i>
                                <input name="SaUsMail" id="SaUsMail" type="text" class="validate">
                                <label for="SaUsMail">E-mail</label>
                            </div>
                            <div class="col s12 input-field">
                                <i class="mdi-social-cake prefix"></i>
                                <input  name="SaUsBirthday" id="SaUsBirthday" type="text" class="datepicker picker__input"
                                        required form="SaveCreateUser">
                                <label for="SaUsBirthday">Ημερομηνία Γέννησης</label>
                            </div>
                            <?php
                            if (isRole("admin")) {
                                ?>
                                <div class="offset-s1 input-field col s11">
                                    <select id="SaUsRole" name="SaUsRole" class="validate" required form="SaveCreateUser">
                                        <option value="0">Administrator
                                        </option>
                                        <option value="1">Hotelier
                                        </option>
                                        <option value="2">User
                                        </option>
                                    </select>
                                    <label for="SaUsSex">Τύπος</label>
                                </div>
                                <?php
                            }
                            ?>
                            <div class="input-field col offset-s1 s11">
                                <select id="SaUsSex" name="SaUsSex" class="validate" required form="SaveCreateUser">
                                    <option value="male">Άνδρας
                                    </option>
                                    <option value="female">Γυναίκα
                                    </option>
                                </select>
                                <label for="SaUsSex">Φύλο</label>
                            </div>

                            <input name="SaUsState" id="SaUsState" style='display: none' value="new">

                            <div class="input-field col s12" style="padding-top: 10px; padding-bottom: 10px">
                                <button class="btn waves-effect waves-light" type="submit" name="action">Καταχωρηση
                                    <i class="mdi-content-send right"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- User Create -->

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
