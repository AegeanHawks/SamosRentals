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
            .tabformatting{
                padding-top: 15px;
                padding-bottom: 15px;
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
                        <a id="logo-container" href="index.php" class="brand-logo waves-effect waves-light">
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
                        <li><a href="register.php" class=" white-text waves-effect waves-stamplay btn-flat">Εγγραφη</a></li>
                        <li><a href="login.php" class="waves-effect waves-light btn white-text">Συνδεση</a></li>
                    </ul>

                    <a class="button-collapse" href="#" data-activates="nav-mobile"><i class="mdi-navigation-menu"></i></a>
                </div>
            </nav>
        </div>
        <!--Navigation Menu-->

        <div class="row container" style="padding-top: 60px">
            <!-- Side menu -->
            <div class="col s12 m4">
                <div class="center-align col s12 m12">
                    <img class=" circle responsive-img z-depth-1 grey lighten-3" style="padding: 5px"
                         src="images/website/avatar.jpg">
                </div>
                <div class="col s12 m12">
                    <ul class="collapsible popout" data-collapsible="accordion">
                        <li>
                            <a class="collapsible-header active mytab" id="mytab_1" href="#"><i class="mdi-action-perm-contact-cal"></i>Πληροφορίες</a>
                            <div class="collapsible-body"><p>Επεξεργαστείτε προσωπικές πληροφορίες.</p></div>
                        </li>
                        <li>
                            <a class="collapsible-header mytab"><i class="mdi-social-notifications-on"></i>Δημοπρασίες</a>
                            <div class="collapsible-body collection">
                                <a href="#" class="collection-item mytab" id="mytab_6">Δημιουργία</a>
                                <a href="#" class="collection-item mytab" id="mytab_2">Ιστορικό</a>
                                <a href="#" class="collection-item mytab" id="mytab_3">Βαθμολόγηση</a>
                            </div>
                        </li>
                        <li>
                            <a class="collapsible-header mytab" id="mytab_4"  href="#"><i class="mdi-maps-hotel"></i>Ξενοδοχείο</a>
                        </li>
                        <li>
                            <a class="collapsible-header mytab" href="#" id="mytab_5"><i class="mdi-action-delete"></i>Διαγραφή</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Side menu -->

            <!--Tab Panels-->
            <!--User Details-->
            <div class="card row col s12 m8 tabregion" id="section_1" style="display: inline">
                <div class="col offset-s1 s10">
                    <p class="col s4 detailshead">Όνομα: </p>

                    <p class="col s3 detailsbody">Κωνσταντίνος</p>
                </div>
                <div class="col offset-s1 s10 divider"></div>
                <div class="col offset-s1 s10">
                    <p class="col s4 detailshead">Επώνυμο: </p>

                    <p class="col s3 detailsbody">Χασιώτης</p>
                </div>
                <div class="col offset-s1 s10 divider"></div>
                <div class="col offset-s1 s10">
                    <p class="col s4 detailshead">Ψευδώνυμο: </p>

                    <p class="col s3 detailsbody">Armageddonas</p>
                </div>
                <div class="col offset-s1 s10 divider"></div>
                <div class="col offset-s1 s10">
                    <p class="col s4 detailshead">Τηλέφωνο: </p>

                    <p class="col s3 detailsbody">+306944444444</p>
                </div>
                <div class="col offset-s1 s10 divider"></div>
                <div class="col offset-s1 s10">
                    <p class="col s4 detailshead">E-mail: </p>

                    <p class="col s3 detailsbody">icsd11175@icsd.aegean.gr</p>
                </div>
                <div class="col offset-s1 s10 divider"></div>
                <div class="col offset-s1 s10">
                    <p class="col s4 detailshead">Ημερομηνία γέννησης: </p>

                    <p class="col s3 detailsbody">25/2/1993</p>
                    </div>
            </div>
            <!--User Details-->

            <!-- Create Auction -->
            <div class="card col s12 m8 tabregion" id="section_6">
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

            <!-- Auction History -->
            <div class="card col s12 m8 tabregion" id="section_2">
                <div class=" white col s12 " style="padding-top: 15px;padding-bottom: 15px; font-weight: bold">
                    <div class="col s12 m3">Τίτλος</div>                       
                    <div class="col s12 m3">Τιμή Έναρξης</div>               
                    <div class="col s12 m4">Υψηλότερη Πλειοδοσία</div>     
                    <div class="col s12 m2">Ενεργά</div>     
                </div>
                <li class="divider col s12"></li>
                <div class="white col s12" style="padding-top: 10px;padding-bottom: 10px;">
                    <a class="col s12 m3 truncate" href="#!"><i class="mdi-action-home"></i> Δωμάτια σε τιμή ευκαιρίας
                        ευκαιρίας ευκαιρίας</a>

                    <div class="col s12 m3 flow-text"><i class="mdi-editor-attach-money"> </i>35</div>
                    <div class="col s12 m4 flow-text"><i class="mdi-editor-attach-money"> </i>55</div>
                    <div class="col s12 m2 flow-text">
                        <div class="btn-floating green"><i class="mdi-av-play-circle-outline"> </i></div>
                    </div>
                    <div class="divider"></div>
                </div>
                <li class="divider col s12"></li>
                <div class="white col s12" style="padding-top: 10px;padding-bottom: 10px;">
                    <a class="col s12 m3" href="#!"><i class="mdi-action-home"></i> Δωμάτια σε τιμή ευκαιρίας </a>

                    <div class="col s12 m3 flow-text"><i class="mdi-editor-attach-money"> </i>35</div>
                    <div class="col s12 m4 flow-text"><i class="mdi-editor-attach-money"> </i>40</div>
                    <div class="col s12 m2 flow-text">
                        <div class="btn-floating red disabled"><i class="mdi-av-pause"></i></div>
                    </div>
                </div>
            </div>
            <!-- Auction History -->

            <!-- Users evaluation -->
            <div class="card z-depth-3 col s12 m8 tabregion" id="section_3">
                <div class="white col s12 " style="padding-top: 15px;padding-bottom: 15px;">
                    <div class="col s12 m4 l4">Ονομ/νυμο</div>                       
                    <div class="col s12 m3 l4">Δωμάτιο</div>             
                    <div class="col s12 m5 l4">Βαθμολόγηση</div>     
                </div>
                <li class="divider col s12"></li>
                <div class="white col s12" style="padding-top: 10px;padding-bottom: 10px;">
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
                <li class="divider col s12"></li>
                <div class="white col s12" style="padding-top: 10px;padding-bottom: 10px;">
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
            </div>
            <!-- Users evaluation -->

            <!--Hotel details-->
            <div class="z-depth-3 col s12 m8 tabregion" id="section_4">   

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
                <div class="offset-s1 offset-m1 col s3 m5 l2 input-field">
                    <a class="btn-floating btn-large waves-effect waves-light red"><i class="mdi-content-add"></i></a>
                </div>
                <div class="col s12" style="padding-bottom: 20px;padding-top: 40px">
                    <button class="btn waves-effect waves-light" type="submit" name="action">ΚΑΤΑΧΩΡΗΣΗ
                        <i class="mdi-content-send right"></i>
                    </button>
                </div>
            </div>
            <!--Hotel details-->

            <!--Delete user-->
            <div class="col s12 m8 tabregion" id="section_5">
                <div class="col s12 m12">
                    <div class="card white" style="height: 400px;">
                        <div class="center-align" style="padding: 20px">
                            <p class="flow-text">Επιλέγοντας να διαγραφεί ο λογαριασμός σας τα προσωπικά σας δεδομένα διαγράφονται από το Samos Rentals</p>
                            <!-- Modal Trigger -->
                            <a class="waves-effect waves-light btn modal-trigger" href="#modal1">ΔΙΑΓΡΑΦΗ ΛΟΓΑΡΙΑΣΜΟΥ</a>

                            <!-- Modal Structure -->
                            <div id="modal1" class="col l5 offset-l5 modal">
                                <div class="modal-content">
                                    <h4>Διαγραφή λογαριασμού</h4>
                                    <p>Η διαγραφή του λογαριασμού σας είναι μη αναστρέψιμη. Είστε σίγουροι ότι θέλετε να συνεχίσετε;</p>
                                </div>
                                <div class="modal-footer">
                                    <a href="#!" class=" modal-action modal-close waves-effect waves-teal btn-flat">Επιστροφή</a>
                                    <a href="#!" class=" modal-action modal-close waves-effect waves-red btn-flat">Διαγραφη
                                        λογαριασμου</a>
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