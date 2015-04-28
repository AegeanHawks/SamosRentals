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
    <nav class="green darken-4 z-depth-3" role="navigation">
        <div class="nav-wrapper">
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

            <ul class="right hide-on-med-and-down">
                <li><a href="#users" class="white-text">Χρήστες</a></li>
                <li><a href="#auctions" class="white-text">Δημοπρασίες</a></li>
                <li><a href="#hotels" class="white-text">Ξενοδοχία</a></li>
                <li class="tab red"><a href="#" class="white-text">Αποσύνδεση</a></li>
            </ul>

            <ul id="nav-mobile" class="right side-nav blue accent-3">
                <li><a href="#" class="white-text">Χρήστες</a></li>
                <li><a href="#" class="white-text">Δημοπρασίες</a></li>
                <li><a href="#" class="white-text">Ξενοδοχία</a></li>
                <li class="red"><a href="#" class="white-text">Αποσύνδεση</a></li>
            </ul>

            <a class="button-collapse" href="#" data-activates="nav-mobile"><i class="mdi-navigation-menu"></i></a>
        </div>
    </nav>
</div>
<!--Navigation Menu-->

<?php
if ($_GET["page"] === "user") {

} else if ($_GET["page"] === "auction") {

} else if ($_GET["page"] === "hotel") {

}
?>

<div class="container" style="padding-top: 60px;">
    <div class="row">
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
                    <a onclick="Materialize.toast('<span>Η Αλλαγή Ολοκληρώθηκε!</span><a class=\'btn-flat yellow-text\' href=\'#!\'>Αναιρεση<a>', 5000, 'rounded')"
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
</div>

<!-- Modal Structure -->
<div id="delete_question" class="modal">
    <div class="modal-content">
        <h4>Διαγραφή</h4>

        Είσαι σίγουρος ότι θέλεις να διαγράψεις τον χρήστη;<br>
        Μετά από αυτό δεν υπάρχει γυρισμός φιλαράκο!!!
    </div>
    <div class="modal-footer">
        <a onclick="Materialize.toast('<span>Ο χρήστης πήρε τον π...</span>', 3000, 'rounded')" href="#!"
           class=" modal-action modal-close waves-effect waves-green btn-flat">Ναι</a>
        <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Όχι</a>
    </div>
</div>
<!-- Modal Structure -->

</body>
</html>