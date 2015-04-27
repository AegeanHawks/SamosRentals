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

    <!--  Scripts-->
    <script src="js/jquery-2.1.1.min.js"></script>
    <script src="js/materialize.js"></script>
    <script src="js/init.js"></script>
</head>
<body class="white">

<!--Navigation Menu-->
<div class="navbar-fixed">
    <nav class="blue darken-4 z-depth-3" role="navigation">
        <div class="nav-wrapper container">
            <div class="valign-demo valign-wrapper left">
                <a id="logo-container" href="index.html" class="brand-logo waves-effect waves-light">
                    <div class="hide-on-med-and-down">
                        <span class="left " style="padding-left:20px;"><img src="images/website/logo.png"></span>
                        <span class="white-text left " style="padding-left:15px;font-size: 0.7em;font-weight:300;">Samos Rentals</span>

                    </div>
                    <div class="hide-on-large-only">
                        <span class="white-text truncate">Samos Rentals</span>
                    </div>
                </a>
            </div>

            <!-- Dropdown Menu - Structure -->
            <a class="dropdown-button right hide-on-med-and-down" data-beloworigin="true" data-activates='dropdown'
               href='#'>
                <div class="card waves-effect waves-teal white z-depth-2 valign-wrapper">
                        <span class="grey-text truncate valign"
                              style="margin-right: 10px; margin-left: 10px; font-size: 1.2em;"><img
                                src="images/website/avatar.jpg "
                                style="padding-top: 5px;height: 48px;margin-right: 10px;"
                                class="valign circle left"><span>Νικόλαος Μπούσιος</span></span>
                </div>
            </a>

            <ul id='dropdown' class='card dropdown-content'>
                <li><a href="#!"><span class="mdi-action-settings left black-text"
                                       style="padding-right: 10px"></span>Ρυθμίσεις</a></li>
                <li><a href="#!"><span class="mdi-social-person left black-text"
                                       style="padding-right: 10px"></span>Προφίλ</a></li>
                <li class="divider"></li>
                <li><a href="#!"><span class="mdi-action-settings-power left black-text"
                                       style="padding-right: 10px"></span>Αποσύνδεση</a></li>
            </ul>
            <!-- Dropdown Menu - Structure -->

            <ul class="right hide-on-med-and-down">
                <li><a href="#" class="white-text">Ξενοδοχία</a></li>
                <li><a href="#" class="white-text">Δημοπρασίες</a></li>
            </ul>

            <ul id="nav-mobile" class="right side-nav blue accent-3">
                <li><a href="#" class="white-text">Ξενοδοχία</a></li>
                <li><a href="#" class="white-text">Δημοπρασίες</a></li>
                <li><a href="#" class="white-text">Καταχώρηση</a></li>
                <li><a href="register.html" class=" white-text waves-effect waves-stamplay btn-flat">Εγγραφη</a></li>
                <li><a href="login.html" class="waves-effect waves-light btn white-text">Συνδεση</a></li>
            </ul>

            <a class="button-collapse" href="#" data-activates="nav-mobile"><i class="mdi-navigation-menu"></i></a>
        </div>
    </nav>
</div>
<!--Navigation Menu-->

<div class="row container" style="padding-top: 60px">
    <div class="col s12 m4">
        <div class="col s12 m12">
            <div class="card white materialboxed">
                <div class="center-align" style="padding: 20px">
                    <img class="circle responsive-img " src="images/website/avatar.jpg">
                </div>
            </div>
        </div>
        <div class="col s12 m12">
            <ul class="collapsible popout" data-collapsible="accordion">
                <li>
                    <div class="collapsible-header active"><i class="mdi-action-perm-contact-cal"></i>Πληροφορίες</div>
                    <div class="collapsible-body"><p>Επεξεργαστείτε προσωπικές πληροφορίες.</p></div>
                </li>
                <li>
                    <div class="collapsible-header"><i class="mdi-social-notifications-on"></i>Δημοπρασίες</div>
                    <div class="collapsible-body collection">
                        <a href="#!" class="collection-item">Ενεργές</a>
                        <a href="#!" class="collection-item">Ιστορικό</a>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header"><i class="mdi-social-person-add"></i>Aναβάθμιση</div>
                </li>
                <li>
                    <div class="collapsible-header"><i class="mdi-action-delete"></i>Διαγραφή</div>
                </li>
            </ul>
        </div>
    </div>

    <div class="col s12 m8">
        <div class="col s12 m12">
            <div class="card grey lighten-4" style="height: 100px;">
                <div class="center-align" style="padding: 20px">

                </div>
            </div>
        </div>
    </div>
</div>
<?php
include 'footer.php';
?>
</body>
</html>