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

            $(".icn").click(function () {
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
                            <a class="collapsible-header active mytab" id="mytab_1" href="#"><i class="mdi-action-perm-contact-cal"></i>Πληροφορίες</a>
                            <div class="collapsible-body"><p>Επεξεργαστείτε προσωπικές πληροφορίες.</p></div>
                        </li>
                        <li>
                            <a class="collapsible-header mytab" href="#"><i class="mdi-social-notifications-on"></i>Δημοπρασίες</a>
                            <div class="collapsible-body collection">
                                <a href="#2" class="collection-item mytab" id="mytab_2">Ενεργές</a>
                                <a href="#3" class="collection-item mytab" id="mytab_3">Ιστορικό</a>
                            </div>
                        </li>
                        <li>
                            <a class="collapsible-header mytab" id="mytab_4"  href="#"><i class="mdi-social-person-add"></i>Aναβάθμιση</a>
                        </li>
                        <li>
                            <a class="collapsible-header mytab" href="#" id="mytab_5"><i class="mdi-action-delete"></i>Διαγραφή</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!--Tab Panels-->
            <!--User Details-->
            <div class="col s12 m8 tabregion" id="section_1" style="display: inline">
                <div class="col s12 m12">
                    <div class="white lighten-4" style="height: 400px;">
                        <div class="left-align" style="padding: 10px">
                            <div class="col s12 grey lighten-4 z-depth-1" >
                                <p class="col s4 detailshead">Όνομα: </p> 
                                <p  class="col s3 detailsbody">Κωνσταντίνος</p>
                            </div>
                            <div class="col s12 grey lighten-4 z-depth-1" >
                                <p class="col s4 detailshead">Επώνυμο: </p> 
                                <p  class="col s3 detailsbody">Χασιώτης</p>
                            </div>
                            <div class="col s12 grey lighten-4 z-depth-1" >
                                <p class="col s4 detailshead">Ψευδώνυμο: </p> 
                                <p  class="col s3 detailsbody">Armageddonas</p>
                            </div>
                            <div class="col s12 grey lighten-4 z-depth-1" >
                                <p class="col s4 detailshead">Τηλέφωνο: </p> 
                                <p  class="col s3 detailsbody">6944444444</p>
                            </div>
                            <div class="col s12 grey lighten-4 z-depth-1" >
                                <p class="col s4 detailshead">E-mail: </p> 
                                <p  class="col s3 detailsbody">icsd11175@icsd.aegean.gr</p>
                            </div>
                            <div class="col s12 grey lighten-4 z-depth-1" >
                                <p class="col s4 detailshead">Ημερομηνία γέννησης: </p> 
                                <p  class="col s3 detailsbody">25/2/1993</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--User Details-->

            <div class="col s12 m8 tabregion" id="section_2">
                <div class="col s12 m12">
                    <div class="card grey lighten-4" style="height: 100px;">
                        <div class="center-align" style="padding: 20px">
                            2
                        </div>
                    </div>
                </div>
            </div>

            <div class="col s12 m8 tabregion" id="section_3">
                <div class="col s12 m12">
                    <div class="card grey lighten-4" style="height: 100px;">
                        <div class="center-align" style="padding: 20px">
                            3
                        </div>
                    </div>
                </div>
            </div>

            <!--Upgrade user-->
            <div class="col s12 m8 tabregion" id="section_4">
                <div class="col s12 m12">
                    <div class="center-align card" style="height: 400px;">
                        <div class="flow-text" style="padding: 20px">
                            <p>Με την αναβάθμιση του λογαριασμού σας ώστε να έχετε το δικαίωμα να θέτετε σε δημοπρασία τα δωμάτια του ξενοδοχείου σας</p>
                        </div>
                        <button class="btn waves-effect waves-light" type="submit" name="action">ΑΝΑΒΑΘΜΙΣΗ ΤΩΡΑ
                            <i class="mdi-content-send right"></i>
                        </button>
                    </div>
                </div>
            </div>
            <!--Upgrade user-->

            <!--Delete user-->
            <div class="col s12 m8 tabregion" id="section_5">
                <div class="col s12 m12">
                    <div class="card white" style="height: 400px;">
                        <div class="center-align" style="padding: 20px">
                            <p class="flow-text">Επιλέγοντας να διαγραφεί ο λογαριασμός σας τα προσωπικά σας δεδομένα διαγράφονται από το Samos Rentals</p>
                            <!-- Modal Trigger -->
                            <a class="waves-effect waves-light btn modal-trigger" href="#modal1">ΔΙΑΓΡΑΦΗ ΛΟΓΑΡΙΑΣΜΟΥ</a>

                            <!-- Modal Structure -->
                            <div id="modal1" class="modal">
                                <div class="modal-content">
                                    <h4>Διαγραφή λογαριασμού</h4>
                                    <p>Η διαγραφή του λογαριασμού σας είναι μη αναστρέψιμη. Είστε σίγουροι ότι θέλετε να συνεχίσετε;</p>
                                </div>
                                <div class="modal-footer">
                                    <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Επιστροφή</a>
                                    <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Διαγραφή λογαριασμού</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Delete user-->
            <!--Tab Panels-->

        </div>
        <?php
        include 'footer.php';
        ?>
    </body>
</html>