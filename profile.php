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
        <script src=js/profilescripts.js></script>
        <style>
            .tabregion{
                display: none;
            }
            .hidden_form_s_1{
                display: none;
            }
            .hidden_form_s_8{
                display: none;
            }
            .hidden_form_s_14{
                display: none;
            }
            .hidden_form_s_15{
                display: none;
            }
            .PaginAuctionsHiEd{
                display: none;
            }
            .detailshead{
                font-weight: bold;
                font-size: 20px;
            }
            .detailsbody_s_1{
                font-size: 20px;
            }
            .detailsbody_s_8{
                font-size: 20px;
            }
            .detailsbody_s_14{
                font-size: 20px;
            }
            .detailsbody_s_15{
                font-size: 20px;
            }
        </style>
    </head>
    <body class="white" onload="CurrentTab();
            PaginAuctionsHistory(0);">

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
                                    <a href="#gomytab_15" class="collection-item mytab" id="mytab_15">Testing details</a>
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
                                    <a href="#gomytab_14" class="collection-item mytab" id="mytab_14">Testing details</a>
                                    <a href="#gomytab_5" class="collection-item mytab" id="mytab_5">Δημιουργία</a>
                                    <a href="#gomytab_9" class="collection-item mytab" id="mytab_9">Επεξεργασία</a>
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

            <?php
            //User Details
            include 'profile/sections/user_details.php';

            //Auctions History/Edit
            include 'profile/sections/auctions_history_edit.php';

            //Users evaluation
            include 'profile/sections/users_evaluation.php';

            if (ownsProfile()) {
                if ((isRole("admin") || isRole("hotelier"))) {
                    //Auction Create
                    include 'profile/sections/auction_create.php';

                    //Hotel Create
                    include 'profile/sections/hotel_create.php';

                    //Hotel Details
                    include 'profile/sections/hotel_details.php';

                    //Auction Details
                    include 'profile/sections/auction_details.php';
                }
                if (isRole("user")) {

                    //Upgrade user
                    include 'profile/sections/upgrade_user.php';

                    //Hotel evaluation
                    include 'profile/sections/hotel_evaluation.php';

                    //Auctions History/Edit
                    include 'profile/sections/auctions_history_edit.php';
                }
                if (isRole("admin")) {
                    //Auctionσ Edit
                    include 'profile/sections/auctions_edit.php';

                    //User Edit
                    include 'profile/sections/user_edit.php';
                }

                //Use Delete
                include 'profile/sections/user_delete.php';

                //User Create                
                include 'profile/sections/user_create.php';
            }
            ?>
            <!--Tab Panels-->

        </div>

        <?php
        include 'footer.php';
        ?>
    </body>
</html>
